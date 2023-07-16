<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * GET ALL LIST TABLE
     */
    public function index()
    {
        return Table::all();
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
    /**
     * UPDATE TABLE STATE 0->1
     */
    public function updateStateOpen(string $id) {
        try {
            $table = Table::findOrFail($id);
            $table->state = 1;
            $table->save();

            return response()->json([
                'message' => 'Update Table to OPEN Success',
                'data' => $table
            ]);
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
     * UPDATE TABLE STATE 1->0
     */
    public function updateStateClose(string $id) {
        try {
            $table = Table::findOrFail($id);
            $table->state = 0;
            $table->save();

            return response()->json([
                'message' => 'Update Table to CLOSE Success',
                'data' => $table
            ]);
        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'TABLE NOT FOUND'
                ], 404);
            }
            return $exception->getMessage();
        }
    }
}
