<?php

// redirectedFromBank.php

// Load Ease Framework
require_once __DIR__ . '/vendor/autoload.php';

// Initialize Ease Framework and load .env file
\Ease\Shared::init(['.env'], __DIR__);

// Use environment variables
$clientId = \Ease\Functions::cfg('CLIENT_ID');
$clientSecret = \Ease\Functions::cfg('API_KEY');
$redirectUri = 'http://localhost/php-csas-webapi/Examples/redirectedFromBank.php';
$tokenUrl = 'https://sandbox.csas.cz/sandbox/api/token';

// Start session
session_start();

// Check if the authorization code is set
if (isset($_GET['code'])) {
    $code = $_GET['code'];

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

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);

    if (isset($responseData['access_token'])) {
        // Store the access token in the session
        $_SESSION['access_token'] = $responseData['access_token'];
        echo 'Access token obtained successfully!';
    } else {
        echo 'Error obtaining access token!';
    }
} else {
    echo 'Authorization code not found!';
}