<?php

namespace App\Http\Resources\Laporan;

use App\Helpers\OtherHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanPenjualanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
          'marketing' => $this->marketing,
          'bulan' => (new OtherHelper)->monthIndonesia((int) $this->month),
          'omzet' => $this->omzet,
          'komisi' => $this->komisi." %",
          'komisi_nominal' => $this->komisi_nominal
        ];
    }
}
