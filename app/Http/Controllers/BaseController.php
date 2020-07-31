<?php

namespace App\Http\Controllers;

use App\Contracts\Logs\LogsServiceContract;
use App\DataObjects\Logs\LogsDataObject;
use Illuminate\Contracts\Container\BindingResolutionException;
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
     * @param  string  $method
     * @param  array   $parameters
     *
     * @return mixed
     * @throws BindingResolutionException
     */
    public function callAction($method, $parameters)
    {
        $user =  Auth::user();
        if ($user !== null) {
            $dataObject = (new LogsDataObject())
                ->setUser($user)
                ->setAction($method)
                ->setParameters($parameters);

            $logService = app()->make(LogsServiceContract::class);
            $logService->save($dataObject);

            return parent::callAction($method, $parameters);
        }

        abort(Response::HTTP_UNAUTHORIZED);
    }
}
