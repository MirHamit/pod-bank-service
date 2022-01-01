<?php
/**
 * @author Həmid Musəvi <w1w@yahoo.com>
 * 11/16/21
 */

namespace MirHamit\PodBankService\Services;

use Illuminate\Support\Facades\Http;

class DataSender
{
    private $requestUrl = 'https://api.pod.ir/srv/sc/nzh/doServiceCall';

    public static function sendRequest($headers, $requestData, bool $bankData = true)
    {
        return (new DataSender)->sendHttpRequest($headers, $requestData, $bankData);
    }

    public static function sign($dataToSign): string
    {
        return (new DataSender)->signData($dataToSign);
    }

    private function sendHttpRequest($headers, $requestData)
    {
        $req = Http::asForm()->withHeaders($headers)->post($this->requestUrl, $requestData);
        $result = $req->body();
        if ($this->isJson($req->body())) {
            $result = json_decode($req->body());
            if (!$result->hasError) {
                if ($this->isJson($result->result->result)) {
                    $result->result->result = json_decode($result->result->result);
                }
            }
        }
        return $result;
    }

    private function signData($dataToSign): string
    {
        $signature = null;

        openssl_sign($dataToSign, $signature, config('pod.pod_PRIVATE_KEY'), OPENSSL_ALGO_SHA1);

        return base64_encode($signature);
    }

    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
