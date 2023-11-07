<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse(string $message = 'Success', int $status = 200, ...$data)
    {
        return response()->json([
            'messages' => $message,
            ...$data
        ], $status);
    }
}
