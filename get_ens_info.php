<?php
 function get_ens_info( $eth_address) {
    $url = 'https://api.ensideas.com/ens/resolve/'.strtolower($eth_address);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    $json_response = curl_exec($ch);

    if (curl_errno($ch)) {
        curl_close($ch);
        return false;
    }
    curl_close($ch);
    
    // Convert the JSON response to an array
    $data = json_decode($json_response, true);
    
    // Check if JSON decoding was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        return false; // Return null if there was an error decoding JSON
    }
    
    // Extract the name and avatar from the array
    $name = $data['name'] ?? null;
    $avatar = $data['avatar'] ?? null;
    
    // Return an array containing the name and avatar
    return array('name' => $name, 'avatar' => $avatar);
}
?>
