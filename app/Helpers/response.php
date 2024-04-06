<?php

/**
 * Generate error response.
 *
 * @param string $msg The error message
 * @param int $code The HTTP code, default: 400
 *
 * @return Illuminate\Http\JsonResponse
 */
function responseError(string $msg, int $code = 400)
{
    return response([
        "status" => "error",
        "code" => $code,
        "message" => $msg
    ], $code);
}

/**
 * Generates success response
 *
 * @param array $data list/single data
 * @param string $msg The success message
 * @param int $code The HTTP code, default: 200
 *
 * @return Illuminate\Http\JsonResponse
 */
function responseSuccess(array $data = [], string $msg = "", int $code = 200)
{
    return response([
        "status" => "success",
        "message" => $msg,
        "data" => $data,
    ], $code);
}

/**
 * Generates success response without data
 *
 * @param string $msg The success message
 * @param int $code The HTTP code, default: 200
 *
 * @return Illuminate\Http\JsonResponse
 */
function responseSuccessMsg(string $msg = "", int $code = 200)
{
    return response([
        "status" => "success",
        "message" => $msg,
    ], $code);
}
