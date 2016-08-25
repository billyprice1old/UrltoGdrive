<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
session_start();

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}

$url_array = explode('?', $protocol.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$url = $url_array[0];

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

$client = new Google_Client();
$client->setClientId('560284086204-84dco8h09i1bidq6g6v0j2oj2p14dnjp.apps.googleusercontent.com');
$client->setClientSecret('U9cvNk2ARBeJ5AdqKOrDgqaN');
$client->setRedirectUri($url);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));

if (isset($_GET['code'])) {
    $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
    header('location:'.$url);exit;
} elseif (!isset($_SESSION['accessToken'])) {
    $client->authenticate();
}


if (!empty($_POST)) {
    $file_url = $_POST['url'];
    
    $client->setAccessToken($_SESSION['accessToken']);
    $service = new Google_DriveService($client);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file = new Google_DriveFile();

        $mime_type = finfo_file($finfo, $file_path);
        $file->setTitle(basename($file_url));
        $file->setDescription('uploaded');
        $file->setMimeType($mime_type);
        $service->files->insert(
            $file,
            array(
                'data' => file_get_contents($file_url),
                'mimeType' => $mime_type
            )
        );
        
    finfo_close($finfo);
    header('location:'.$url);exit;
}
include 'index.phtml';
