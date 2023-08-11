<?php
$config = parse_ini_file('env.ini');

// Get the authorization code from the URL parameters after TikTok's redirect
$authorizationCode = $_GET['code'];

// Your TikTok App credentials
$clientId = $config['CLIENT_ID'];
$clientSecret = $config['CLIENT_SECRET'];
$redirectUri = $config['REDIRECT_URI'];

// Endpoint to exchange the authorization code for an access token
$tokenEndpoint = 'https://open.tiktokapis.com/v2/oauth/token/';

// Data to be sent in the POST request
$data = array(
    'client_key' => $clientId,
    'client_secret' => $clientSecret,
    'code' => urldecode($authorizationCode),
    'redirect_uri' => $redirectUri,
    'grant_type' => 'authorization_code',
    'scope' => 'user.info.basic,video.list',
);

// Convert the POST data into a URL-encoded string
$postFields = http_build_query($data);

// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt($curl, CURLOPT_URL, $tokenEndpoint);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded'
));

// Execute the cURL request
$response = curl_exec($curl);

curl_close($ch);

// Decode the response JSON
$responseData = json_decode($response, true);
die(var_dump($responseData));

// Extract the access token from the response
$accessToken = $responseData['access_token'];

die(var_dump($accessToken));

// Store the access token in the session
session_start();
$_SESSION['access_token'] = $accessToken;

// Redirect the user to the dashboard
header('Location: dashboard');
exit;
