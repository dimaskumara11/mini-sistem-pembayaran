<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pembayaran\PembayaranInsertRequest;
use App\Http\Requests\Pembayaran\PembayaranKreditInsertRequest;
use App\Models\PembayaranModel;
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
    public function bayarCicilan(PembayaranKreditInsertRequest $request, $idPembayaran): JsonResponse
    {
        $data = (new PembayaranService())->bayarCicilan($request, $idPembayaran);
        if($data["message"]??"")
            return response()->custom($this->responseHelper->responseErrorCode($data["message"]));
        return response()->custom($data["id"] ? $this->responseHelper->responseInsertSuccess(["id"=>$data["id"]]) : $this->responseHelper->responseInsertFail(null));
    }
}
