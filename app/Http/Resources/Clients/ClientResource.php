<?php

namespace App\Http\Resources\Clients;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * Class ClientResource
 *
 * @package App\Http\Resources\Clients
 */
class ClientResource extends BaseResource
{
    /**
     * @param  Request  $request
     *
     * @return array<string, string>
     */
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            'id' => $this->resource->id,
            'first_name' => $this->resource->first_name,
            'last_name' => $this->resource->last_name,
        ]);
    }
}
