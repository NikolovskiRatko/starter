<?php

namespace App\Exceptions;

use Exception;

class NotFoundAPIException extends Exception
{
    //
    public function render($request){
        return response()->json([
            'message' => 'Record not found'
        ], 404);
    }
}
