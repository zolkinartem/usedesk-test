<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BaseResource
 *
 * @package App\Http\Resources
 */
abstract class BaseResource extends JsonResource
{
    public static $wrap = null;

    /**
     * @param  Request  $request
     *
     * @return array<string, string>
     */
    public function toArray($request): array
    {
        return [];
    }
}
