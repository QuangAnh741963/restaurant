<?php

namespace App\Http\Controllers;

use App\Enums\OrderStateEnum;
use App\Enums\PaymentEnum;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\Table;
use App\Traits\RespondsWithHttpStatus;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use RespondsWithHttpStatus;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->has('table_id')) {
                $order = $this->findOrderByTableId($request->get('table_id'));
            } else {
                $order = Order::all();
            }
            return $this->success('', $order);
        } catch (Exception $exception) {
            return $this->failure('');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Request Item
        $items = $request->has('items') ? $request->get('items') : null;

        // Request Extra Item
        $extra_items = $request->has('extra_items') ? $request->get('extra_items') : null;

        // Request table
        $tables = $request->has('tables') ? $request->get('tables') : null;

        // Request customer
        $customer = $request->has('customer') ? $request->get('customer') : null;


        $order = new Order();

        // Make ID
        $order->id = strtoupper(fake()->bothify('**********'));
        $order->order_state()->associate(OrderState::find(OrderStateEnum::START));


        // Check table is available
        foreach ($tables as $table_id) {
            $table = Table::findOrFail($table_id);
            if (!$table->available) {
                return response()->json([
                    'message' => 'Tables are used'
                ], 404);
            }
        }

        // Save Order
        $order->save();

        $order->tables()->attach($tables);

        $order->tables->each(function ($table) {
           $table->available = false;
           $table->save();
        });

        // Item
        foreach ($items as $item) {
            $order->items()->attach(
                [$item['id'] => ['quantity' => $item['quantity']]]
            );
        }

        // Extra_Item
        foreach ($extra_items as $extra_item) {
            $order->extra_items()->attach(
                [$extra_item['id'] => ['quantity_start' => $extra_item['quantity_start'],
                                        'quantity_not_use' => 0]]
            );
        }

        // Customer
        $customer = Customer::firstOrCreate(
            ['email' => $customer['email']],
            ['name' => $customer['name'], 'phone' => $customer['phone']]
        );

        $order->customer()->associate($customer);

        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $order = Order::findOrFail($id)->with(['tables'])->get();
            return $this->success('', $order);
        } catch (Exception $exception) {
            if($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' =>  'Order NOT FOUND'
                ], 404);
            }
            return $this->failure($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Find Order
            $order = Order::findOrFail($id);

            // State ID
            $state_id = $request->has('state_id') ? $request->get('state_id') : null;

            if ($state_id) {
                $order->state_id = $state_id;
            }

            // Update Item
            $items = $request->has('items') ? $request->get('items') : null;
            if ($items) {
                foreach ($items as $item) {
                    $order->items()->attach(
                        [$item['id'] => ['quantity' => $item['quantity']]]
                    );
                }
            }

            // Update Extra Item
            $extra_items = $request->has('extra_items') ? $request->get('extra_items') : null;
            if ($extra_items) {
                $order->extra_items()->detach(); // DELETE Exist Extra Item

                foreach ($extra_items as $extra_item) {
                    $order->extra_items()->attach(
                        [$extra_item['id'] => ['quantity_start' => $extra_item['quantity_start'],
                            'quantity_not_use' => $extra_item['quantity_not_use']]]
                    );
                }
            }

            // Update Table
            $tables = $request->has('tables') ? $request->get('tables') : null;

            // chưa xử lý
//            $allTablesInOrder = $order->tables;
//            foreach ($allTablesInOrder as $table) {
//                $table->available = true;
//                $table->save();
//            }

            if ($tables) {
                foreach ($tables as $table_id) {
                    $table = Table::findOrFail($table_id);
                    if (!$table->available) {
                        return response()->json([
                            'message' => 'Tables are used'
                        ], 404);
                    }
                }
                // Update Table if available
                $order->tables()->sync($tables);
                // Update Table
                $order->tables->each(function ($table) {
                    $table->available = false;
                    $table->save();
                });
            }

            // Update Customer
            $customer = $request->has('customer') ? $request->get('customer') : null;
            if ($customer) {
                $customer = Customer::firstOrCreate(
                    ['email' => $customer['email']],
                    ['name' => $customer['name'], 'phone' => $customer['phone']]
                );
                $order->customer()->associate($customer);
            }

            // Update Payment
            $payment = $request->has('payment') ? $request->get('payment') : null;

            switch ($payment) {
                case PaymentEnum::CASH:
                    $order->payment = PaymentEnum::CASH;
                    break;
                case PaymentEnum::ONLINE_BANKING:
                    $order->payment = PaymentEnum::ONLINE_BANKING;
                    break;
            }

            // Save
            if($order->isDirty()) {
                $order->save();
                return $this->success('', $order);
            }

            return $this->success('', $order);
        } catch (Exception $exception) {
            return response()->json([
                'message' =>  'Order NOT FOUND'
            ], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find Order
            $order = Order::findOrFail($id);
            // Delete relationship
            $order->items()->detach();
            $order->extra_items()->detach();
            $order->tables()->detach();
            // Delete Order
            $order->delete();

            return response()->json([
                'message' => 'Delete Order Successfully'
            ],200);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Order NOT FOUND'],
                404);
        }

    }

    /**
     * @param string $table_id
     * @return JsonResponse
     *  FIND BY ID TABLE
     */
    public function findOrderByTableId(string $table_id)
    {
        $table = Table::findOrFail($table_id);

        $orders = $table->orders;

        foreach ($orders as $order) {
            if ($order->state_id != OrderStateEnum::DONE) {
                return $order;
            }
        }
        throw new ModelNotFoundException;
    }
}
