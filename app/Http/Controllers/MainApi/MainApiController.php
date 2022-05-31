<?php

namespace App\Http\Controllers\MainApi;

use App\Exceptions\NotFoundHttpException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Cache;

abstract class MainApiController extends MainController
{
    protected abstract function HiddenValues(): object;
    protected abstract function GetModel(): Model;

    protected function GetAllData(): array
    {
        $HiddenValues = $this->HiddenValues()->index;
        $Model = $this->GetModel();

        $Query = $Model::all()->makeHidden($HiddenValues);

        $ResultArray = $Query->toArray();

        return $ResultArray;
    }

    protected function GetData(int $Id): array
    {
        $HiddenValues = $this->HiddenValues()->show;

        $Query = $this->FindId($Id);

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
        $this->ValidateId($Request);

        $Id = $Request->id;
        $ActionMethod = 'show';
        $ControllerName = $this->GetControllerName();

        $Key = "$ControllerName.$ActionMethod.$Id";
        $Minutes = 5 * 60;

        $Result = Cache::remember($Key, $Minutes, fn () => $this->GetData($Id));

        return $Result;
    }

    protected function FindId(int $Id): Model
    {
        $Model = $this->GetModel();

        $Result = $Model::find($Id);

        $NotFoundText = $this->NotFoundText();

        if (!$Result) throw new NotFoundHttpException($NotFoundText);

        return $Result;
    }
}
