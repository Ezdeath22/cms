<?php
// We can remove the debugging lines now
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);


// 1. INCLUDE THE REQUIRED LIBRARIES
require 'restclient.php';
require 'google-search-results.php';

// 2. Define the query for Tagaytay City
$query = [
  "engine" => "google",              // <-- CHANGED: Use the standard 'google' engine
  "q" => "Tagaytay City",            // <-- CHANGED: Query is just the city
  "tbm" => "nws",                    // <-- ADDED: 'tbm=nws' means "To Be Matched: News"
  "as_qdr" => "d7",                  // <-- ADDED: 'as_qdr=d7' means "Date Range: last 7 days"
  "hl" => "en",
  "gl" => "ph"                       // Get results from the Philippines
];

// 3. Your secret API key
$apiKey = '97b4d273aa499f9c2393999dceae5974fdd36039adfaa1b5ee72afff9741afe1';

try {
  // 4. Perform the search
  $search = new GoogleSearch($apiKey);
  $result_object = $search->get_json($query);
  
  // 5. Set the content type header
  header('Content-Type: application/json');
  
  // 6. Convert the PHP object back into a JSON STRING to echo it
  echo json_encode($result_object);

} catch (Exception $e) {
  // This sends a 500 server error if something fails
  header('Content-Type: application/json', true, 500);
  echo json_encode(['error' => $e->getMessage()]);
}
?>