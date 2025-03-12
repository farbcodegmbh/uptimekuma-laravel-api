<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitors = Monitor::all();
        return response()->json(['data' => $monitors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'status' => 'sometimes|string|in:active,inactive',
        ]);

        $monitor = Monitor::create([
            'name' => $validated['name'],
            'url' => $validated['url'],
            'status' => $validated['status'] ?? 'active',
        ]);

        return response()->json(['data' => $monitor], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Monitor $monitor)
    {
        return response()->json(['data' => $monitor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monitor $monitor)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'url' => 'sometimes|url|max:255',
            'status' => 'sometimes|string|in:active,inactive',
        ]);

        $monitor->update($validated);

        return response()->json(['data' => $monitor]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitor $monitor)
    {
        $monitor->delete();

        return response()->json(null, 204);
    }
}
