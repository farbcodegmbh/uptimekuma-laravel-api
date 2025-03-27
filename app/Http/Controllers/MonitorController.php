<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonitorRequest;
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
    public function store(StoreMonitorRequest $request)
    {
        $default = [
            'active' => env('KUMA_ACTIVE', 1),
            'user_id' => env('KUMA_USER_ID', 1),
            'interval' => env('KUMA_INTERVAL', 60),
        ];

        $monitor = Monitor::create(array_merge($default, $request->toArray()));

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
        ]);

        $monitor->update($validated);

        return response()->json(['data' => $monitor]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitor $monitor)
    {
        //$monitor->delete();
        return response()->json(null, 204);
    }
}
