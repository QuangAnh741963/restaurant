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
            $customer->email = $request->input('email');

            $customer->save();

            return $this->success('Customer created successfully', $customer, 201);
        } catch (Exception $exception) {
            return $this->failure($exception->getMessage());
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
     * UPDATE CUSTOMER
     */
    public function update(Request $request, string $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            if($request->has('name')) {
                $customer->name = $request->input('name');
            }
            if($request->has('phone')) {
                $customer->phone = $request->input('phone');
            }
            if($request->has('email')) {
                $customer->email = $request->input('email');
            }

            $customer->save();
            return $this->success('Customer updated successfully', $customer);

        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->failure('Customer NOT FOUND', 404);
            }
            return $this->failure($exception->getMessage(), 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return $this->success('Customer DELETED successfully');

        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->failure('Customer NOT FOUND', 404);
            }
            return $this->failure($exception->getMessage(), 404);
        }
    }
}
