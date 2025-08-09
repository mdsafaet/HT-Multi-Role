<?php

namespace App\Traits;

trait ApiResponseTrait
{
      public function success($data = null, $message = 'Success', $status_code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $status_code);
    }

    public function error($message = 'Error', $status_code = 400, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $status_code);
    }

    public function notFound($message = 'Resource not found', $status_code = 404, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $status_code);
    }

    public function unauthorized($message = 'Unauthorized', $status_code = 401, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $status_code);
    }

    public function validationError($errors, $message = 'Validation Error', $status_code = 422)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $status_code);
    }

    public function serverError($message = 'Server Error', $status_code = 500, $data = null)
    {
        return $this->error($message, $status_code, $data);
    }


    public function customResponse($data, $message = 'Custom Response', $status_code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $status_code);
    }

    public function forbidden($message = 'Forbidden', $status_code = 403, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $status_code);
    }
}
