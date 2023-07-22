<?php

namespace App\Http\Controllers;

use App\Enums\PaymentEnum;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Restaurant;
use App\Traits\RespondsWithHttpStatus;
use Exception;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class PaymentController extends Controller
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
        //
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

    // COMPUTE TOTAL BILL
    public function computePayment(string $order_id){

            $order = Order::findOrFail($order_id);

            // Check State_Id
            if($order->state_id != 3) {
                return response()->json([
                    'message' => 'Not yet time to pay'
                ],422);
            }

            // Compute Item
            $items = $order->items;
            $total_bill_item = 0;

            foreach ($items as $item) {
                $total_bill_item += $item['price']*$item->pivot->quantity;
            }

            // Compute Extra_Item
            $extra_items = $order->extra_items;
            $total_bill_extra_item = 0;

            foreach ($extra_items as $extra_item) {
                $quantity_start = $extra_item->pivot->quantity_start;
                $quantity_not_use = $extra_item->pivot->quantity_not_use;

                $total_bill_extra_item += $extra_item['price']*(
                    $quantity_start - $quantity_not_use
                    );
            }

            // Total Bill
            $total_bill = $total_bill_item + $total_bill_extra_item;

            $order->total_bill = $total_bill;
            $order->save();

            return $total_bill;
    }

    // SHOW BILL (NO HOA_DON_DO)
    public function showBill(string $order_id) {
        try {
            $order = Order::findOrFail($order_id);
            $total_bill = $this->computePayment($order_id);

            return response()->json([
                'message' => 'Please Complete billing for us',
                'data' => [
                    [
                        'value' => $total_bill,
                        'unit' => 'VND'
                    ]
                ]
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' =>  'Order NOT FOUND'
            ], 404);
        }
    }
    // SHOW BILL (HOA_DON_DO)
    public function showBill_HoaDonDo(string $order_id) {
        try {
            $order = Order::findOrFail($order_id);
            $total_bill = $this->computePayment($order_id);

            $restaurant = Restaurant::find(1);
            $customer = Customer::find($order->customer_id);
            return response()->json([
                'Information Restaurant' => $restaurant,
                'Information Customer' => $customer,
                'message' => 'Please Complete billing for us',
                'data' => [
                    [
                        'value' => $total_bill,
                        'unit' => 'VND'
                    ]
                ]
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' =>  'Order NOT FOUND'
            ], 404);
        }
    }
}
