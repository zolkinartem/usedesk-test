<?php

namespace App\Services\Client;

use App\Collections\Clients\ClientsCollection;
use App\Contracts\Client\ClientServiceContract;
use App\DataObjects\Clients\SearchClientsDataObject;
use App\Dictionaries\Clients\ClientSearchDictionary;
use App\Models\Client\Client;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ClientService
 *
 * В более сложном проекте, я бы сюда возможно инъектил еще репозиторий.
 *
 * @package App\Services\Client
 */
class ClientService implements ClientServiceContract
{
    /**
     * @param  SearchClientsDataObject  $dataObject
     *
     * @return ClientsCollection
     */
    public function getClients(SearchClientsDataObject $dataObject): ClientsCollection
    {
        $query = Client::query();

        if ($dataObject->getSearchType() === ClientSearchDictionary::NAME) {
            $query->where([
                'first_name' => $dataObject->getFirstName(),
                'last_name' => $dataObject->getLastName(),
            ]);
        }

        if ($dataObject->getSearchType() === ClientSearchDictionary::EMAIL) {
            $email = $dataObject->getEmail();
            $query->whereHas('emails', static function (Builder $query) use ($email) {
                return $query->where([
                    'email' => $email,
                ]);
            });
        }

        if ($dataObject->getSearchType() === ClientSearchDictionary::PHONE_NUMBER) {
            $phoneNumber = $dataObject->getPhoneNumber();
            $query->whereHas('phoneNumbers', static function (Builder $query) use ($phoneNumber) {
                return $query->where([
                    'number' => $phoneNumber,
                ]);
            });
        }

        if ($dataObject->getSearchType() === ClientSearchDictionary::ALL) {
            $search = $dataObject->getAll();

            $query->orWhere([
                'last_name' => $search,
            ]);

            $query->orWhere([
                'first_name' => $search,
            ]);

            $query->orWhereHas('emails', static function (Builder $query) use ($search) {
                return $query->where([
                    'email' => $search,
                ]);
            });

            $query->orWhereHas('phoneNumbers', static function (Builder $query) use ($search) {
                return $query->where([
                    'number' => $search,
                ]);
            });
        }

        return $query->get();
    }
}
