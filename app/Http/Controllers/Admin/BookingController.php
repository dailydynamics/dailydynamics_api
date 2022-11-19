<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Traits\ApiResponse;
use Exception;

class BookingController extends Controller
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
            return $this->success(BookingResource::collection(Booking::all()), 'Fetched Successfully', 200);
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
     * @param  \App\Http\Requests\StoreBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        try {
            $validated = $request->validated();
            $booking = new Booking();
            $booking->patient_name = $request->patient_name;
            $booking->contact = $request->contact;
            $booking->location_id = $request->location_id;
            $booking->remark = $request->remark;
            $booking->type = $request->type;
            $booking->save();
            return $this->success(new BookingResource($booking), 'success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        try {
            return $this->success(new BookingResource($booking), 'Fetched Success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookingRequest  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        try {
            $booking->patient_name = $request->patient_name;
            $booking->contact = $request->contact;
            $booking->location_id = $request->location_id;
            $booking->remark = $request->remark;
            $booking->type = $request->type;
            $booking->update();
            return $this->success(new BookingResource($booking), 'Update Success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        try {
            $booking->delete();
            return $this->success();
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
}
