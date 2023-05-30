<?php

namespace App\Services;

use App\Helpers\OtherHelper;
use App\Models\PembayaranKreditModel;
use App\Models\PembayaranModel;
use App\Models\PenjualanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranService
{
    private $pembayaranModel;
    private $pembayaranKreditModel;
    private $penjualanModel;
    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->pembayaranKreditModel = new PembayaranKreditModel();
        $this->penjualanModel = new PenjualanModel();
    }
    private function calcAngsuranBulanan($totalBayar, $dateStart, $dateEnd)
    {
        $dateStart = Carbon::parse($dateStart);
        $dateEnd = Carbon::parse($dateEnd);
        $diff = $dateStart->diffInMonths($dateEnd);
        return $totalBayar/$diff;
    }
    public function create(Request $request): array
    {
        try {
            $bungaNominal = $request->total_bayar * $request->bunga / 100;
            $angsuranBulanan = $this->calcAngsuranBulanan(($request->total_bayar + $bungaNominal - $request->dp), $request->date, $request->jatuh_tempo);

            DB::beginTransaction();
            $penjualan = $this->penjualanModel;
            $penjualan->transaction_number = (new OtherHelper)->transactionNumber();
            $penjualan->marketing_id = $request->marketing_id;
            $penjualan->date = $request->date;
            $penjualan->cargo_fee = $request->cargo_fee;
            $penjualan->total_balance = $request->total_bayar - $request->cargo_fee;
            $penjualan->grand_total = $request->total_bayar;
            if($penjualan->save()){
                $pembayaran = $this->pembayaranModel;
                $pembayaran->penjualan_id = $penjualan->id;
                $pembayaran->jenis = $request->jenis;
                $pembayaran->dp = $request->dp;
                $pembayaran->angsuran_bulanan = $angsuranBulanan;
                $pembayaran->jatuh_tempo = $request->jatuh_tempo;
                $pembayaran->bunga = $request->bunga;
                $pembayaran->sisa_bayar = $request->total_bayar - $request->dp;
                $pembayaran->total_bayar = $request->total_bayar;
                if($pembayaran->save()){
                    DB::commit();
                    return [
                        "id" => $pembayaran->id
                    ];
                }else{
                    DB::rollBack();
                    return [
                        "id" => null
                    ];
                }
            }else{
                DB::rollBack();
                return [
                    "id" => null
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                "id" => null,
                "message" => $th->getMessage()
            ];
        }
    }
    public function bayarCicilan(Request $request, $idPembayaran): array
    {
        try {
            $pembayaran = $this->pembayaranModel->find($idPembayaran);
            if(empty($pembayaran))
                return ["id"=>"","message"=>"ID PEMBAYARAN TIDAK VALID"];
            $checkCicilanBulanIni = $this->pembayaranKreditModel->where("pembayaran_id",$pembayaran->id)->where("tanggal_bayar","like","%".Carbon::parse($request->tanggal_bayar)->format("Y-m")."%")->first();
            if($checkCicilanBulanIni)
                return ["id"=>"","message"=>"CICILAN BULAN INI SUDAH DI BAYAR"];

            DB::beginTransaction();
            $pembayaranKredit = $this->pembayaranKreditModel;
            $pembayaranKredit->pembayaran_id = $pembayaran->id;
            $pembayaranKredit->tanggal_bayar = $request->tanggal_bayar;
            $pembayaranKredit->nilai_bayar = $pembayaran->angsuran_bulanan;
            if($pembayaranKredit->save()){
                $pembayaran->sisa_bayar = $pembayaran->sisa_bayar - $pembayaran->angsuran_bulanan;
                if($pembayaran->save()){
                    DB::commit();
                    return ["id"=>$pembayaranKredit->id];
                }else{
                    DB::rollBack();
                    return ["id"=>""];
                }
            }else{
                DB::rollBack();
                return ["id"=>""];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                "id" => null,
                "message" => $th->getMessage()
            ];
        }
    }
}