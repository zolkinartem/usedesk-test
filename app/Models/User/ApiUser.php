<?php

namespace App\Models\User;

use App\Collections\Users\ApiUsersCollection;
use App\Models\Logs\Log;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class ApiUser
 *
 * @package App\Models\User
 */
class ApiUser extends Authenticatable
{
    protected $fillable = [
        'name',
        'api_token',
    ];

    protected $casts = [
        'name' => 'string',
        'api_token' => 'string',
    ];

    /**
     * @param  array  $models
     *
     * @return ApiUsersCollection
     */
    public function newCollection(array $models = []): ApiUsersCollection
    {
        return new ApiUsersCollection($models);
    }

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(Log::class)
            ->orderBy('id');
    }
}
