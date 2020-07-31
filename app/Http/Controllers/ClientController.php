<?php

namespace App\Http\Controllers;

use App\Contracts\Client\ClientServiceContract;
use App\DataObjects\Clients\SearchClientsDataObject;
use App\Http\Requests\Clients\ClientsSearchRequest;
use App\Http\Resources\Clients\ClientResourceCollection;

/**
 * Class ClientController
 *
 * @package App\Http\Controllers
 */
class ClientController extends BaseController
{
    /**
     * @var ClientServiceContract
     */
    protected ClientServiceContract $service;

    /**
     * BaseController constructor.
     *
     * @param  ClientServiceContract  $service
     */
    public function __construct(ClientServiceContract $service)
    {
        $this->service = $service;
    }

    /**
     * @return ClientResourceCollection
     */
    public function index(ClientsSearchRequest $request): ClientResourceCollection
    {
        $validatedData = $request->validated();

        $dataObject = new SearchClientsDataObject();

        if (isset($validatedData['search_type']) === true) {
            $dataObject->setSearchType($validatedData['search_type']);
        }

        if (isset($validatedData['first_name']) === true) {
            $dataObject->setFirstName($validatedData['first_name']);
        }

        if (isset($validatedData['last_name']) === true) {
            $dataObject->setLastName($validatedData['last_name']);
        }

        if (isset($validatedData['email']) === true) {
            $dataObject->setEmail($validatedData['email']);
        }

        if (isset($validatedData['phone_number']) === true) {
            $dataObject->setPhoneNumber($validatedData['phone_number']);
        }

        if (isset($validatedData['all']) === true) {
            $dataObject->setAll($validatedData['all']);
        }

        return new ClientResourceCollection($this->service->getClients($dataObject));
    }
}
