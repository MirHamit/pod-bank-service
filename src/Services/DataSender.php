<?php
/**
 * @author Həmid Musəvi <w1w@yahoo.com>
 * 11/16/21
 */

namespace MirHamit\PodBankService\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

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

    private function sendHttpRequest($headers, $requestData, bool $bankData = true)
    {
        $res = [];

        $req = Http::asForm()->withHeaders($headers)->post($this->requestUrl, $requestData);
        $reqBody = json_decode($req->body());

        $res['data'] = $reqBody;
        if ($bankData) {
            if ($req->successful()) {
                if ($res['data']->hasError == false) {
                    $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $reqBody->result->result);
                    try {
                        $xml = new SimpleXMLElement($response);
                    } catch (Exception $e) {
                        return response('مشکلی در پردازش داده ها به وجود آمده است.'."<br>"
                            .$e->getMessage(), 500);
                    }
                    $body = $xml->xpath('//soapBody')[0];
                    $array = json_decode(json_encode((array) $body), true);
                    $bankDataInArray = [];
                    if (isset($array['GetShebaInfoResponse']['GetShebaInfoResult'])) {
                        $bankDataInArray = $array['GetShebaInfoResponse']['GetShebaInfoResult'];
                    } elseif (isset($array['GetDepositBalanceResponse']['GetDepositBalanceResult'])) {
                        $bankDataInArray = $array['GetDepositBalanceResponse']['GetDepositBalanceResult'];
                    } elseif (isset($array['ConvertShebaToDepositNumberResponse']['ConvertShebaToDepositNumberResult'])) {
                        $bankDataInArray = $array['ConvertShebaToDepositNumberResponse']['ConvertShebaToDepositNumberResult'];
                    } elseif (isset($array['ConvertDepositNumberToShebaResponse']['ConvertDepositNumberToShebaResult'])) {
                        $bankDataInArray = $array['ConvertDepositNumberToShebaResponse']['ConvertDepositNumberToShebaResult'];
                    } elseif (isset($array['GetDepositBaseInfoResponse']['GetDepositBaseInfoResult'])) {
                        $bankDataInArray = $array['GetDepositBaseInfoResponse']['GetDepositBaseInfoResult'];
                    } elseif (isset($array['TransferMoneyResponse']['TransferMoneyResult'])) {
                        $bankDataInArray = $array['TransferMoneyResponse']['TransferMoneyResult'];
                    } elseif (isset($array['TransferMoneySetOrderResponse']['TransferMoneySetOrderResult'])) {
                        $bankDataInArray = $array['TransferMoneySetOrderResponse']['TransferMoneySetOrderResult'];
                    } elseif (isset($array['GetTransferMoneyStateResponse']['GetTransferMoneyStateResult'])) {
                        $bankDataInArray = $array['GetTransferMoneyStateResponse']['GetTransferMoneyStateResult'];
                    } elseif (isset($array['CoreBatchTransferPayaResponse']['CoreBatchTransferPayaResult'])) {
                        $bankDataInArray = $array['CoreBatchTransferPayaResponse']['CoreBatchTransferPayaResult'];
                    } elseif (isset($array['BillPaymentByDepositResponse']['BillPaymentByDepositResult'])) {
                        $bankDataInArray = $array['BillPaymentByDepositResponse']['BillPaymentByDepositResult'];
                    }
                    $res['bankData'] = json_decode($bankDataInArray);
                } else {
                    $res['bankData'] = [
                        "IsSuccess" => false,
                    ];
                }
            } else {
                $res['data']->hasError = false;
                $res['bankData'] = [
                    "IsSuccess" => false,
                ];
            }
        }
        return $res;
    }

    private function signData($dataToSign): string
    {
        $signature = null;

        openssl_sign($dataToSign, $signature, env('pod_PRIVATE_KEY'), OPENSSL_ALGO_SHA1);

        return base64_encode($signature);
    }
}
