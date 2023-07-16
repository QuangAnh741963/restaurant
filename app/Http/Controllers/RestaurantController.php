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
     *   ADD RESTAURANT
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
     *     UPDATE RESTAURANT
     */
    public function update(Request $request, string $id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            if($request->has('name')) {
                $restaurant->name = $request->input('name');
            }
            if($request->has('tax_code')) {
                $restaurant->tax_code = $request->input('tax_code');
            }
            if($request->has('name_leader')) {
                $restaurant->name_leader = $request->input('name_leader');
            }
            if($request->has('address')) {
                $restaurant->address = $request->input('address');
            }

            $restaurant->save();
            return $this->success('Restaurant updated successfully', $restaurant);

        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->failure('Restaurant NOT FOUND', 404);
            }
            return $this->failure($exception->getMessage(), 404);
        }
    }

    /**
     *     DELETE RESTAURANT
     */
    public function destroy(string $id)
    {
        //
    }
}
