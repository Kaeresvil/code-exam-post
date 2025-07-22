<?php

namespace App\Services\Utils;

class ResponseService implements ResponseServiceInterface {

    public function authResponse($message, $data) {
        return response()->json(
            [
                "message" => $message,
                "data" => $data
            ],
        200);
    }

    public function resolveResponse($message, $data) {
        return response()->json(
            [
                "message" => $message,
                "data" => $data
            ],
        200);
    }
    
    public function rejectResponse($message, $data) {
        return response()->json(
            [
                "message" => $message,
                "data" => $data
            ],
        500);
    }

    public function duplicateResponse($message, $data) {
        return response()->json(
            [
                "message" => $message,
                "data" => $data
            ],
        422);
    }

    

    public function successResponse($model, $data)
    {
        $message = __('message.fetch_success', ['name' => $model]);

        return response()->json(
            [
                "message" => $message,
                "data" => $data
            ],
            200
        );
    }


    public function showResponse($model, $data)
    {
        $message = __('message.show_success', ['name' => $model]);

        return response()->json(
            [
                "message" => $message,
                "data" => $data
            ],
            200
        );
    }

 
    public function storeResponse($model, $data)
    {
        $message = __('message.create_success', ['name' => $model]); 

        return response()->json(
            [
                "message" => $message,
                "data" => $data
            ],
            201
        );
    }


    public function updateResponse($model, $data)
    {
        $message = __('message.update_success', ['name' => $model]);

        return response()->json(
            [
                "message" => $message,
                "data" => $data
            ],
            202
        );
    }


    public function deleteResponse($model)
    {
        $message = __('message.delete_success', ['name' => $model]);

        return response()->json(
            [
                "message" => $message,
            ],
            202
        );
    }

    public function restoreResponse($model)
    {
        $message = __('message.restore_success', ['name' => $model]);

        return response()->json(
            [
                "message" => $message,
            ],
            200
        );
    }


        public function disabledResponse($model, $data)
        {
            $message =  $model.' Disabled Successfully';
    
            return response()->json(
                [
                    "message" => $message,
                    "data" => $data
                ],
                200
            );
        }
}