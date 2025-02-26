<?php

declare(strict_types=1);

/**
 * This file is part of the CSasWebApi package
 *
 * https://github.com/Spoje-NET/php-csas-webapi
 *
 * (c) SpojeNetIT <http://spoje.net/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Ease\Shared as Shr;
use League\OAuth2\Client\Provider\GenericProvider;

require_once \dirname(__DIR__).'/vendor/autoload.php';

Shr::init(['CLIENT_ID', 'CLIENT_SECRET'], \dirname(__DIR__).'/.env');

// Use environment variables
$clientId = Shr::cfg('CLIENT_ID');
$clientSecret = Shr::cfg('CLIENT_SECRET');
$redirectUri = Shr::cfg('REDIRECT_URI');

$productionSite = 'https://bezpecnost.csas.cz/api/psd2/fl/oidc/v1';
$sandboxSite = 'https://webapi.developers.erstegroup.com/api/csas/sandbox/v1/sandbox-idp';
$idpLink = Shr::cfg('SANDBOX_MODE', false) ? $sandboxSite : $productionSite;
$tokenUrl = $idpLink.'/token';
$authorizeUrl = $idpLink.'/authorize';
$resourceUrl = $idpLink.'/resource';

$provider = new GenericProvider([
    'clientId' => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri' => $redirectUri,
    'urlAuthorize' => $authorizeUrl,
    'urlAccessToken' => $tokenUrl,
    'urlResourceOwnerDetails' => $resourceUrl,
]);

// Start session
session_start();

// If we don't have an authorization code then get one
if (!isset($_GET['code'])) {
    // Fetch the authorization URL from the provider; this returns the
    // urlAuthorize option and generates and applies any necessary parameters
    // (e.g. state).
    $authorizationUrl = $provider->getAuthorizationUrl();

    // Get the state generated for you and store it to the session.
    $_SESSION['oauth2state'] = $provider->getState();

    // Optional, only required when PKCE is enabled.
    // Get the PKCE code generated for you and store it to the session.
    $_SESSION['oauth2pkceCode'] = $provider->getPkceCode();

    // Redirect the user to the authorization URL.
    header('Location: '.$authorizationUrl);

    exit;

    // Check given state against previously stored one to mitigate CSRF attack
}

if (empty($_GET['state']) || empty($_SESSION['oauth2state']) || $_GET['state'] !== $_SESSION['oauth2state']) {
    if (isset($_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
    }

    exit('Invalid state');
}

try {
    // Optional, only required when PKCE is enabled.
    // Restore the PKCE code stored in the session.
    $provider->setPkceCode($_SESSION['oauth2pkceCode']);

    // Try to get an access token using the authorization code grant.
    $tokens = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code'],
    ]);

    // We have an access token, which we may use in authenticated
    // requests against the service provider's API.
    echo 'Access Token: '.$tokens->getToken().'<br>';
    echo 'Refresh Token: '.$tokens->getRefreshToken().'<br>';
    echo 'Expired in: '.$tokens->getExpires().'<br>';
    echo 'Already expired? '.($tokens->hasExpired() ? 'expired' : 'not expired').'<br>';

    $tokens = $provider->getAccessToken('refresh_token', [
        'refresh_token' => $tokens->getRefreshToken(),
    ]);

    echo 'access token:<textarea>'.$tokens->getToken().'</textarea>';
    //        echo 'refresh token:<textarea>'.$tokens->getRefreshToken().'</textarea>';

    //        // Using the access token, we may look up details about the
    //        // resource owner.
    //        $resourceOwner = $provider->getResourceOwner($tokens);
    //
    //        var_export($resourceOwner->toArray());
    //
    //        // The provider provides a way to get an authenticated API request for
    //        // the service, using the access token; it returns an object conforming
    //        // to Psr\Http\Message\RequestInterface.
    //        $request = $provider->getAuthenticatedRequest(
    //            'GET',
    //            'https://service.example.com/resource',
    //            $tokens
    //        );
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    // Failed to get the access token or user details.
    exit($e->getMessage());
}
