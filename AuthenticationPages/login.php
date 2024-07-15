<?php

session_start();

require_once ("../config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $email = trim($_POST["Email"]);
    $password = trim($_POST["Password"]);

    // Input validation
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        // Check if the email exists
        $stmt = $conn->prepare("SELECT password, NickName FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email exists, verify the password
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];
            $test = password_verify($password, $hashedPassword);

            if ($test == true) {
                $nickname = $row["NickName"];
                $_SESSION['$userEmail'] = $email;
                $_SESSION['$userNickname'] = $nickname;

                if($email === 'admin@example.com') {
                    $sqlUpdate = "UPDATE user SET UserType = 'admin' WHERE email = ?";
                    $stmtUpdate = $conn->prepare($sqlUpdate);
                    $stmtUpdate->bind_param("s", $email);
                    $stmtUpdate->execute();
                    header("Location: ../AdminPage/admin.php");
                } else{
                    $sqlUpdate = "UPDATE user SET UserType = 'user' WHERE email = ?";
                    $stmtUpdate = $conn->prepare($sqlUpdate);
                    $stmtUpdate->bind_param("s", $email);
                    $stmtUpdate->execute();
                    header("Location: ../AppPages/dashboard.php");
                    exit();
                }                
            } else {
                $error = "Incorrect password. Try again.";
            }
        } else {
            // If not found, redirect to register page
            header("Location: register.html");
            exit();
        }
        $stmt->close();
    } else {
        $error = "Invalid input. Please enter a valid email and password.";
    }
    mysqli_close($conn);
}


?>

<script>
    var phpError = "<?php echo addslashes($error); ?>";
    if (phpError) {
        alert(phpError);
        if (document.querySelector('input[name="Email"]')) {
            document.querySelector('input[name="Email"]').value = '';
        }
        if (document.querySelector('input[name="Password"]')) {
            document.querySelector('input[name="Password"]').value = '';
        }

        // Redirect back to the login page
        window.location.href = '../index.html';
    }
</script>