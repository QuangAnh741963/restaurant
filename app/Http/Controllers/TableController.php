<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Traits\RespondsWithHttpStatus;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TableController extends Controller
{
    use RespondsWithHttpStatus;

    /**
     * GET ALL LIST TABLE
     */
    public function index(Request $request)
    {
        $query = Table::query();

        // Find with available
        if ($request->has('available')) {
            $available = $request->get('available');
            $query->where('available', $available);
        }

        // Find with quantity
        if ($request->has('quantity')) {
            $quantity = $request->get('quantity');
            $query->where('quantity', $quantity);
        }

        $tables = $query->get();
        return $this->success('Get all tables successfully.', ["Info" => $tables,
            "Total: " => $tables->count()]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * GET TABLE BY ID
     */
    public function show(string $id)
    {
        try {
            return Table::findOrFail($id);
        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'TABLE NOT FOUND'
                ], 404);
            }
            return $exception->getMessage();
        }
    }

    /**
     * UPDATE TABLE state AND quantity BY Id
     */
    public function update(Request $request, string $id)
    {
        try {
            $table = Table::findOrFail($id);

            // Update available
            if ($request->has('available')) {
                $table->available = $request->get('available');
            }

            // Update quantity
            if ($request->has('quantity')) {
                $table->quantity = $request->get('quantity');
            }

            $table->save();

            return $this->success('Update Table Successfully', $table);
        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'TABLE NOT FOUND'
                ], 404);
            }
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
