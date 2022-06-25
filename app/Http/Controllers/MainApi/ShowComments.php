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

    public function showComments(Request $Request)
    {
        return ["Text" => "Hello"];
    }
}
