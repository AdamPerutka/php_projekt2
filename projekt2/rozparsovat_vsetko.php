<?php
// Initialize cURL handles
$curlHandles = array(
    curl_init('https://site181.webte.fei.stuba.sk/zadanie2/stranka1/rozparsovat1.php?name=free-food'),
    curl_init('https://site181.webte.fei.stuba.sk/zadanie2/stranka2/rozparsovat2.php?name=restauracia-drag'),
    curl_init('https://site181.webte.fei.stuba.sk/zadanie2/stranka3/rozparsovat3.php?name=restauracia-venza&index_r_url=https://site181.webte.fei.stuba.sk/zadanie2/index.php')
);

// Initialize a multi-handle
$multiHandle = curl_multi_init();

// Add the cURL handles to the multi-handle
foreach ($curlHandles as $curlHandle) {
    curl_multi_add_handle($multiHandle, $curlHandle);
}

// Execute the cURL handles concurrently
$running = null;
do {
    curl_multi_exec($multiHandle, $running);
} while ($running);

// Close the cURL handles
foreach ($curlHandles as $curlHandle) {
    curl_multi_remove_handle($multiHandle, $curlHandle);
    curl_close($curlHandle);
}

curl_multi_close($multiHandle);
$R_URL = "https://site181.webte.fei.stuba.sk/zadanie2/index.php";


$redirect_url = $R_URL;
$delay_time = 3;
header("Refresh: $delay_time; URL=$redirect_url");

echo '<a>';
echo '<br>';
echo "You wwill be redirected to $redirect_url in $delay_time seconds...";
echo '</a>';