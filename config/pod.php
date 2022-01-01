<?php

/**
 * @author Həmid Musəvi <w1w@yahoo.com>
 * 11/14/21
 */

return [
    "pod_UserName"       => env('pod_UserName', ''),
    "pod_DepositNumber"  => env('pod_DepositNumber', ''),
    "pod_customerNumber" => env('pod_customerNumber', ''),
    "pod_Sheba"          => env('pod_Sheba', ''),
    "pod_token"          => env('pod_token', ''),
    "pod_PRIVATE_KEY"   => env('pod_PRIVATE_KEY', ''),

    'pod_Services' => [
        'scProductIdEstelamSheba' => env('pod_scProductIdEstelamSheba', '1115396'),
        'scApiKeyEstelamSheba'    => env('pod_scApiKeyEstelamSheba', ''),

        'scProductIdMojudi' => env('pod_scProductIdMojudi', '1077449'),
        'scApiKeyMojudi'    => env('pod_scApiKeyMojudi', ''),

        'scProductIdEnteghalPaya' => env('pod_scProductIdEnteghalPaya', '1076566'),
        'scApiKeyEnteghalPaya'    => env('pod_scApiKeyEnteghalPaya', ''),

        'scProductIdSuratHesab' => env('pod_scProductIdSuratHesab', '1077467'),
        'scApiKeySuratHesab'    => env('pod_scApiKeySuratHesab', ''),

    ]
];
