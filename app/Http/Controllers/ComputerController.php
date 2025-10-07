<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Computer::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComputerRequest $request)
    {
        $computer = Computer::create($request->validated());
        return response()->json($computer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $computer = Computer::with('category')->findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $computer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComputerRequest $request, $id)
    {
        $computer = Computer::findOrFail($id);
        $computer->update($request->validated());
        return response()->json($computer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $computer = Computer::findOrFail($id);
        $computer->delete();
        return response()->json(null, 204);
    }
}
