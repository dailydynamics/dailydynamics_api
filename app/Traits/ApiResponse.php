<?php

namespace App\Traits;


trait ApiResponse
{
    protected function success($data = null, $message = 'Success', $code = 200)
    {
        return response()->json(['status' => 'success', 'code' => $code, 'message' => $message, 'data' => $data], $code);
    }
    protected function error($message = 'Error', $code = 402)
    {
        return response()->json(['message' => $message, 'code' => $code, 'status' => 'error'], $code);
    }
}
