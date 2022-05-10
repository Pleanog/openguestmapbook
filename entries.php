<?php

// connect to database
require dirname(__FILE__) . '/database.php';

if (
    $entry_stmt = $mysqli_connection->prepare(
        'SELECT longitude, latitude, message FROM entry;'
    )
) {
    // execute query
    if (
        $entry_stmt &&
        $entry_stmt->execute()
    ) {
        // store result
        $result = $entry_stmt->get_result();

        $data = [];

        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            //buffer the row onto $data
            $data[] = $row;
        }

        if (0 == count($data)) {
            echo 'No records found.';
        } else {
            echo json_encode($data);
        }

        $entry_stmt->close();
    }
}
