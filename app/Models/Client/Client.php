<?php

namespace App\Models\Client;

use App\Collections\Clients\ClientsCollection;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Client
 *
 * @package App\Models\Client
 */
class Client extends BaseModel
{
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
    ];

    /**
     * @param  array  $models
     *
     * @return ClientsCollection
     */
    public function newCollection(array $models = []): ClientsCollection
    {
        return new ClientsCollection($models);
    }

    /**
     * @return BelongsToMany
     */
    public function emails(): BelongsToMany
    {
        return $this->belongsToMany(Email::class)
            ->using(ClientEmail::class)
            ->orderByDesc('id');
    }

    /**
     * @return BelongsToMany
     */
    public function phoneNumbers(): BelongsToMany
    {
        return $this->belongsToMany(PhoneNumber::class)
            ->using(ClientPhoneNumber::class)
            ->orderByDesc('id');
    }
}
