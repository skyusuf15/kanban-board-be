<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * @param array $data
     * @param int   $httpStatusCode
     * @param array $header
     *
     * @return JsonResponse
     */
    protected function sendSuccess(mixed $data, int $httpStatusCode = 200, array $header = []): JsonResponse
    {
        $responseData = ["status" => "success", "data" => $data];
        return $this->sendResponse($responseData, $httpStatusCode, $header);
    }

    /**
     * @param string $message
     * @param int    $code
     * @param int    $httpStatusCode
     * @param array  $header
     *
     * @return JsonResponse
     */
    protected function sendError(string $message, int $code, int $httpStatusCode = 500, array $header = []): JsonResponse
    {
        $responseData = ["status" => "error", "message" => $message, "code" => $code];

        return $this->sendResponse($responseData, $httpStatusCode, $header);
    }

    /**
     * @param array $data
     * @param int   $httpStatusCode
     * @param array $header
     *
     * @return JsonResponse
     */
    private function sendResponse(array $data, int $httpStatusCode, array $header = []): JsonResponse
    {
        $response = response()->json($data)->setStatusCode($httpStatusCode);

        foreach ($header as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}
