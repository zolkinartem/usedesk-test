<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ClientsUpdateRequest
 *
 * @package App\Http\Requests\Clients
 */
class ClientsUpdateRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'string',
            ],
            'last_name' => [
                'string',
            ],
            'emails' => [
                'array',
            ],
            'emails.*' => [
                'email',
                Rule::unique('emails', 'email')->where(function ($query) {
                    $clientId = $this->client;

                    return $query->find($clientId);
                }),
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
                Rule::unique('phone_numbers', 'number')->where(function ($query) {
                    $clientId = $this->client;

                    return $query->find($clientId);
                }),
                function ($attribute, $value, $fail) {
                    if (count(array_unique($this->request->get('emails'))) !== count($this->request->get('emails'))) {
                        $fail(trans('validation.must_be_unique'));
                    }
                },
            ],
        ];
    }
}
