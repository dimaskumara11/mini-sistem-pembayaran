<?php

namespace App\Http\Requests\Pembayaran;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PembayaranKreditInsertRequest extends FormRequest
{
    public function rules()
    {
        return [
            'transaction_number' => 'required|exists:penjualan,transaction_number',
            'tanggal_bayar' => 'required|date',
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
            'tanggal_bayar.required' => 'Tanggal Bayar Harus Di Isi',
            'tanggal_bayar.date' => 'Tanggal Bayar Harus Berformat Tanggal',
            'transaction_number.required' => 'Kode Transaksi Harus Di Isi',
            'transaction_number.exists' => 'Kode Transaksi Tidak Valid',
        ];
    }
}