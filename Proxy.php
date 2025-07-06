<?php
// Example: proxy.php?id=willow-sp

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo "Missing channel parameter.";
    exit;
}

$channel = preg_replace('/[^a-z0-9\-_]/i', '', $_GET['id']);
$sourceUrl = "https://sportifylive-18.pages.dev/ch?id=" . urlencode($channel);

$context = stream_context_create([
    "http" => [
        "header" => "User-Agent: Mozilla/5.0"
    ]
]);

$response = @file_get_contents($sourceUrl, false, $context);

if ($response === false) {
    http_response_code(502);
    echo "Could not fetch the stream.";
    exit;
}

// Optional: Extract real .m3u8 if needed, or just forward response
echo $response;
