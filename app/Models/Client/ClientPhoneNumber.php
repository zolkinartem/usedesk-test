<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class ClientPhoneNumber
 *
 * @package App\Models\Client
 */
class ClientPhoneNumber extends Pivot
{
    public $incrementing = true;
}
