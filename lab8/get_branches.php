<?php
header('Content-Type: application/json');

if (isset($_GET['cityRef'])) {
    $cityRef = $_GET['cityRef'];
    $apiKey = 'f190b32b91f0bf04ee964b764a2416c4';
    $url = 'https://api.novaposhta.ua/v2.0/json/';

    $data = [
        "apiKey" => $apiKey,
        "modelName" => "Address",
        "calledMethod" => "getWarehouses",
        "methodProperties" => [
            "CityRef" => $cityRef
        ]
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === false) {
        echo json_encode(['success' => false, 'message' => 'Error fetching data from API']);
    } else {
        $decodedResponse = json_decode($response, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            if (isset($decodedResponse['data']) && is_array($decodedResponse['data'])) {
                $descriptions = array_map(function($branch) {
                    return $branch['Description'];
                }, $decodedResponse['data']);

                echo json_encode(['success' => true, 'data' => $descriptions]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No data available']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error processing JSON data']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
