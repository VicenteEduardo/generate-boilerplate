<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Http\Requests\StoreServicesRequest;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        return response()->json(Services::all());
    }

    public function store(StoreServicesRequest $request)
    {
        $item = Services::create($request->validated());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return response()->json(Services::findOrFail($id));
    }

    public function update(StoreServicesRequest $request, $id)
    {
        $item = Services::findOrFail($id);
        $item->update($request->validated());
        return response()->json($item);
    }

    public function destroy($id)
    {
        Services::destroy($id);
        return response()->json(null, 204);
    }
}
