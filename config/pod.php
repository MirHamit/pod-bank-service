<?php

/**
 * @author Həmid Musəvi <w1w@yahoo.com>
 * 11/14/21
 */

return [
    "pod_UserName"      => env('pod_UserName', ''),
    "pod_DepositNumber" => env('pod_DepositNumber', ''),
    "pod_Sheba"         => env('pod_Sheba', ''),
    "pod_PRIVATE_KEY"   => env('pod_PRIVATE_KEY', ''),
    "pod_token"         => env('pod_token', ''),

    'pod_Services' => [
        'scProductIdEstelamSheba'           => env('pod_scProductIdEstelamSheba', '437012'),
        'scApiKeyEstelamSheba'              => env('pod_scApiKeyEstelamSheba', ''),
        'scProductIdMojudi'                 => env('pod_scProductIdMojudi', '434002'),
        'scApiKeyMojudi'                    => env('pod_scApiKeyMojudi', ''),
        'scProductIdShebaToSeporde'         => env('pod_scProductIdShebaToSeporde', '671932'),
        'scApiKeyShebaToSeporde'            => env('pod_scApiKeyShebaToSeporde', ''),
        'scProductIdPasargadToSheba'        => env('pod_scProductIdPasargadToSheba', '671929'),
        'scApiKeyPasargadToSheba'           => env('pod_scApiKeyPasargadToSheba', ''),
        'scProductIdEstelamHesabPasargad'   => env('pod_scProductIdEstelamHesabPasargad', '671933'),
        'scApiKeyEstelamHesabPasargad'      => env('pod_scApiKeyEstelamHesabPasargad', ''),
        'scProductIdEnteghalPaya'           => env('pod_scProductIdEnteghalPaya', '445929'),
        'scApiKeyEnteghalPaya'              => env('pod_scApiKeyEnteghalPaya', ''),
        'scProductIdEnteghalSatna'          => env('pod_scProductIdEnteghalSatna', '465435'),
        'scApiKeyEnteghalSatna'             => env('pod_scApiKeyEnteghalSatna', ''),
        'scProductIdEnteghalVajhPayaGuruhi' => env('pod_scProductIdEnteghalVajhPayaGuruhi', '440226'),
        'scApiKeyEnteghalVajhPayaGuruhi'    => env('pod_scApiKeyEnteghalVajhPayaGuruhi', ''),
        'scProductIdEstelamEnteghal'        => env('pod_scProductIdEstelamEnteghal', '487396'),
        'scApiKeyEstelamEnteghal'           => env('pod_scApiKeyEstelamEnteghal', ''),
        'scProductIdPayBill'                => env('pod_scProductIdPayBill', '487397'),
        'scApiKeyPayBill'                   => env('pod_scApiKeyPayBill', ''),
    ]
];
