<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

abstract class MainController extends Controller
{
    protected abstract function GetControllerName(): string;

    protected function ValidateId(Request $Request): bool
    {
        $Request->merge(['id' => $Request->id]);
        $Validation = ['id' => 'required|integer'];
        $Validator = Validator::make($Request->all(), $Validation);

        $Fail = $Validator->fails();
        $NotFoundText = $this->NotFoundText();

        if ($Fail) throw new NotFoundHttpException($NotFoundText);

        return true;
    }

    protected function NotFound(): Response
    {
        return response(['Error' => $this->NotFoundText()], 404);
    }

    protected abstract function NotFoundText(): string;
}
