<?php

namespace App\DataObjects\Logs;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class LogsDataObject
 *
 * @package App\DataObjects\Logs
 */
class LogsDataObject implements Arrayable
{
    /**
     * @var Authenticatable
     */
    protected Authenticatable $user;

    /**
     * @var string
     */
    protected string $action;

    /**
     * @var array
     */
    protected array $parameters;

    /**
     * @return Authenticatable
     */
    public function getUser(): Authenticatable
    {
        return $this->user;
    }

    /**
     * @param  Authenticatable  $user
     *
     * @return $this
     */
    public function setUser(Authenticatable $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param  string  $action
     *
     * @return $this
     */
    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param  array  $parameters
     *
     * @return $this
     */
    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user' => $this->getUser(),
            'action' => $this->getAction(),
            'parameters' => $this->getParameters(),
        ];
    }
}
