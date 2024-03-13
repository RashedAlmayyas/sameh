<?php
include 'config.php';

// Function to encrypt data
function encryptData($data, $key, $iv) {
    return base64_encode(openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $userName = $_POST['username'];
    $userPass = $_POST['password'];

    // SQL query to fetch user details
    $sql = "SELECT WEB_USER_ID, USER_NAME, USER_PASS, BRANCH_NO, USER_TYPE
            FROM ERP.WEB_USERS_APP
            WHERE USER_NAME = :username and WEB_APP_ID=5";

    // Prepare the SQL statement
    $statement = oci_parse($conn, $sql);

    // Bind the parameters
    oci_bind_by_name($statement, ":username", $userName);

    // Execute the SQL statement
    $result = oci_execute($statement);

    if (!$result) {
        $error = oci_error($statement);
        die("Error executing SQL statement: " . $error['message']);
    }

    // Fetch the result
    $row = oci_fetch_assoc($statement);

    // Check if the user exists and password is correct
    if ($row && $row['USER_PASS'] == $userPass) {
        // Start the session to store user information
        session_start();

        // Store user information in the session
        $_SESSION['user_id'] = $row['WEB_USER_ID'];
        $_SESSION['username'] = $row['USER_NAME'];

        // Encrypt the user data
        $encryptionKey = "YourEncryptionKey"; // Change this to a strong, unique key
        $iv = openssl_random_pseudo_bytes(16);
        $encryptedUserData = encryptData(json_encode($row), $encryptionKey, $iv);

        // Redirect to the dashboard with the encrypted user data
        header("Location: ../dashboard.php?user_data=" . urlencode(base64_encode($encryptedUserData)) . "&iv=" . urlencode(base64_encode($iv)));
        exit();
    } else {
        // Handle authentication failure (e.g., display an error message)
        echo "Authentication failed. Invalid username or password.";
    }

    // Free the statement resources
    oci_free_statement($statement);
}

// Close the Oracle connection
oci_close($conn);
?>
