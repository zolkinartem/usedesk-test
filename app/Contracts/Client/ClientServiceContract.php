<?php

namespace App\Contracts\Client;

use App\Collections\Clients\ClientsCollection;
use App\DataObjects\Clients\SearchClientsDataObject;

/**
 * Interface ClientServiceContract
 *
 * @package App\Contracts\Client
 */
interface ClientServiceContract
{
    /**
     * @return ClientsCollection
     */
    public function getClients(SearchClientsDataObject $dataObject): ClientsCollection;
}
