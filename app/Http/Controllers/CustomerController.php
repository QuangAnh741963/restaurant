<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * GET ALL CUSTOMER
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
