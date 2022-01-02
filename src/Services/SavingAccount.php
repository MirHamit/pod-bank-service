<?php

namespace MirHamit\PodBankService\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

/**
 * @author Həmid Musəvi <w1w@yahoo.com>
 * 11/14/21
 */
class SavingAccount
{

    protected $dataSender;


    /**
     * Shenase Service 1077449
     * /mojudi
     * */
    public function mojudi()
    {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdMojudi') || !config('pod.pod_Services.scApiKeyMojudi')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".'"DepositNumber":"'.config('pod.pod_DepositNumber').'"'."}";


        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdMojudi'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyMojudi'),
            'request'     => $data,
        ];
        return DataSender::sendRequest($headers, $requestData);
    }


    /**
     * Shenase Service 1115396
     * /estelam/IR111111111111111111111111
     */
    public function estelamSheba($sheba, $paymentId = null)
    {

        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdEstelamSheba') || !config('pod.pod_Services.scApiKeyEstelamSheba')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"Iban":"'.$sheba.'",'.
            '"PaymentId":"'.$paymentId.'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdEstelamSheba'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyEstelamSheba'),
            'request'     => $data,
        ];

        return DataSender::sendRequest($headers, $requestData);
    }


    /**
     * Shenase Service 1076566
     * /enteghalVajhPaya
     */
    public function enteghalVajhPaya(
        $amount,
        $destinationIban,
        $recieverFullName,
        $transactionDate,
        $description,
        $srcComment,
        $transactionBillNumber = null,
        $transactionId = null
    ) {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdEnteghalPaya') || !config('pod.pod_Services.scApiKeyEnteghalPaya')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        if (!$transactionId) {
            $orgCode = "4321";
            $randomString = Str::random(8);
            $dateTime = Carbon::now()->getPreciseTimestamp(3);
            $asci = 0;
            foreach (str_split($orgCode) as $item) {
                $asci += ord($item);
            }
            foreach (str_split($randomString) as $item) {
                $asci += ord($item);
            }
            foreach (str_split($dateTime) as $item) {
                $asci += ord($item);
            }
            $transactionId = "{$orgCode}-{$randomString}-{$dateTime}-{$asci}";
        }
        $data = "{".
            '"Amount":"'.$amount.'",'. //مبلغ تراکنش
            '"SourceDepNum":"'.config('pod.pod_DepositNumber').'",'. //شماره سپرده ی مبدا
            '"DestinationIban":"'.$destinationIban.'",'. //شماره شبای مقصد
            '"RecieverFullName":"'.$recieverFullName.'",'. //نام گیرنده‌ی وجه
            '"TransactionDate":"'.$transactionDate.'",'.
            '"Description":"'.$description.'",'. //شرح انتقال
            '"TransactionId":"'.$transactionId.'",'. //شناسه یکتای تراکنش
            '"IsAutoVerify":"true",'. //تایید یا عدم تایید خودکار
            '"SrcComment":"'.$srcComment.'",'. //شرح مبدا
            '"SenderReturnDepositNumber":"'.config('pod.pod_DepositNumber').'",'. //شماره سپرده‌ی بازگشت وجه
            '"CustomerNumber":"'.config('pod.pod_customerNumber').'",'. //شماره مشتری
            '"DestBankCode":"'.substr($destinationIban, 5, 2).'",'. //کد بانک مقصد
            '"TransactionBillNumber":"'.$transactionBillNumber.'"' //شناسه‌ی واریز
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdEnteghalPaya'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyEnteghalPaya'),
            'request'     => $data,
        ];
        return DataSender::sendRequest($headers, $requestData);
    }


    /**
     * Shenase Service 1077467
     * /suratHesab/1400-10-08/1400-10-08/00-00-00/23-59-59
     */
    public function suratHesab(
        $fromDate,
        $toDate,
        $fromHour = "00:00:00",
        $toHour = "23:59:59",
        $resultCount = 99999999
    ) {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdSuratHesab') || !config('pod.pod_Services.scApiKeySuratHesab')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        if (Str::contains($fromDate, '-')) {
            $fromDate = Str::replace('-', '/', $fromDate);
        }
        if (Str::contains($toDate, '-')) {
            $toDate = Str::replace('-', '/', $toDate);
        }
        if (Str::contains($fromHour, '-')) {
            $fromHour = Str::replace('-', ':', $fromHour);
        }
        if (Str::contains($toHour, '-')) {
            $toHour = Str::replace('-', ':', $toHour);
        }
        $data = "{".
            '"DepositNumber":"'.config('pod.pod_DepositNumber').'",'.
            '"FromDate":"'.$fromDate.'",'.
            '"ToDate":"'.$toDate.'",'.
            '"FromTime":"'.$fromHour.'",'.
            '"ToTime":"'.$toHour.'",'.
            '"ResultCount":"'.$resultCount.'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdSuratHesab'),
            'scApiKey'    => config('pod.pod_Services.scApiKeySuratHesab'),
            'request'     => $data,
        ];
        //        return $requestData;
        return DataSender::sendRequest($headers, $requestData);
    }


}
