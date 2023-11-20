<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {

        $response = [
            'success' => true,
            'date' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages=[],$code=404 )
    {

        $request = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['date']= $errorMessages;
        }
        return response()->json($response, $code);
    }
}
