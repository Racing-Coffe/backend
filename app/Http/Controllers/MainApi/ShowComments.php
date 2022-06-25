<?php

namespace App\Http\Controllers\MainApi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * Trait used in Controllers with relationship with Comments
 */
trait ShowComments
{
    protected abstract function HiddenValuesComments(): array;

    /**
     * Return all the Comments from an Post Id
     * 
     * @param int $Id
     * @return array
     */
    protected function GetComments(int $Id): array
    {
        $Query = $this->FindId($Id);

        $Comments = $Query->comments()->simplePaginate(2);

        $HiddenValues = $this->HiddenValuesComments();

        $Data = $Comments->makeHidden($HiddenValues)->toArray();
        $Query->data = $Data;

        $CommentsArray = $Comments->toArray();

        return $CommentsArray;
    }

    public function showComments(Request $Request)
    {
        $this->ValidateId($Request);

        $Id = $Request->id;
        $Page = $Request->page;
        $ActionMethod = "showComments-$Page";
        $ControllerName = $this->GetControllerName();

        $Key = "$ControllerName.$ActionMethod.$Id";
        $Minutes = 5 * 60;

        $Result = Cache::remember($Key, $Minutes, fn () => $this->GetComments($Id));

        return $Result;
    }
}
