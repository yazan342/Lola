<?php


function apiResponse($message = "success", $data = null, $status = 200)
{
    return response()->json([
        'data' => $data,
        'message' => $message,
        'status' => $status,
    ]);
}


function apiErrors($message, $status = 400)
{
    return response()->json([
        'message' => $message,
        'status' => $status,
    ]);
}
