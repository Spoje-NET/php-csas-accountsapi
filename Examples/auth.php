<?php


use Ease\Shared as Shr;
use Ease\Functions as Fnc;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Shr::init([], dirname(__DIR__) . '/.env');

$productionSite = 'https://bezpecnost.csas.cz/api/psd2/fl/oidc/v1';
$sandboxSite = 'https://webapi.developers.erstegroup.com/api/csas/sandbox/v1/sandbox-idp';
$idpLink = Shr::cfg('SANDBOX_MODE', false) ? $sandboxSite : $productionSite;

/**
 * @link https://developers.erstegroup.com/docs/tutorial/csas-how-to-call-api Authentization & Authorization
 * @var array<string,string> Authorization link parameters
 */
$idpParams = [
    'client_id' => Shr::cfg('CLIENT_ID'),
    'response_type' => 'code',
    'redirect_uri' => Shr::cfg('REDIRECT_URI'),
    'state' => Fnc::randomString(),
    'access_type' => 'offline',
    'scope' => implode('%20', [
        'siblings.accounts',
//        'siblings.payments',
//        'AISP',
//        'PISP'
        ])
    ];

$idpUri = Fnc::addUrlParams($idpLink.'/auth', $idpParams);

if (PHP_SAPI === 'cli') {
    echo $idpUri;
} else {
    echo '<a href='.$idpUri.'>'.$idpUri.'</a>';
}
