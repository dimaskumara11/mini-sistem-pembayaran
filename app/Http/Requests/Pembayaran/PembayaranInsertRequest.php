<?php

namespace App\Http\Requests\Pembayaran;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PembayaranInsertRequest extends FormRequest
{
    public function rules()
    {
        return [
            'total_bayar' => 'required|numeric',
            'cargo_fee' => 'required|numeric',
            'bunga' => 'required|numeric',
            'jatuh_tempo' => 'required|date',
            'dp' => 'required|numeric',
            'jenis' => 'required|in:TUNAI,KREDIT',
            'marketing_id' => 'required|exists:marketing,id',
            'date' => 'required|date',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        foreach ($validator->errors()->messages()??[] as $key => $value) {
            $messageError = $validator->errors()->messages()[$key][0];
        }
        throw new HttpResponseException(response()->custom((new ResponseHelper)->responseValidation(strtoupper($messageError))));
    }

    public function messages()
    {
        return [
            'date.required' => 'Date Harus Di Isi',
            'date.date' => 'Date Harus Berformat Tanggal',
            'marketing_id.required' => 'Marketing Harus Di Isi',
            'marketing_id.exists' => 'ID Marketing Tidak Berlaku',
            'jenis.required' => 'Jenis Pembayaran is required',
            'jenis.in' => 'Pilihan Jenis Pembayaran Hanya TUNAI ATAU KREDIT',
            'dp.required' => 'DP is required',
            'dp.numeric' => 'DP Harus Angka',
            'jatuh_tempo.required' => 'Jatuh Tempo Harus Di Isi',
            'jatuh_tempo.date' => 'Jatuh Tempo Harus Berformat Tanggal',
            'bunga.required' => 'Bunga is required',
            'bunga.numeric' => 'Bunga Harus Angka',
            'cargo_fee.required' => 'Cargo Fee Harus Di Isi',
            'cargo_fee.numeric' => 'Cargo Fee Harus Angka',
            'total_bayar.required' => 'Total Bayar Harus Di Isi',
            'total_bayar.numeric' => 'Total Bayar Harus Angka',
        ];
    }
}