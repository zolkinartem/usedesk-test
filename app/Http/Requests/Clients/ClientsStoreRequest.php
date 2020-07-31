<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClientsStoreRequest
 *
 * @package App\Http\Requests\Clients
 */
class ClientsStoreRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
            ],
            'last_name' => [
                'required',
                'string',
            ],
            'emails' => [
                'array',
            ],
            'emails.*' => [
                'email',
                'unique:emails,email',
                function ($attribute, $value, $fail) {
                    if (count(array_unique($this->request->get('emails'))) !== count($this->request->get('emails'))) {
                        $fail(trans('validation.must_be_unique'));
                    }
                },
            ],
            'phone_numbers' => [
                'array',
            ],
            'phone_numbers.*' => [
                'string',
                'unique:phone_numbers,number',
                function ($attribute, $value, $fail) {
                    if (count(array_unique($this->request->get('emails'))) !== count($this->request->get('emails'))) {
                        $fail(trans('validation.must_be_unique'));
                    }
                },
            ],
        ];
    }
}
