<?php
session_start();
require 'db.php';

// Function to sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

$errorMessage = ''; // Variable to store error messages
$email = ''; // To remember the email entered by the user for repopulation

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Sanitize and validate input
    $email = sanitizeInput($_POST['login_email']);
    $password = $_POST['login_password'];

    if (empty($email) || empty($password)) {
        $errorMessage = "Both fields are required.";
    } elseif (!validateEmail($email)) {
        $errorMessage = "Invalid email format!";
    }

    if (empty($errorMessage)) {
        try {
            // Prepare the query to fetch user data by email
            $query = "SELECT * FROM employee_master WHERE emp_email = :email";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':email', $email);

            // Execute the query
            if (!$statement->execute()) {
                $errorMessage = "Query execution failed.";
            } else {
                // Fetch user data
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                if (!$user) {
                    $errorMessage = "Sorry, this email is not registered.";
                } else {
                    // Verify the password
                    // if (!password_verify($password, $user['password'])) {
                    //     $errorMessage = "Sorry, your email or password is incorrect.";
                    // }
                    if(!$password == $user['password']){
                        $errorMessage = "Sorry, your email or password is incorrect.";
                    }
                }
            }
        } catch (PDOException $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    }

    // If no error, proceed with setting session and redirecting based on role
    if (empty($errorMessage)) {
        $_SESSION['email'] = $email;
        // var_dump($user);
        $_SESSION['id']=$user['empid'];
        $_SESSION['role'] = $user['department'];
        $_SESSION['username']= $user['login_name'];
        $_SESSION['logged_In'] = true;

        // var_dump($_SESSION['email']);
        // var_dump($_SESSION['id']);

        // var_dump($_SESSION['role']);

        // var_dump($_SESSION['username']);

        // var_dump($__SESSION['']);


        echo "you are loggedin";
        // Redirect based on user role
        // if ($user['role'] === 'user') {
        //     header("Location: index.php");
        //     exit();
        // } else {
        //     header("Location: admin-panel.php");
        //     exit();
        // }
    }
}
// $sql = "SELECT i.username AS user_name, i.email AS user_email,
//     b.title AS book_title,
//     b.author AS book_author,
//     b.language AS book_language,
//     b.genre AS book_genre,
//     b.isbn AS book_isbn,
//     b.pages AS book_pages,
//     b.summary AS book_summaray,
//     br.request AS request_status,
//     br.created_at AS request_date
// FROM 
//     individual i
// JOIN 
//     book_requests br ON i.id = br.id
// JOIN 
//     books b ON br.id = b.id
// ORDER BY 
//     br.created_at DESC;
// ";
// $user_all_data = $pdo->prepare($sql);
// $user_all_data->execute();

// return 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="book-login.css" rel="stylesheet">
    </head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Welcome Back!</h2>
            <p>Log in to continue to OpenLibrary</p>
        </div>

        <form action="" method="post">
            <?php if (!empty($errorMessage)): ?>
                <div class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="login_email">Email</label>
                <div class="input-wrapper">
                    <input 
                        type="email" 
                        name="login_email" 
                        id="login_email" 
                        class="form-control" 
                        placeholder="Enter your email" 
                        
                        required 
                       
                    >
                    <i class="fas fa-envelope input-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="login_password">Password</label>
                <div class="input-wrapper">
                    <input 
                        type="password" 
                        name="login_password" 
                        id="login_password" 
                        class="form-control" 
                        placeholder="Enter your password" 
                        required
                    >
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>

            <button type="submit" name="submit" id="submit" class="login-btn">
                Log In
            </button>

            <div class="signup-link">
                Don't have an account? <a href="book-register.php">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>
