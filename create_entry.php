<?php

$response = [];
$response['errors'] = [];

try {
    if (!isset($_POST['lat'])) {
        $response['errors'][] = 'Please enter a latitude.';
    }

    if (!isset($_POST['lng'])) {
        $response['errors'][] = 'Please enter a longitude.';
    }

    $message_max_length = 2048;

    $name = empty($_POST['name']) ? null : $_POST['name'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $message = empty($_POST['message']) ? null : $_POST['message'];

    if (strlen($message) > $message_max_length) {
        $response['errors'][] =
            'Message is too long, must be equal or under ' .
            strval($email_max_length) .
            ' characters.';
    }

    if (count($response['errors']) == 0) {
        // connect to database
        require dirname(__FILE__) . '/database.php';

        $entry_stmt = $mysqli_connection->prepare("INSERT INTO entry (name, lat, lng, message) VALUES(?, ?, ?, ?)");

        if (
            $entry_stmt &&
            $entry_stmt->bind_param('sdds', $name, $lat, $lng, $message) &&
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
