<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Http\Requests\StoreContactsRequest;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        return response()->json(Contacts::all());
    }

    public function store(StoreContactsRequest $request)
    {
        $item = Contacts::create($request->validated());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return response()->json(Contacts::findOrFail($id));
    }

    public function update(StoreContactsRequest $request, $id)
    {
        $item = Contacts::findOrFail($id);
        $item->update($request->validated());
        return response()->json($item);
    }

    public function destroy($id)
    {
        Contacts::destroy($id);
        return response()->json(null, 204);
    }
}
