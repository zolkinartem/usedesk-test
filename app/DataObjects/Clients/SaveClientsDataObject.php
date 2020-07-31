<?php

namespace App\DataObjects\Clients;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class SaveClientsDataObject
 *
 * @package App\DataObjects\Clients
 */
class SaveClientsDataObject implements Arrayable
{
    /**
     * @var string
     */
    protected string $firstName;

    /**
     * @var string
     */
    protected string $lastName;

    /**
     * @var array|null
     */
    protected ?array $emails = null;

    /**
     * @var array|null
     */
    protected ?array $phoneNumbers = null;

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param  string  $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param  string  $lastName
     *
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getEmails(): ?array
    {
        return $this->emails;
    }

    /**
     * @param  array|null  $emails
     *
     * @return $this
     */
    public function setEmails(?array $emails): self
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getPhoneNumbers(): ?array
    {
        return $this->phoneNumbers;
    }

    /**
     * @param  array|null  $phoneNumbers
     *
     * @return $this
     */
    public function setPhoneNumbers(?array $phoneNumbers): self
    {
        $this->phoneNumbers = $phoneNumbers;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'emails' => $this->getEmails(),
            'phoneNumbers' => $this->getPhoneNumbers(),
        ];
    }
}
