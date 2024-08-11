<?php 
$error = "0";
$not_allowed = array("http", "https", "://", "www.", "ftp.", "ftps.", "//");
$curl_dc = curl_init("https://discord.com/api/webhooks/1271786861769130036/3ENk5LCxvJXtZxHszE8n2uBHWCXGyIg_qW8Is9kP1ZOk8yzqlXR0fO7AvmtIT79LMPN3");
function obtainUserIP() {
    if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
$ip = obtainUserIP();1
$fileURI = isset($_GET['f']) ? $_GET['f']:null;
if (!$fileURI) {
    $error = "1";
} elseif ($fileURI) {
    $error = "0";
    $file = base64_decode($fileURI);
}
foreach ($not_allowed as $word) {
    if (strpos($files, $word) !== false) {
        $error = "2"; 
    }
}
$download = curl_init($file);
curl_setopt($download, CURLOPT_RETURNTRANSFER, 0);
curl_setopt($download, CURLOPT_BINARYTRANSFER, 1);
header('Content-Disposition: attadownloadment; filename="'.basename($file).'"');
header('Content-Type: application/octet-stream');
readfile($file);
?>