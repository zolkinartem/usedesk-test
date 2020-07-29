<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class ClientEmail
 *
 * @package App\Models\Client
 */
class ClientEmail extends Pivot
{
    public $incrementing = true;
}
