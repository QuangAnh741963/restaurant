<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Traits\RespondsWithHttpStatus;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    use RespondsWithHttpStatus;
    /**
     * GET ALL RESTAURANT
     */
    public function index()
    {
        return Restaurant::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * GET RESTAURANT BY ID
     */
    public function show(string $id)
    {
        try {
            return Restaurant::findOrFail($id);
        } catch (Exception $exception){
            if($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' =>  'NOT FOUND INFO Restaurant'
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
