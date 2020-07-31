<?php

namespace App\DataObjects\Clients;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class SearchClientsDataObject
 *
 * @package App\DataObjects\Clients
 */
class SearchClientsDataObject implements Arrayable
{
    /**
     * @var string
     */
    protected string $searchType;

    /**
     * @var string|null
     */
    protected ?string $firstName = null;

    /**
     * @var string|null
     */
    protected ?string $lastName = null;

    /**
     * @var string|null
     */
    protected ?string $email = null;

    /**
     * @var string|null
     */
    protected ?string $phoneNumber = null;

    /**
     * @var string|null
     */
    protected ?string $all = null;

    /**
     * @return string
     */
    public function getSearchType(): string
    {
        return $this->searchType;
    }

    /**
     * @param  string  $searchType
     *
     * @return $this
     */
    public function setSearchType(string $searchType): self
    {
        $this->searchType = $searchType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param  string|null  $firstName
     *
     * @return $this
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param  string|null  $lastName
     *
     * @return $this
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param  string|null  $email
     *
     * @return $this
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param  string|null  $phoneNumber
     *
     * @return $this
     */
    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAll(): ?string
    {
        return $this->all;
    }

    /**
     * @param  string|null  $all
     *
     * @return $this
     */
    public function setAll(?string $all): self
    {
        $this->all = $all;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'searchType' => $this->getSearchType(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' => $this->getEmail(),
            'phoneNumber' => $this->getPhoneNumber(),
            'all' => $this->getAll(),
        ];
    }
}
