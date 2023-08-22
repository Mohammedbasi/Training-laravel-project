<?php

namespace UserModule\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use UserModule\App\Http\Requests\UserEditRequest;
use UserModule\App\Http\Requests\UserRequest;
use UserModule\App\Http\Resources\UserResource;
use UserModule\app\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::with('address')->filter($request->query())->paginate();
        $data = UserResource::collection($users);
        return response()->success($data, 'Users listed successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $password = Hash::make($request->post('password'));
        $request->merge([
            'password' => $password,
        ]);

        $user = User::create($request->all());
        return response()->success(new UserResource($user), 'User created Successfully', 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->success(new UserResource($user), 'User listed successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserEditRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->success(new UserResource($user), 'User Updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->success(new UserResource($user), 'User Deleted successfully', 200);
    }
}
