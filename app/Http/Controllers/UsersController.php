<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Requests\StoreUsersRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json(Users::all());
    }

    public function store(StoreUsersRequest $request)
    {
        $item = Users::create($request->validated());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return response()->json(Users::findOrFail($id));
    }

    public function update(StoreUsersRequest $request, $id)
    {
        $item = Users::findOrFail($id);
        $item->update($request->validated());
        return response()->json($item);
    }

    public function destroy($id)
    {
        Users::destroy($id);
        return response()->json(null, 204);
    }
}
