<?php

namespace App\Models\Client;

use App\Collections\Clients\PhoneNumbersCollection;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class PhoneNumber
 *
 * @package App\Models\Client
 */
class PhoneNumber extends BaseModel
{
    protected $fillable = [
        'number',
    ];

    protected $casts = [
        'number' => 'string',
    ];

    /**
     * @param  array  $models
     *
     * @return PhoneNumbersCollection
     */
    public function newCollection(array $models = []): PhoneNumbersCollection
    {
        return new PhoneNumbersCollection($models);
    }

    /**
     * @return BelongsToMany
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class)
            ->using(ClientEmail::class)
            ->orderByDesc('id');
    }
}
