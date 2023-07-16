<?php

namespace App\Http\Controllers;

use App\Models\ExtraItem;
use App\Traits\RespondsWithHttpStatus;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ExtraItemController extends Controller
{
    use RespondsWithHttpStatus;
    /**
     * GET ALL EXTRA_ITEM
     */
    public function index(Request $request)
    {
        $query = ExtraItem::query();

        // Lấy ra Item theo tên
        if($request->has('name')) {
            $query->where('name', $request->get('name'));
        }

        $extra_items = $query->get();
        return $this->success('Get Extra Item Successfully', $extra_items);
    }

    /**
     *    ADD ITEM
     */
    public function store(Request $request)
    {
        try {
            $extra_items = new ExtraItem();
            $extra_items->name = $request->input('name');
            $extra_items->price = $request->input('price');
            $extra_items->unit = $request->input('unit');

            $extra_items->save();
            return $this->success('Add Extra Item successfully', $extra_items);

        } catch (Exception $exception) {
            return $this->failure($exception->getMessage());
        }
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
     *     UPDATE ITEM
     */
    public function update(Request $request, string $id)
    {
        try {
            $extra_items = ExtraItem::findOrFail($id);
            $extra_items->name = $request->input('name');
            $extra_items->price = $request->input('price');
            $extra_items->unit = $request->input('unit');

            $extra_items->save();
            return $this->success('Extra Item updated successfully', $extra_items);

        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->failure('Extra Item NOT FOUND', 404);
            }
            return $this->failure($exception->getMessage(), 404);
        }
    }

    /**
     * DELETE ITEM
     */
    public function destroy(string $id)
    {
        try {
            $extra_items = ExtraItem::findOrFail($id);
            $extra_items->delete();
            return $this->success('Extra Item DELETED successfully');

        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->failure('Extra Item NOT FOUND', 404);
            }
            return $this->failure($exception->getMessage(), 404);
        }
    }
}
