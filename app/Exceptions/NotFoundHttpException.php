<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class NotFoundHttpException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render(Request $Request)
    {
        return response(['Error' => $this->getMessage()], 404);
    }
}
