<?php

namespace App\Services\Logs;

use App\Contracts\Logs\LogsServiceContract;
use App\DataObjects\Logs\LogsDataObject;
use App\Models\Logs\Log;

/**
 * Class UserService
 *
 * @package App\Modules\User\Services
 */
class LogsService implements LogsServiceContract
{
    /**
     * @param  LogsDataObject  $dataObject
     *
     * @return Log
     */
    public function save(LogsDataObject $dataObject): Log
    {
        return $dataObject->getUser()
            ->logs()
            ->create([
                'action' => $dataObject->getAction(),
                'parameters' => json_encode($dataObject->getParameters(), JSON_THROW_ON_ERROR),
            ]);
    }
}
