<?php

namespace App\Models\Logs;

use App\Collections\Logs\LogsCollection;
use App\Models\BaseModel;
use App\Models\User\ApiUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Log
 *
 * @package App\Models\Logs
 */
class Log extends BaseModel
{
    protected $fillable = [
        'api_user_id',
        'action',
        'parameters',
    ];

    protected $casts = [
        'api_user_id' => 'integer',
        'action' => 'string',
        'parameters' => 'string',
    ];

    /**
     * @param  array  $models
     *
     * @return LogsCollection
     */
    public function newCollection(array $models = []): LogsCollection
    {
        return new LogsCollection($models);
    }

    /**
     * @return BelongsTo
     */
    public function apiUser(): BelongsTo
    {
        return $this->belongsTo(ApiUser::class);
    }
}
