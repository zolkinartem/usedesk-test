<?php

namespace App\Providers;

use App\Contracts\Client\ClientServiceContract;
use App\Contracts\Logs\LogsServiceContract;
use App\Services\Client\ClientService;
use App\Services\Logs\LogsService;
use Illuminate\Support\ServiceProvider;

/**
 * Class ServicesProvider
 *
 * @package App\Providers
 */
class ServicesProvider extends ServiceProvider
{
    /**
     * @var array<string, string>
     */
    public array $singletons = [
        LogsServiceContract::class => LogsService::class,
        ClientServiceContract::class => ClientService::class,
    ];
}
