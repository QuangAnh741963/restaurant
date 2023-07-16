<?php

namespace App\Http\Controllers;

use App\Models\ExtraItem;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ExtraItemController extends Controller
{
    /**
     * GET ALL EXTRA_ITEM
     */
    public function index()
    {
        return ExtraItem::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * GET EXTRA_ITEM BY ID
     */
    public function show(string $id)
    {
        try {
            return ExtraItem::findOrFail($id);
        } catch (Exception $exception) {
            if($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'EXTRA ITEM NOT FOUND'
                ],404);
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
