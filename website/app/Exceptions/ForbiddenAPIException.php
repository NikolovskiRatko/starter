<?php

namespace App\Exceptions;

use Exception;

class ForbiddenAPIException extends Exception
{
    //
    public function render($request){
        return response()->json([
            'message' => 'Forbidden action!'
        ], 403);
    }
}
