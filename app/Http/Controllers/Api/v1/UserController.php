<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Api\v1\UserStoreRequest;
use App\Http\Requests\Api\v1\UserUpdateRequest;
use App\Http\Resources\Api\v1\UserCollection;
use App\Http\Resources\Api\v1\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clientes = User::all();

        return new UserCollection($clientes);
    }

    public function store(UserStoreRequest $request)
    {
        $User = User::create($request->validated());

        return new UserResource($User);
    }

    public function show(Request $request, User $User)
    {
        return new UserResource($User);
    }

    public function update(UserUpdateRequest $request, User $User)
    {
        $User->update($request->validated());

        return new UserResource($User);
    }

    public function destroy(Request $request, User $User)
    {
        $User->delete();

        return response()->noContent();
    }
}
