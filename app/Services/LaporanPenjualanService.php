<?php

namespace App\Services;

use App\Http\Resources\Laporan\LaporanPenjualanResource;
use App\Models\SettingsKomisiModel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class LaporanPenjualanService
{
    private function condKomisi($field): object
    {
        $data = SettingsKomisiModel::all();
        $result = [
            "percent" => "",
            "nominal" => ""
        ];
        foreach ($data as $value) {
            switch ($value->operator) {
                case 'BETWEEN':
                    $result["percent"] .= " WHEN $field $value->operator $value->omzet_start AND $value->omzet_end THEN $value->komisi";
                    $result["nominal"] .= " WHEN $field $value->operator $value->omzet_start AND $value->omzet_end THEN $value->komisi * $field / 100";
                    break;
                case '>=':
                    $result["percent"] .= " WHEN $field $value->operator $value->omzet_start THEN $value->komisi";
                    $result["nominal"] .= " WHEN $field $value->operator $value->omzet_start THEN $value->komisi * $field / 100";
                    break;
            }
        }
        return (object) $result;
    }
    public function get(): AnonymousResourceCollection
    {
        $condKomisi = $this->condKomisi("sum( pjl.grand_total )");
        $data = DB::select("SELECT
                mkt.`name` AS marketing,
                DATE_FORMAT( pjl.DATE, '%m' ) AS month,
                sum( pjl.grand_total ) AS omzet,
                CASE 
                    $condKomisi->percent
                END AS komisi,
                CASE 
                    $condKomisi->nominal
                END AS komisi_nominal
            FROM
                penjualan pjl
                JOIN marketing mkt ON mkt.id = pjl.marketing_id 
            GROUP BY
                mkt.`name`,
                month
            ORDER BY
                month ASC");
        return LaporanPenjualanResource::collection($data);
    }
}