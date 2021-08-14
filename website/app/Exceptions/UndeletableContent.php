<?php

namespace App\Exceptions;

use Exception;

class UndeletableContent extends Exception
{
    //
    public function render($request){
        return response()->json([
            'message' => 'errors.undeletable.content'
        ], 422);
    }
}
