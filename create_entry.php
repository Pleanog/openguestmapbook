<?php

$response = [];
$response['errors'] = [];

try {
    if (!isset($_POST['long'])) {
        $response['errors'][] = 'Please enter a longitude.';
    }

    if (!isset($_POST['lat'])) {
        $response['errors'][] = 'Please enter a latitude.';
    }

    if (!isset($_POST['message'])) {
        $response['errors'][] = 'Please enter a message.';
    }

    $message_max_length = 512;

    $long = $_POST['long'];
    $lat = $_POST['lat'];
    $message = $_POST['message'];

    if (strlen($message) > $message_max_length) {
        $response['errors'][] =
            'Message is too long, must be equal or under ' .
            strval($email_max_length) .
            ' characters.';
    }

    if (count($response['errors']) == 0) {
        // connect to database
        require dirname(__FILE__) . '/database.php';

        $entry_stmt = $mysqli_connection->prepare("INSERT INTO entry (longitude, latitude, message) VALUES(?, ?, ?)");

        if (
            $entry_stmt &&
            $entry_stmt->bind_param('dds', $long, $lat, $message) &&
            $entry_stmt->execute()
        ) {
            $response["message"] = "Successfully saved your message.";
        } else {
            $response["errors"][] = "db error";
            $response["errors"][] = $mysqli_connection->error;
        }
    }
} catch (Exception $exception) {
    $response['errors'][] = $exception->getMessage();
}

echo json_encode($response);
