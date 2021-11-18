<?php

namespace MirHamit\PodBankService\Services;

use Exception;

/**
 * @author Həmid Musəvi <w1w@yahoo.com>
 * 11/14/21
 */
class SavingAccount
{

    protected $dataSender;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (!config('pod.pod_UserName') || !config('pod.pod_DepositNumber')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $this->dataSender = new DataSender();
    }

    /**
     * Shenase Service 434002
     * /mojudi
     * */
    public function mojudi($bankData = true)
    {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdMojudi') || !config('pod.pod_Services.scApiKeyMojudi')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"DepositNumber":"'.config('pod.pod_DepositNumber').'",'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdMojudi'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyMojudi'),
            'request'     => $data,
            'signature'   => DataSender::sign($data),
        ];
        return DataSender::sendRequest($headers, $requestData, $bankData);
    }

    /**
     * Shenase Service 671932
     * /shebaToSeporde/IR670570160180014890181101
     */
    public function shebaToSeporde($sheba, $bankData = true)
    {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdShebaToSeporde') || !config('pod.pod_Services.scApiKeyShebaToSeporde')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"Sheba":"'.$sheba.'",'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdShebaToSeporde'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyShebaToSeporde'),
            'request'     => $data,
            'signature'   => DataSender::sign($data),
        ];

        return DataSender::sendRequest($headers, $requestData, $bankData);
    }

    /**
     * Shenase Service 671929
     * /pasargadToSheba/1601.8000.14890181.1
     */
    public function pasargadToSheba($hesab, $bankData = true)
    {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdPasargadToSheba') || !config('pod.pod_Services.scApiKeyPasargadToSheba')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"DepositNumber":"'.$hesab.'",'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdPasargadToSheba'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyPasargadToSheba'),
            'request'     => $data,
            'signature'   => DataSender::sign($data),
        ];
        return DataSender::sendRequest($headers, $requestData, $bankData);

    }

    /**
     * Shenase Service 437012
     * /estelam/IR670570160180014890181101
     */
    public function estelamSheba($sheba, $bankData = true)
    {

        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdEstelamSheba') || !config('pod.pod_Services.scApiKeyEstelamSheba')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"DepositNumber":"'.config('pod.pod_DepositNumber').'",'.
            '"Sheba":"'.$sheba.'",'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
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
            'signature'   => DataSender::sign($data),
        ];

        return DataSender::sendRequest($headers, $requestData, $bankData);
    }


    /**
     * Shenase Service 671933
     * /estelamHesabPasargad/1601.8000.14890181.1/IR670570160180014890181101
     */
    public function estelamHesabPasargad($hesab, $sheba = null, $bankData = true)
    {

        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdEstelamHesabPasargad') || !config('pod.pod_Services.scApiKeyEstelamHesabPasargad')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"DepositNumber":"'.$hesab.'",'.
            '"Sheba":"'.$sheba.'",'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdEstelamHesabPasargad'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyEstelamHesabPasargad'),
            'request'     => $data,
            'signature'   => DataSender::sign($data),
        ];
        return DataSender::sendRequest($headers, $requestData, $bankData);
    }


    /**
     * Shenase Service 445929
     * /enteghalVajhPaya
     */
    public function enteghalVajhPaya(
        $destSheba,
        $centralBankTransferDetailType,
        $destFirstName,
        $destLastName,
        $amount,
        $sourceComment,
        $destComment,
        $paymentId,
        $destDepositNumber = null,
        $bankData = true
    ) {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdEnteghalPaya') || !config('pod.pod_Services.scApiKeyEnteghalPaya')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"SourceDepositNumber":"'.config('pod.pod_DepositNumber').'",'.
            '"SourceSheba":"'.config('pod.pod_Sheba').'",'.
            '"DestDepositNumber":"'.$destDepositNumber.'",'.
            '"DestSheba":"'.$destSheba.'",'.
            '"CentralBankTransferDetailType":"'.$centralBankTransferDetailType.'",'.
            '"DestFirstName":"'.$destFirstName.'",'.
            '"DestLastName":"'.$destLastName.'",'.
            '"Amount":"'.$amount.'",'. // rial
            '"SourceComment":"'.$sourceComment.'",'.
            '"DestComment":"'.$destComment.'",'.
            '"PaymentId":"'.$paymentId.'",'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
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
            'signature'   => DataSender::sign($data),
        ];
        return DataSender::sendRequest($headers, $requestData, $bankData);

    }

    /**
     * Shenase Service 465435
     * /enteghalVajhSatna
     */
    public function enteghalVajhSatna(
        $destSheba,
        $centralBankTransferDetailType,
        $destFirstName,
        $destLastName,
        $amount,
        $sourceComment,
        $destComment,
        $paymentId,
        $destDepositNumber = null,
        $destBankCode = null,
        $bankData = true
    ) {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdEnteghalSatna') || !config('pod.pod_Services.scApiKeyEnteghalSatna')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"SourceDepositNumber":"'.config('pod.pod_DepositNumber').'",'.
            '"SourceSheba":"'.config('pod.pod_Sheba').'",'.
            '"DestSheba":"'.$destSheba.'",'.
            '"DestDepositNumber":"'.$destDepositNumber.'",'.
            '"DestBankCode":"'.$destBankCode.'",'.
            '"DestFirstName":"'.$destFirstName.'",'.
            '"DestLastName":"'.$destLastName.'",'.
            '"Amount":"'.$amount.'",'. // rial
            '"CentralBankTransferDetailType":"'.$centralBankTransferDetailType.'",'.
            '"SourceComment":"'.$sourceComment.'",'.
            '"DestComment":"'.$destComment.'",'.
            '"PaymentId":"'.$paymentId.'",'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdEnteghalSatna'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyEnteghalSatna'),
            'request'     => $data,
            'signature'   => DataSender::sign($data),
        ];
        return DataSender::sendRequest($headers, $requestData, $bankData);
    }

    /**
     * Shenase Service 487397
     * /payBill/billNumber/paymentIds
     */
    public function enteghalVajhPayaGuruhi($data, $bankData = true)
    {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdEnteghalVajhPayaGuruhi') || !config('pod.pod_Services.scApiKeyEnteghalVajhPayaGuruhi')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $batchPayaItemInfoToString = '';
        $numItems = count($data->BatchPayaItemInfos);
        $i = 0;
        foreach ($data->BatchPayaItemInfos as $batchPayaItemInfo) {
            $batchPayaItemInfoToString .= '{'.
                '"Amount":"'.$batchPayaItemInfo['Amount'].'",'.
                '"BeneficiaryFullName":"'.$batchPayaItemInfo['BeneficiaryFullName'].'",'.
                '"Description":"'.$batchPayaItemInfo['Description'].'",'.
                '"DestShebaNumber":"'.$batchPayaItemInfo['DestShebaNumber'].'",'.
                '"BillNumber":"'.$batchPayaItemInfo['BillNumber'].'"'.
                '}';
            ++$i === $numItems ?: $batchPayaItemInfoToString .= ',';
        }

        $convertedData = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"SourceDepositNumber":"'.config('pod.pod_DepositNumber').'",'.
            '"FileUniqueIdentifier":"'.$data->FileUniqueIdentifier.'",'.
            '"TransferMoneyBillNumber":"'.$data->TransferMoneyBillNumber.'",'. // shenase ghabz = *09az
            '"CentralBankTransferDetailType":"'.$data->CentralBankTransferDetailType.'",'.
            '"BatchPayaItemInfos":['.
            $batchPayaItemInfoToString.
            '],'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdEnteghalVajhPayaGuruhi'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyEnteghalVajhPayaGuruhi'),
            'request'     => $convertedData,
            'signature'   => DataSender::sign($convertedData),
        ];
        return DataSender::sendRequest($headers, $requestData, $bankData);
    }

    public function estelamEnteghal($hesab, $sheba = null, $bankData = true)
    {

        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdEstelamEnteghal') || !config('pod.pod_Services.scApiKeyEstelamEnteghal')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"Date":"1400/08/26",'.
            '"PaymentId":140008260572131544,'.
            //            '"PaymentId":"123test",'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdEstelamEnteghal'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyEstelamEnteghal'),
            'request'     => $data,
            'signature'   => DataSender::sign($data),
        ];
        return DataSender::sendRequest($headers, $requestData);
    }

    /**
     * Shenase Service 671929
     * /pasargadToSheba/1601.8000.14890181.1
     */
    public function payBill($billNumber, $paymentId, $bankData = true)
    {
        if (!config('pod.pod_token') || !config('pod.pod_Services.scProductIdPayBill') || !config('pod.pod_Services.scApiKeyPayBill')) {
            throw new Exception('لطفا مقادیر مورد نیاز سرویس را بررسی کنید', 503);
        }
        $data = "{".
            '"UserName":"'.config('pod.pod_UserName').'",'.
            '"DepositNumber":"'.config('pod.pod_DepositNumber').'",'.
            '"BillNumber":"'.$billNumber.'",'.
            '"PaymentId":"'.$paymentId.'",'.
            '"Timestamp":"'.date('Y/m/d H:i:s:B').'"'
            ."}";
        $headers = [
            '_token_'        => config('pod.pod_token'),
            '_token_issuer_' => '1',
            'Content-Type'   => 'application/x-www-form-urlencoded',
        ];
        $requestData = [
            'scProductId' => config('pod.pod_Services.scProductIdPayBill'),
            'scApiKey'    => config('pod.pod_Services.scApiKeyPayBill'),
            'request'     => $data,
            'signature'   => DataSender::sign($data),
        ];
        return DataSender::sendRequest($headers, $requestData, $bankData);

    }
}
