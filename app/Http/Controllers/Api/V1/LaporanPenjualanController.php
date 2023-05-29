<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\LaporanPenjualanService;
use Illuminate\Http\JsonResponse;

class LaporanPenjualanController extends Controller
{
    private $responseHelper;
    public function __construct()
    {
        $this->responseHelper = new ResponseHelper();
    }
    public function get(): JsonResponse
    {
        $data = (new LaporanPenjualanService())->get();
        return response()->custom($data ? $this->responseHelper->responseFound($data) : $this->responseHelper->responseNotFound(null));
    }
}
