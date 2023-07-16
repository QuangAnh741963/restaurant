<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Traits\RespondsWithHttpStatus;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use RespondsWithHttpStatus;
    /**
     * GET ALL CUSTOMER
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        // Tìm kiếm theo name
        if($request->has('name')) {
            $query->where('name', $request->get('name'));
        }
        // Tìm kiếm theo phone
        if($request->has('phone')) {
            $query->where('phone', $request->get('phone'));
        }
        // Tìm kiếm theo email
        if($request->has('email')) {
            $query->where('email', $request->get('email'));
        }

        $customer = $query->get();
        return $this->success('Get Customers Successfully',$customer, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $customer = new Customer();
            $customer->name = $request->input('name');
            $customer->phone = $request->input('phone');
            $customer->email = $request->input()
        } catch (Exception $exception) {

        }
    }

    /**
     * GET CUSTOMER BY ID
     */
    public function show(string $id)
    {
        try {
            return Customer::findOrFail($id);
        } catch (Exception $exception){
            if($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' =>  'Customer NOT FOUND'
                ], 404);
            }
        }
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
