<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderState;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Mockery\Exception;

class OrderController extends Controller
{
    use RespondsWithHttpStatus;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $order->order_state()->associate(OrderState::find(1));

        $order->save();

        $order->tables()->attach($tables);

        foreach ($order->tables as $table) {
            $table->state = 0;
        }

        foreach ($items as $item) {
            $order->items()->attach(
                [$item['id'] => ['quantity' => $item['quantity']]]
            );
        }

        foreach ($extra_items as $extra_item) {
            $order->extra_items()->attach(
                [$extra_item['id'] => ['quantity_start' => $extra_item['quantity_start'],
                                        'quantity_not_use' => 0]]
            );
        }
//        foreach ($extra_items as $extra_item) {
//            $order->extra_items()->attach(
//                [$extra_item['id'] => ['quantity' => $extra_item['quantity']]]
//            );
//        }

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

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Fine Order
            $order = Order::findOrFail($id);

            // State Id
            $order->state_id = $request->has('state_id') ? $request->get('state_id') : null;

            // Update Item
            $items = $request->has('items') ? $request->get('items') : null;
            if ($items) {
                $order->items()->detach(); // DELETE Exist Item

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
            if ($tables) {
                $order->tables()->attach($tables);
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

            // Save
            $order->save();

            return $order;
        } catch (Exception $exception) {
            if($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' =>  'Order NOT FOUND'
                ], 404);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
