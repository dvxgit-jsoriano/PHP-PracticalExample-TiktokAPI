<?php
// Start the session to access session data
session_start();

// Check if the access token is present in the session
if (isset($_SESSION['access_token'])) {
    // User is logged in with TikTok, proceed with displaying the dashboard
    // Your dashboard content goes here

} else {
    // User is not logged in with TikTok, redirect back to the login page
    header('Location: index');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiktok Test Dashboard</title>
</head>

<body>
    <h1>Welcome to our Company Customer Service Support on Tiktok</h1>

    <p>This page is still under development and testing for a project. I hope you can approve this application so we can proceed.</p>

</body>

</html>