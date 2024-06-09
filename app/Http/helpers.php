<?php


function apiResponse($message, $data = "", $status = "success")
{
    return response()->json([
        'data' => $data,
        'message' => $message,
        'status' => $status,
    ]);
}


function apiErrors($message, $status = "error")
{
    return response()->json([
        'message' => $message,
        'status' => $status,
    ])->setStatusCode(400);
}
