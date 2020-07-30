<?php

namespace App\Http\Controllers;

use App\Contracts\Logs\LogsServiceContract;
use App\DataObjects\Logs\LogsDataObject;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BaseController
 *
 * @package App\Http\Controllers
 */
class BaseController extends Controller
{
    /**
     * @var LogsServiceContract
     */
    protected LogsServiceContract $service;

    /**
     * BaseController constructor.
     *
     * @param  LogsServiceContract  $service
     */
    public function __construct(LogsServiceContract $service)
    {
        $this->service = $service;
    }

    /**
     * @param  string  $method
     * @param  array   $parameters
     *
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        $user =  Auth::user();
        if ($user !== null) {
            $dataObject = (new LogsDataObject())
                ->setUser($user)
                ->setAction($method)
                ->setParameters($parameters);

            $this->service->save($dataObject);

            return parent::callAction($method, $parameters);
        }

        abort(Response::HTTP_UNAUTHORIZED);
    }
}
