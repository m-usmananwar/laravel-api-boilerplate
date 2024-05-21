<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function handleException($e)
    {
        $className = get_class($e);

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
            return response()->error($e->getMessage(), $e->getStatusCode());
        } else if ($className == "Illuminate\Validation\ValidationException") {
            return response()->error($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, ["errors" => $e->errors()]);
        } else if ($className == "Illuminate\Database\QueryException") {
            return response()->error("Internal Server Error", Response::HTTP_INTERNAL_SERVER_ERROR);
        } else if ($className == "Illuminate\Database\Eloquent\ModelNotFoundException") {
            return response()->error("Record Not Found", Response::HTTP_NOT_FOUND);
        } else {
            return response()->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
