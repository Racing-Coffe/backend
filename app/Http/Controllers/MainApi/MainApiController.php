<?php

namespace App\Http\Controllers\MainApi;

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

        $HiddenValues = $this->HiddenValues()->show;
        $Model = $this->GetModel();

        $Result = $Model::find($Request->id);

        if (!$Result) return $this->NotFound();

        $ResultArray = $Result->makeHidden($HiddenValues)->toArray();

        return $ResultArray;
    }

    protected function FindId($Id)
    {
        $Model = $this->GetModel();

        $Result = $Model::find($Id);

        return $Result ? $Result : false;
    }
}
