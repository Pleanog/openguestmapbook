<?php

$response = [];
$response['errors'] = [];

try {
    // connect to database
    require dirname(__FILE__) . '/database.php';

    if (
        $entry_stmt = $mysqli_connection->prepare(
            'SELECT name, lng, lat, message, timestamp FROM entry;'
        )
    ) {
        // execute query
        if ($entry_stmt && $entry_stmt->execute()) {
            // store result
            $result = $entry_stmt->get_result();

            $data = $result->fetch_all(MYSQLI_ASSOC);

            $response['data'] = $data;
            

            $entry_stmt->close();
        }
    }
} catch (Exception $exception) {
    $response['errors'][] = $exception->getMessage();
}

echo json_encode($response);
