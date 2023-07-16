<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderState;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;

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
        // Lấy dữ liệu trong request và import vào các biến
        $items = $request->has('items') ? $request->get('items') : null;

        $extra_items = $request->has('extra_items') ? $request->get('extra_items') : null;

        $tables = $request->has('tables') ? $request->get('tables') : null;

        $customer = $request->has('customer') ? $request->get('customer') : null;

        // Tạo đối tượng order
        $order = new Order();

        // Tạo ngẫu nhiên 1 chuỗi để làm ID
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
