<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pembayaran\PembayaranInsertRequest;
use App\Http\Requests\Pembayaran\PembayaranKreditInsertRequest;
use App\Services\PembayaranService;
use Illuminate\Http\JsonResponse;

class PembayaranController extends Controller
{
    private $responseHelper;
    public function __construct()
    {
        $this->responseHelper = new ResponseHelper();
    }
    public function bayar(PembayaranInsertRequest $request): JsonResponse
    {
        $data = (new PembayaranService())->create($request);
        if($data["message"]??"")
            return response()->custom($this->responseHelper->responseErrorCode($data["message"]));
        return response()->custom($data["id"] ? $this->responseHelper->responseInsertSuccess(["id"=>$data["id"]]) : $this->responseHelper->responseInsertFail(null));
    }
    public function bayarCicilan(PembayaranKreditInsertRequest $request): JsonResponse
    {
        $data = (new PembayaranService())->bayarCicilan($request);
        if($data["message"]??"")
            return response()->custom($this->responseHelper->responseErrorCode($data["message"]));
        return response()->custom($data ? $this->responseHelper->responseInsertSuccess(null) : $this->responseHelper->responseInsertFail(null));
    }
}
