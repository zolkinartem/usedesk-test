<?php

namespace App\Models\User;

use App\Collections\Users\ApiUsersCollection;
use App\Models\BaseModel;
use App\Models\Logs\Log;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ApiUser
 *
 * @package App\Models\User
 */
class ApiUser extends BaseModel implements AuthenticatableContract
{
    use Authenticatable;

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
