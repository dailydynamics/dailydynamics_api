<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Location;
use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
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
            $userCount = User::count();
            $bookings = Booking::whereDate('created_at', Carbon::today())->count();
            $locations = Location::count();
            $totalBooking = Booking::count();
            return $this->success(['users' => $userCount, 'bookings' => $bookings, "locations" => $locations, "totalBookings" => $totalBooking], 'success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
    public function recentBookings()
    {
        try {
            $bookings = Booking::whereDate('created_at', Carbon::today())->get();
            return $this->success(BookingResource::collection($bookings), 'success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    public function userspage()
    {
        return view('users');
    }
    public function notifications()
    {
        return view('notifications');
    }
}
