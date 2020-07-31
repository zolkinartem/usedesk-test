<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class BaseResourceCollection
 *
 * @package App\Http\Resources
 */
abstract class BaseResourceCollection extends ResourceCollection
{
    public static $wrap = null;
}
