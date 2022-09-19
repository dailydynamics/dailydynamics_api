<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Contact;
use App\Traits\ApiResponse;
use Exception;

class BannerController extends Controller
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
            return $this->success(BannerResource::collection(Banner::all()), 'Fetched Successfully', 200);
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
     * @param  \App\Http\Requests\StoreBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        try {
            $banner = new Banner();
            $banner->image = $request->image;
            $banner->alt_text = $request->alt_text;
            $banner->save();
            return $this->success(new BannerResource($banner), 'Created', 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        try {
            return $this->success(new BannerResource($banner), 'Fetched Success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBannerRequest  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        try {
            $banner->image = $request->image;
            $banner->alt_text = $request->alt_text;
            $banner->update();
            return $this->success(new BannerResource($banner), 'Updated', 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        try {
            $banner->delete();
            return $this->success();
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
    public function recent()
    {
        try {
            $banners = Banner::orderBy('created_at', 'desc')->take(5)->get();
            return $this->success(BannerResource::collection($banners), 'Fetched Success', 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
}
