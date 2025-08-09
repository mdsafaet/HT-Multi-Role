<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    use ApiResponseTrait;


    public function register(UserRegisterRequest $request)
    {

        $data = $request->validated();



        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],



        ]);

        $token = auth('api')->login($user);

        return $this->success($token);
    }

    public function update(UserRegisterRequest $request, $id  )
    {
      $user = User::find($id);

      if (!$user) {
        return $this->error('User not found', 404);
      }

       $updated = $user->update($request->validated());

       if ($updated) {
            return $this->success( 'user Updated ',$user);
        } else {
            return $this->error('Failed to update user', 500);
        }


    }


    public function destroy(User $user,$id){

       $user = User::find($id);
        if (!$user) {
            return $this->error('User not found', 404);
        }

        if ($user->delete()) {
            return $this->success('User deleted successfully');
        }

        return $this->error('Failed to delete User', 500);

    }


    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    public function me()
    {
        return response()->json(auth('')->user());
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
