<?php

namespace App\Http\Controllers\MainApi;

use App\Exceptions\NotFoundHttpException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Cache;

/**
 * The MainController Abstract Class has Index and Show methods to hand an Request.
 */
abstract class MainApiController extends MainController
{
    /**
     * Return the Database Values to be Hidden.
     * 
     * @return object
     */
    protected abstract function HiddenValues(): object;

    /**
     * Return all the Data from the Model
     * 
     * @return array
     */
    protected function GetAllData(): array|false
    {
        $HiddenValues = $this->HiddenValues()->index;
        $Model = $this->GetModel();

        $Query = $Model::simplePaginate(3);

        if ($Query->isEmpty()) return false;

        $Data = $Query->makeHidden($HiddenValues);
        $Query->data = $Data;

        $ResultArray = $Query->toArray();

        return $ResultArray;
    }

    /**
     * Return an array with the given ID from the Model.
     * 
     * @param int $Id
     * @return array
     */
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
        $Page = $Request->page;
        $ActionMethod = 'index-' . $Page;
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
}
