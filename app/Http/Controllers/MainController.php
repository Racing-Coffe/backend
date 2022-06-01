<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

abstract class MainController extends Controller
{
    protected abstract function GetControllerName(): string;
    protected abstract function GetModel(): Model;

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

    /**
     * Return a Model instance with the given ID.
     *
     * @param  int  $Id
     * @throws \App\Exceptions\NotFoundHttpException if the ID is not found.
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function FindId(int $Id): Model
    {
        $Model = $this->GetModel();

        $Result = $Model::find($Id);

        $NotFoundText = $this->NotFoundText();

        if (!$Result) throw new NotFoundHttpException($NotFoundText);

        return $Result;
    }

    protected function NotFound(): Response
    {
        return response(['Error' => $this->NotFoundText()], 404);
    }

    protected abstract function NotFoundText(): string;
}
