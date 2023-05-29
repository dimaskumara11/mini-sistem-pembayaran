<?php

namespace App\Http\Requests\Media;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class MediaUploadFileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file' => 'required|max:10000|mimes:jpg,jpeg,png,webp,svg' //10mb
        ];
    }

    public function failedValidation(Validator $validator)
    {
        foreach ($validator->errors()->messages()??[] as $key => $value) {
            $messageError = $validator->errors()->messages()[$key][0];
        }
        throw new HttpResponseException(response()->custom((new ResponseHelper)->responseValidation(strtoupper($messageError))));
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'Name is required',
    //     ];
    // }
}
