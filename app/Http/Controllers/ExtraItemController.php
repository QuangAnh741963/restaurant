<?php

namespace App\Http\Controllers;

use App\Models\ExtraItem;
use Exception;
use Illuminate\Http\Request;

class ExtraItemController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return ExtraItem::findOrFail($id);
        } catch (Exception $exception) {
//            if($exception instanceof )
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
