<?php

namespace App\Helpers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ResponseHelper
{
    public function responseFound($data)
    {
        return [
            "data" => $data,
            "message" => __("messages.data_found"),
            "code" => Response::HTTP_OK
        ];
    }
    public function responseNotFound($data)
    {
        return [
            "data" => $data,
            "message" => __("messages.data_not_found"),
            "code" => Response::HTTP_NOT_FOUND
        ];
    }
    public function responseInsertSuccess($data)
    {
        return [
            "data" => $data,
            "message" => __("messages.insert_success"),
            "code" => Response::HTTP_OK
        ];
    }
    public function responseInsertFail($data)
    {
        return [
            "data" => $data,
            "message" => __("messages.insert_fail"),
            "code" => Response::HTTP_BAD_REQUEST
        ];
    }
    public function responseUpdateSuccess($data)
    {
        return [
            "data" => $data,
            "message" => __("messages.update_success"),
            "code" => Response::HTTP_OK
        ];
    }
    public function responseUpdateFail($data)
    {
        return [
            "data" => $data,
            "message" => __("messages.update_fail"),
            "code" => Response::HTTP_BAD_REQUEST
        ];
    }
    public function responseDeleteSuccess($data)
    {
        return [
            "data" => $data,
            "message" => __("messages.delete_success"),
            "code" => Response::HTTP_OK
        ];
    }
    public function responseDeleteFail($data)
    {
        return [
            "data" => $data,
            "message" => __("messages.delete_fail"),
            "code" => Response::HTTP_BAD_REQUEST
        ];
    }
    public function responseValidation(String $message)
    {
        return [
            "data" => null,
            "message" => $message,
            "code" => Response::HTTP_BAD_REQUEST
        ];
    }
    public function responseErrorCode(String $message)
    {
        Log::info("ERROR CODE MESSAGE => ".$message);
        return [
            "data" => null,
            "message" => $message,
            "code" => Response::HTTP_INTERNAL_SERVER_ERROR
        ];
    }
    public function responseUnauthorized(String $message)
    {
        return [
            "data" => null,
            "message" => $message,
            "code" => Response::HTTP_UNAUTHORIZED
        ];
    }
}
