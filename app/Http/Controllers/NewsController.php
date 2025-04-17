<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return response()->json(News::all());
    }

    public function store(StoreNewsRequest $request)
    {
        $item = News::create($request->validated());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return response()->json(News::findOrFail($id));
    }

    public function update(StoreNewsRequest $request, $id)
    {
        $item = News::findOrFail($id);
        $item->update($request->validated());
        return response()->json($item);
    }

    public function destroy($id)
    {
        News::destroy($id);
        return response()->json(null, 204);
    }
}
