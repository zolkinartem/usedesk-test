<?php

namespace App\Models\Client;

use App\Collections\Clients\EmailsCollection;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Email
 *
 * @package App\Models\Client
 */
class Email extends BaseModel
{
    protected $fillable = [
        'email',
    ];

    protected $casts = [
        'email' => 'string',
    ];

    /**
     * @param  array  $models
     *
     * @return EmailsCollection
     */
    public function newCollection(array $models = []): EmailsCollection
    {
        return new EmailsCollection($models);
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
