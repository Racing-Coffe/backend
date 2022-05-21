<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class MainController extends Controller
{
    protected function ValidateId(Request $Request)
    {
        $Request->merge(['id' => $Request->id]);
        $Validation = ['id' => 'required|integer'];
        $Validator = Validator::make($Request->all(), $Validation);

        return ! $Validator->fails();
    }

    protected abstract function NotFound();
}