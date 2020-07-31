<?php

namespace App\Contracts\Client;

use App\Collections\Clients\ClientsCollection;
use App\DataObjects\Clients\SaveClientsDataObject;
use App\DataObjects\Clients\SearchClientsDataObject;
use App\Models\Client\Client;

/**
 * Interface ClientServiceContract
 *
 * @package App\Contracts\Client
 */
interface ClientServiceContract
{
    /**
     * @param  SearchClientsDataObject  $dataObject
     *
     * @return ClientsCollection
     */
    public function getClients(SearchClientsDataObject $dataObject): ClientsCollection;

    /**
     * @param  SaveClientsDataObject  $dataObject
     * @param  int|null               $clientId
     *
     * @return Client
     */
    public function saveClient(SaveClientsDataObject $dataObject, ?int $clientId = null): Client;

    /**
     * @param  int  $clientId
     *
     * @return Client
     */
    public function getClient(int $clientId): Client;

    /**
     * @param  int  $clientId
     */
    public function destroyClient(int $clientId): void;
}
