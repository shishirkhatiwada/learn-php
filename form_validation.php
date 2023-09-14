<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" maxlength="40" required><br><br>
        
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" pattern="[A-Za-z][A-Za-z0-9]*" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" minlength="8" required><br><br>
        
        <input type="submit" name="submit" value="Register">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Validation rules
        $isValid = true;
        $errors = [];

        // Validate Full Name
        if (strlen($fullname) > 40) {
            $isValid = false;
            $errors[] = "Full Name should be at most 40 characters.";
        }

        // Validate Email Address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
            $errors[] = "Invalid Email Address.";
        }

        // Validate Username (starts with a letter followed by letters or digits)
        if (!preg_match("/^[A-Za-z][A-Za-z0-9]*$/", $username)) {
            $isValid = false;
            $errors[] = "Username should start with a letter and contain only letters and digits.";
        }

        // Validate Password Length
        if (strlen($password) < 8) {
            $isValid = false;
            $errors[] = "Password should be at least 8 characters long.";
        }

        // If validation succeeds, insert data into the database
        if ($isValid) {
            $servername = "localhost";
            $username = "your_username";
            $password = "your_password";
            $dbname = "your_database_name";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute the SQL query
            $sql = "INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $fullname, $email, $username, $password);

            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            // Display validation errors
            echo "<div style='color: red;'>";
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
            echo "</div>";
        }
    }
    ?>
</body>
</html>
