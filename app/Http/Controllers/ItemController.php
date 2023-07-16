<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Exception;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * GET ALL ITEM
     */
    public function index()
    {
        return Item::all();
    }

    /**
     *  ADD ITEM
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * GET ITEM BY ID
     */
    public function show(int $id)
    {
        try {
            return Item::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'FOOD NOT FOUND'
            ], 404);
        }
    }

    /**
     *    UPDATE ITEM
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     *   DELETE ITEM
     */
    public function destroy(string $id)
    {
        //
    }
}
