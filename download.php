<?php 
$error = "0";
$not_allowed = array("http", "https", "://", "www.", "ftp.", "ftps.", "//");
$curl_dc = curl_init("YOUR WEBHOOK HERE");

function obtainUserIP() {
    if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$ip = obtainUserIP();
$fileURI = isset($_GET['f']) ? $_GET['f'] : null;

if (!$fileURI) {
    $error = "1";
} else {
    $file = base64_decode($fileURI);

    // Check for forbidden strings in the file path
    foreach ($not_allowed as $word) {
        if (strpos($file, $word) !== false) {
            $error = "2";
        }
    }

    // Handle errors before trying to download the file
    if ($error === "2") {
        echo "Outside of the Downloadable Range";
        $message = [
            'content' => 'Alert! Someone tried to access a file using HTTP or HTTPS. IP address: ' . $ip . ' Tried to access an internet file: ' . $file,
            'username' => 'PHP Alert Bot',
        ];
        $jsonData = json_encode($message);
        curl_setopt($curl_dc, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_dc, CURLOPT_POST, true);
        curl_setopt($curl_dc, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($curl_dc, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($curl_dc);
        curl_close($curl_dc);
    }

    // Check if the file exists before attempting to download
    if ($error === "0" && file_exists($file)) {
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit();
    } else {
        $error = "3";
    }
}

if ($error == "1") {
    echo "<p id='Display' style='color: red;'>Error: No file specified.</p>";
} elseif ($error == "3") {
    echo "Error: Unable to download the file.";
}
?>

