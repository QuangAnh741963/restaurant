<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Traits\RespondsWithHttpStatus;
use Exception;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    use RespondsWithHttpStatus;
    /**
     * GET ALL ITEM
     */
    public function index(Request $request)
    {
        $query = Item::query();

        // Lấy ra Item theo tên
        if($request->has('name')) {
            $query->where('name', $request->get('name'));
        }

        $items = $query->get();
        return $this->success('Get Item Successfully', $items);
    }

    /**
     *  ADD ITEM
     */
    public function store(Request $request)
    {
        try {
            $item = new Item();
            $item->name = $request->input('name');
            $item->price = $request->input('price');
            $item->unit = $request->input('unit');

            $item->save();
            return $this->success('Add Item successfully', $item);

        } catch (Exception $exception) {
            return $this->failure($exception->getMessage());
        }
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
        try {
            $item = Item::findOrFail($id);
            if($request->has('name')) {
                $item->name = $request->input('name');
            }
            if($request->has('price')) {
                $item->price = $request->input('price');
            }
            if($request->has('unit')) {
                $item->unit = $request->input('unit');
            }

            $item->save();
            return $this->success('Item updated successfully', $item);

        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->failure('Item NOT FOUND', 404);
            }
            return $this->failure($exception->getMessage(), 404);
        }
    }

    /**
     *   DELETE ITEM
     */
    public function destroy(string $id)
    {
        try {
            $items = Item::findOrFail($id);
            $items->delete();
            return $this->success('Item DELETED successfully');

        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->failure('Item NOT FOUND', 404);
            }
            return $this->failure($exception->getMessage(), 404);
        }
    }
}
