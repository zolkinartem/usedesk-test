<?php

namespace App\Http\Requests\Clients;

use App\Dictionaries\Clients\ClientSearchDictionary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ClientsSearchRequest
 *
 * @package App\Http\Requests\Clients
 */
class ClientsSearchRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'string',
                Rule::requiredIf(function () {
                    return $this->request->get('search_type') === ClientSearchDictionary::NAME;
                }),
            ],
            'last_name' => [
                'string',
                Rule::requiredIf(function () {
                    return $this->request->get('search_type') === ClientSearchDictionary::NAME;
                }),
            ],
            'phone_number' => [
                'string',
                Rule::requiredIf(function () {
                    return $this->request->get('search_type') === ClientSearchDictionary::PHONE_NUMBER;
                }),
            ],
            'email' => [
                'email',
                Rule::requiredIf(function () {
                    return $this->request->get('search_type') === ClientSearchDictionary::EMAIL;
                }),
            ],
            'all' => [
                'string',
                Rule::requiredIf(function () {
                    return $this->request->get('search_type') === ClientSearchDictionary::ALL;
                }),
            ],
            'search_type' => [
                'string',
                Rule::in([
                    ClientSearchDictionary::NAME,
                    ClientSearchDictionary::EMAIL,
                    ClientSearchDictionary::PHONE_NUMBER,
                    ClientSearchDictionary::ALL]),
            ],
        ];
    }
}
