<?php

namespace App\Services\Client;

use App\Collections\Clients\ClientsCollection;
use App\Contracts\Client\ClientServiceContract;
use App\DataObjects\Clients\SaveClientsDataObject;
use App\DataObjects\Clients\SearchClientsDataObject;
use App\Dictionaries\Clients\ClientSearchDictionary;
use App\Models\Client\Client;
use App\Models\Client\Email;
use App\Models\Client\PhoneNumber;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param  SaveClientsDataObject  $dataObject
     * @param  int|null               $clientId
     *
     * @return Client
     */
    public function saveClient(SaveClientsDataObject $dataObject, ?int $clientId = null): Client
    {
        DB::beginTransaction();

        if ($clientId === null) {
            $client = new Client();
        } else {
            $client = Client::query()->findOrFail($clientId);
        }

        $client->fill([
            'first_name' => $dataObject->getFirstName(),
            'last_name' => $dataObject->getLastName(),
        ])->save();

        $emails = [];
        foreach ((array)$dataObject->getEmails() as $email) {
            $emailModel = Email::query()
                ->where([
                    'email' => $email,
                ])->first();

            if ($emailModel === null) {
                $emailModel = Email::query()
                    ->create([
                        'email' => $email,
                    ]);
            }

            $emails[] = $emailModel->id;
        }

        $phoneNumbers = [];
        foreach ((array)$dataObject->getPhoneNumbers() as $phoneNumber) {
            $phoneNumberModel = PhoneNumber::query()
                ->where([
                    'number' => $phoneNumber,
                ])->first();

            if ($phoneNumberModel === null) {
                $phoneNumberModel = PhoneNumber::query()
                    ->create([
                        'number' => $phoneNumber,
                    ]);
            }

            $phoneNumbers[] = $phoneNumberModel->id;
        }

        $client->emails()->sync($emails);
        $client->phoneNumbers()->sync($phoneNumbers);

        DB::commit();

        return $client;
    }

    /**
     * @param  int  $clientId
     *
     * @return Client
     */
    public function getClient(int $clientId): Client
    {
        return Client::query()
            ->findOrFail($clientId);
    }

    /**
     * @param  int  $clientId
     *
     * @throws \Exception
     */
    public function destroyClient(int $clientId): void
    {
        Client::query()
            ->findOrFail($clientId)
            ->delete();
    }
}
