<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponse;
    public function index()
    {
        return view('index');
    }

    public function userStats()
    {
        try {
            return $this->success([], 'success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
}
