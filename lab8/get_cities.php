<?php
header('Content-Type: application/json');

$apiKey = 'f190b32b91f0bf04ee964b764a2416c4';
$url = 'https://api.novaposhta.ua/v2.0/json/';

$data = [
    "apiKey" => $apiKey,
    "modelName" => "Address",
    "calledMethod" => "getCities",
    "methodProperties" => [
        "Limit" => 200
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

$decodedResponse = json_decode($response, true);

if ($decodedResponse['success']) {
    $cities = $decodedResponse['data'];

    $cityList = [];
    foreach ($cities as $city) {
        $cityList[] = [
            'Ref' => $city['Ref'],
            'Name' => $city['Description'],
        ];
    }

    echo json_encode(['success' => true, 'data' => $cityList]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка получения данных']);
}
?>
