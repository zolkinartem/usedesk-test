<?php

namespace App\Http\Resources\Clients;

use App\Http\Resources\BaseResourceCollection;

/**
 * Class UserResourceCollection
 *
 * @package App\Http\Resources\User
 */
class ClientResourceCollection extends BaseResourceCollection
{
    public $collects = ClientResource::class;
}
