<?php

namespace App\Dictionaries\Clients;

use App\Dictionaries\BaseDictionary;

/**
 * Class ClientSearchDictionary
 *
 * @package App\Dictionaries\Clients
 */
class ClientSearchDictionary extends BaseDictionary
{
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PHONE_NUMBER = 'phone_number';
    public const ALL = 'all';
}
