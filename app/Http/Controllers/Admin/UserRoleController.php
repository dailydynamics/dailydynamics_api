<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use App\Http\Requests\StoreUserRoleRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Http\Resources\UserRoleResource;
use App\Traits\ApiResponse;
use Exception;

class UserRoleController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->success(UserRoleResource::collection(UserRole::all()), 'success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRoleRequest $request)
    {
        try {
            $userRole = new UserRole();
            $userRole->name = $request->name;
            return $this->success(new UserRoleResource($userRole), 'Created', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function show(UserRole $userRole)
    {
        try {
            return $this->success(new UserRoleResource($userRole), 'Success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRole $userRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRoleRequest  $request
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRoleRequest $request, UserRole $userRole)
    {
        try {
            $userRole->name = $request->name;
            $userRole->update();
            return $this->success(new UserRoleResource($userRole), 'Updated', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRole $userRole)
    {
        try {
            $userRole->delete();
            return $this->success('', 'Deleted', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
}
