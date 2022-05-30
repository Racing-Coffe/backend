<?php

namespace App\Http\Controllers\MainApi;

use App\Exceptions\NotFoundHttpException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Cache;

abstract class MainApiController extends MainController
{
    protected abstract function GetControllerName(): string;
    protected abstract function HiddenValues(): object;
    protected abstract function GetModel(): Model;

    protected function GetAllData()
    {
        $HiddenValues = $this->HiddenValues()->index;
        $Model = $this->GetModel();

        $Query = $Model::all()->makeHidden($HiddenValues);

        $ResultArray = $Query->toArray();

        return $ResultArray;
    }

    protected function GetData($Id)
    {
        $HiddenValues = $this->HiddenValues()->show;
        $Model = $this->GetModel();

        $Query = $Model::find($Id);

        if (!$Query) return $this->NotFound();

        $ResultArray = $Query->makeHidden($HiddenValues)->toArray();

        return $ResultArray;
    }

    public function index(Request $Request)
    {
        $ActionMethod = 'index';
        $ControllerName = $this->GetControllerName();

        $Key = "$ControllerName.$ActionMethod";
        $Minutes = 5 * 60;

        $Result = Cache::remember($Key, $Minutes, fn () => $this->GetAllData());

        return $Result;
    }

    public function show(Request $Request)
    {
        if (!$this->ValidateId($Request)) return $this->NotFound();

        $Id = $Request->id;
        $ActionMethod = 'show';
        $ControllerName = $this->GetControllerName();

        $Key = "$ControllerName.$ActionMethod.$Id";
        $Minutes = 5 * 60;

        $Result = Cache::remember($Key, $Minutes, fn () => $this->GetData($Id));

        return $Result;
    }

    protected function FindId($Id)
    {
        $Model = $this->GetModel();

        $Result = $Model::find($Id);

        $NotFoundText = $this->NotFoundText();

        if (!$Result) throw new NotFoundHttpException($NotFoundText);

        return $Result ? $Result : false;
    }
}
