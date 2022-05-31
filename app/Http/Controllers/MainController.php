<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

abstract class MainController extends Controller
{
    protected function ValidateId(Request $Request)
    {
        $Request->merge(['id' => $Request->id]);
        $Validation = ['id' => 'required|integer'];
        $Validator = Validator::make($Request->all(), $Validation);

        return !$Validator->fails();
    }

    protected function NotFound(): Response
    {
        return response(['Error' => $this->NotFoundText()], 404);
    }

    protected abstract function NotFoundText(): string;
}
