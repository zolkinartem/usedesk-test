<?php

namespace App\Http\Controllers;

use App\Contracts\Client\ClientServiceContract;
use App\DataObjects\Clients\SaveClientsDataObject;
use App\DataObjects\Clients\SearchClientsDataObject;
use App\Http\Requests\Clients\ClientsSearchRequest;
use App\Http\Requests\Clients\ClientsStoreRequest;
use App\Http\Requests\Clients\ClientsUpdateRequest;
use App\Http\Resources\Clients\ClientResource;
use App\Http\Resources\Clients\ClientResourceCollection;
use Illuminate\Http\Response;

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
     * @param  ClientsSearchRequest  $request
     *
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

    /**
     * @param  ClientsStoreRequest  $request
     *
     * @return ClientResource
     */
    public function store(ClientsStoreRequest $request): ClientResource
    {
        $validatedData = $request->validated();

        $dataObject = (new SaveClientsDataObject())
            ->setFirstName($validatedData['first_name'])
            ->setLastName($validatedData['last_name']);

        if (isset($validatedData['emails']) === true) {
            $dataObject->setEmails($validatedData['emails']);
        }

        if (isset($validatedData['phone_numbers']) === true) {
            $dataObject->setPhoneNumbers($validatedData['phone_numbers']);
        }

        $client = $this->service->saveClient($dataObject);

        return ClientResource::make($client);
    }

    /**
     * @param  ClientsUpdateRequest  $request
     * @param  int                   $clientId
     *
     * @return ClientResource
     */
    public function update(ClientsUpdateRequest $request, int $clientId): ClientResource
    {
        $validatedData = $request->validated();

        $dataObject = new SaveClientsDataObject();

        if (isset($validatedData['first_name']) === true) {
            $dataObject->setFirstName($validatedData['first_name']);
        }

        if (isset($validatedData['last_name']) === true) {
            $dataObject->setLastName($validatedData['last_name']);
        }

        if (isset($validatedData['emails']) === true) {
            $dataObject->setEmails($validatedData['emails']);
        }

        if (isset($validatedData['phone_numbers']) === true) {
            $dataObject->setPhoneNumbers($validatedData['phone_numbers']);
        }

        $client = $this->service->saveClient($dataObject, $clientId);

        return ClientResource::make($client);
    }

    /**
     * @param  int  $clientId
     *
     * @return ClientResource
     */
    public function show(int $clientId): ClientResource
    {
        $client = $this->service->getClient($clientId);

        return ClientResource::make($client);
    }

    /**
     * @param  int  $clientId
     *
     * @return Response
     */
    public function destroy(int $clientId): Response
    {
        $this->service->destroyClient($clientId);

        return response()->noContent();
    }
}
