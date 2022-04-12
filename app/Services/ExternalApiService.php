<?php
/**
 * Created by PhpStorm.
 * User: TinyPoro
 * Date: 4/12/22
 * Time: 11:55 PM
 */

namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ExternalApiService implements ExternalApiServiceInterface
{
    private $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    public function getSourceDetail(int $id)
    {
        $xRequestId = request()->header('x-request-id');
        $url = env('EXTERNAL_URL_API_MOBILE') . "/api/v2/sources/detail/$id";

        try {
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'X-Token' => request()->header('X-Token'),
                ]
            ]);
            Log::info(getInfoLogMessage(__FILE__, __LINE__, '[getSourceDetail] Response : x-request-id : ' . $xRequestId . ' Http code: ' . $response->getStatusCode()));

            return $response;
        } catch (\Exception $e) {
            Log::error(getExceptionLogMessage($e, "ERROR"));
            throw $e;
        }
    }
}