<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends Controller
{
    use ApiResponse;
    public function login(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('phone', $request->phone)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'credential' => ['The provided credentials are incorrect.'],
                ]);
            }
            $token = $user->createToken('token')->plainTextToken;

            return $this->success(['user' => new UserResource($user), 'token' => $token], 'Login Success', 200);
        } catch (Exception $ex) {
            return $this->error($ex->getMessage(), 400);
        }
    }
    public function register(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required',
                'password' => 'required',
                'name' => 'required',
                'email' => 'required'
            ]);

            $user = new User();
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->save();
            $token = $user->createToken('token')->plainTextToken;

            return $this->success(['user' => new UserResource($user), 'token' => $token], 'Regitration Successfull', 200);
        } catch (Exception $ex) {
            return $this->error($ex->getMessage(), 400);
        }
    }
    public function me(Request $request)
    {
        try {
            return $this->success(new UserResource($request->user()), 'Success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
    public function destroy(Request $request)
    {
        try {
            $user = $request->user()->tokens()->delete();
            $user->delete();
            return $this->success('Profile Deleted', 'Success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
    public function update(Request $request)
    {

        try {
            $user = $request->user();
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->name = $request->name;
            $user->update();
            return $this->success(new UserResource($user), 'Profile Updated', 'Success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
    public function updatePassword(Request $request)
    {
        try {
            $user = $request->user();
            if (Hash::check($request->password, $user->password)) {
                $user->password = $request->newpassword;
                $user->update();
                return $this->success('Password Changed', 'Password Updated', 'Success', 200);
            }
            throw new Exception('User Not Found');
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
}
