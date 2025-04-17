<?php

namespace App\Http\Controllers;

use App\Models\Configurations;
use App\Http\Requests\StoreConfigurationsRequest;
use Illuminate\Http\Request;

class ConfigurationsController extends Controller
{
    public function index()
    {
        return response()->json(Configurations::all());
    }

    public function store(StoreConfigurationsRequest $request)
    {
        $item = Configurations::create($request->validated());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return response()->json(Configurations::findOrFail($id));
    }

    public function update(StoreConfigurationsRequest $request, $id)
    {
        $item = Configurations::findOrFail($id);
        $item->update($request->validated());
        return response()->json($item);
    }

    public function destroy($id)
    {
        Configurations::destroy($id);
        return response()->json(null, 204);
    }
}
