<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include FontAwesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #20c997;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            max-width: 400px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.7);
            background-color: #fff;
        }
        .show-password {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="mb-4 text-center">Login</h2>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <span class="input-group-text show-password" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery (for toggling password visibility) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Toggle password visibility
        $("#togglePassword").click(function() {
            var passwordField = $("#password");
            var fieldType = passwordField.attr("type");
            if (fieldType === "password") {
                passwordField.attr("type", "text");
            } else {
                passwordField.attr("type", "password");
            }
        });
    </script>
</body>
</html>
