<?php

// Get the "id" parameter from the URL
$videoId = isset($_GET['id']) ? $_GET['id'] : '';

if ($videoId) {
    $url = 'https://pipedapi-libre.kavin.rocks/streams/' . $videoId;

    // Make GET request to get HLS URL
    $response = file_get_contents($url);

    // Decode JSON response
    $data = json_decode($response, true);

    // Get the HLS URL
    $hlsUrl = $data['hls'];

    // Make GET request to HLS URL
    $hlsResponse = file_get_contents($hlsUrl);

    // Replace "api/manifest/" with the full URL
    $updatedHlsResponse = str_replace('/api/manifest/', 'https://pipedproxy-ams-2.kavin.rocks/api/manifest/', $hlsResponse);

    // Output the updated HLS response
    echo $hlsUrl;
} else {
    echo 'Please provide a valid video Id.';
}

?>
