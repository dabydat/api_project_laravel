<?php
namespace App\Helpers;

use App\Constants\JsonResponseConstants;

class JsonResponseHelper
{
    // Funcion para devolver respuesta success
    public static function success($message = "Successful Operation", $data = null)
    {
        $json = ['meta' => ['success' => true, 'errors' => []], 'data' => $data];
        return response()->json($json, 200);
    }

    // Funcion para devolver respuesta error
    public static function error($message = 'Internal Server Error', $hint = null)
    {
        $json = ['meta' => ['success' => false, 'errors' => [$message]], 'data' => null];
        if (env('APP_ENV') == 'local' && $hint) { $json['meta']['errors'][] = $hint; }
        return response()->json($json, 500);
    }

    // Funcion para devolver respuesta not found
    public static function notFound($message = 'Not Found')
    {
        $json = ['meta' => ['success' => false, 'errors' => [$message]], 'data' => null];
        return response()->json($json, 404);
    }

    // Funcion para devolver respuesta forbidden
    public static function forbidden($message = 'Forbidden')
    {
        $json = ['meta' => ['success' => false, 'errors' => [$message]], 'data' => null];
        return response()->json($json, 403);
    }

    // Funcion para devolver respuesta unauthorized
    public static function unauthorized($message = 'Unauthorized')
    {
        $json = ['meta' => ['success' => false, 'errors' => [$message]], 'data' => null];
        return response()->json($json, 401);
    }

    // Funcion para devolver respuesta de un recurso creado en la Base de datos
    public static function resourceCreated($message = "Successful Operation", $data = null)
    {
        $json = ['meta' => ['success' => true, 'errors' => []], 'data' => $data];
        return response()->json($json, 201);
    }
}