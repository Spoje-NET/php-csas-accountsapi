<?php

use Ease\Shared as Shr;
use Ease\Functions as Fnc;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Shr::init(['CLIENT_ID', 'CLIENT_SECRET'], dirname(__DIR__) . '/.env');

// Use environment variables
$clientId = Shr::cfg('CLIENT_ID');
$clientSecret = Shr::cfg('CLIENT_SECRET');
$redirectUri = Shr::cfg('REDIRECT_URI');

$productionSite = 'https://bezpecnost.csas.cz/api/psd2/fl/oidc/v1';
$sandboxSite = 'https://webapi.developers.erstegroup.com/api/csas/sandbox/v1/sandbox-idp';
$idpLink = Shr::cfg('SANDBOX_MODE', false) ? $sandboxSite : $productionSite;
$tokenUrl = $idpLink . '/token';

// Start session
session_start();

if (PHP_SAPI === 'cli') {
    parse_str($argv[1], $params);
    $code = array_key_exists('code', $params) ? $params['code'] : '';
} else {
    $code = array_key_exists('code', $_GET) ? $_GET['code'] : '';
}

// Check if the authorization code is set
if ($code) {
    // Prepare the POST request to exchange the authorization code for an access token
    $postFields = [
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirectUri,
        'client_id' => $clientId,
        'client_secret' => $clientSecret
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);

    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);

    if (isset($responseData['access_token'])) {
        // Store the access token in the session
        $_SESSION['access_token'] = $responseData['access_token'];
        echo '<h2>Access token obtained successfully!</h2>';

        echo 'access token:<textarea>' . $responseData['access_token'] . '</textarea>';
        echo 'refresh token:<textarea>' . $responseData['refresh_token'] . '</textarea>';
        var_dump($responseData);
    } else {
        echo 'Error obtaining access token!';

        var_dump($info);
    }
} else {
    echo 'Authorization code not found!';
}