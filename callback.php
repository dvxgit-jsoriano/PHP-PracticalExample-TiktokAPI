<?php
$config = parse_ini_file('env.ini');

// Get the authorization code from the URL parameters after TikTok's redirect
$authorizationCode = $_GET['code'];

// Your TikTok App credentials
$clientId = $config['CLIENT_ID'];
$clientSecret = $config['CLIENT_SECRET'];
$redirectUri = $config['REDIRECT_URI'];

// Endpoint to exchange the authorization code for an access token
$tokenEndpoint = 'https://api.tiktok.com/oauth/access_token';

// Data to be sent in the POST request
$data = array(
    'client_key' => $clientId,
    'client_secret' => $clientSecret,
    'code' => $authorizationCode,
    'redirect_uri' => $redirectUri,
    'grant_type' => 'authorization_code',
    'scope' => 'user.info.basic, video.list'
);

// Make the POST request using curl
$ch = curl_init($tokenEndpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Decode the response JSON
$responseData = json_decode($response, true);

// Extract the access token from the response
$accessToken = $responseData['access_token'];

// Store the access token in the session
session_start();
$_SESSION['access_token'] = $accessToken;

// Redirect the user to the dashboard
header('Location: dashboard');
exit;
