<?php

namespace App\Http\Controllers;

use App\Models\Slideshows;
use App\Http\Requests\StoreSlideshowsRequest;
use Illuminate\Http\Request;

class SlideshowsController extends Controller
{
    public function index()
    {
        return response()->json(Slideshows::all());
    }

    public function store(StoreSlideshowsRequest $request)
    {
        $item = Slideshows::create($request->validated());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return response()->json(Slideshows::findOrFail($id));
    }

    public function update(StoreSlideshowsRequest $request, $id)
    {
        $item = Slideshows::findOrFail($id);
        $item->update($request->validated());
        return response()->json($item);
    }

    public function destroy($id)
    {
        Slideshows::destroy($id);
        return response()->json(null, 204);
    }
}
