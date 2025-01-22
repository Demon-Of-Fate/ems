<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="illustration-section">
                <img src="https://img.freepik.com/free-vector/mobile-login-concept-illustration_114360-83.jpg" alt="Person working on laptop">
            </div>
            
            <div class="login-section">
                <h1>Log In</h1>
                <form id="login-form">
                    <div id="mess"></div>
                    <div class="input-group">
                        <input type="text" placeholder="Email" id="email" name="email" required>
                    </div>
                    
                    <div class="input-group">
                        <input type="password" placeholder="Password" id="password" name="password" required>
                    </div>
                    
                    <div id="error-message" class="error-message" style="display:none;"></div>
                    
                    <button type="button" onclick="login()" class="login-btn" id="login-btn">
                        <span class="btn-text">Log In</span>
                        <span class="spinner" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script>

        $("#login-btn").on("submit", function(e){

            e.preventDefault();

        });
        function login() {
            // Show loading spinner
            $('#login-btn .btn-text').hide();
            $('#login-btn .spinner').show();
            
            // Get the email and password values
            var email = $('#email').val();
            var password = $('#password').val();
            
            if (email === "" || password === "") {
                $('#error-message').text("Please fill in both fields.");
                $('#error-message').show();
                $('#login-btn .spinner').hide();
                $('#login-btn .btn-text').show();
                return;
            }
            
            // AJAX request
            $.ajax({
                url: './backend/login1.php',
                type: 'POST',
                dataType: 'json', // Specify expected response type
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    if (response.status === 'success') {
            
          $('#mess').text('login successfull!')
          setTimeout(function () {
                window.location.href = 'dashboard.php'; // Change to your desired URL
            }, 2000);
        } else {
            $('#mess').text('login Failed!')
        }
                },
                error: function(xhr, status, error) {
                    
                },
                complete: function() {
                   
                }
            });
        }
    </script>
</body>
</html>