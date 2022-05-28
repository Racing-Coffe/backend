<?php

namespace App\Http\Controllers\MainApi;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MainController;

abstract class MainApiController extends MainController
{
    protected abstract function HiddenValues(): object;
    protected abstract function GetModel(): Model;

    public function index(Request $Request)
    {
        $HiddenValues = $this->HiddenValues()->index;
        $Model = $this->GetModel();

        $Result = $Model::all()->makeHidden($HiddenValues);

        $ResultArray = $Result->toArray();

        return $ResultArray;
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
