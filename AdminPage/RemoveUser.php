<?php
require_once ("../config.php");; // Database connection

// Checking if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Getting the email from the POST request
    $email = $_POST['email'];

    // Preparing the SQL statement to delete the user
    $query = "DELETE FROM user WHERE Email = ?";
    
    if ($stmt = $conn->prepare($query)) {
        // Bind the email parameter
        $stmt->bind_param("s", $email);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to admin page with success message
            echo "<script>
                alert('User removed successfully');
              </script>";
        } else {
            // Redirect to admin page with error message
            echo '<script>
            alert("Error Preparing Statement");
            window.location.replace("admin.php");
            </script>';
        }

        // Close the statement
        $stmt->close();

        echo '<script>
        window.location.replace("admin.php");
      </script>';

    } else {
        // Redirect to admin page with error message
        echo '<script>
        alert("Error Preparing Statement");
        window.location.replace("admin.php");
      </script>';
    }
} echo "<script>
alert('Not using post');
window.location.replace('admin.php');
</script>";

?>