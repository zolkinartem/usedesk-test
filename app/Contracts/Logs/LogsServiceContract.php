<?php

namespace App\Contracts\Logs;

use App\DataObjects\Logs\LogsDataObject;
use App\Models\Logs\Log;

/**
 * Interface LogsServiceContract
 *
 * @package App\Contracts\Logs
 */
interface LogsServiceContract
{
    /**
     * @param  LogsDataObject  $dataObject
     *
     * @return Log
     */
    public function save(LogsDataObject $dataObject): Log;
}
