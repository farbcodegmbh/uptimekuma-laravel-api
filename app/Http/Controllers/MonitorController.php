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
    public function index(Request $request)
    {
        $query = Monitor::query();

        /* Simple Filter */
        if ($request->type) $query->where('type', $request->type);
        if ($request->name) $query->where('name', $request->name);
        if ($request->url) $query->where('url', $request->url);

        $monitors = $query->get();

        return response()->json(['data' => $monitors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMonitorRequest $request)
    {
        $default = [
            'active' => config('uptimekuma.active'),
            'user_id' => config('uptimekuma.user_id'),
            'interval' => config('uptimekuma.interval'),
            'expiryNotification' => true
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
