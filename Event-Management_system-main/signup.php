<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .signup-options {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .signup-option {
            margin: 20px;
            cursor: pointer;
            border: 2px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
        }

        .signup-option:hover {
            background-color: #007bff;
            color: #fff;
        }

        .signup-form {
            display: none;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            margin: 20px;
        }

        h3 {
            color: #007bff;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #333;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body style="background-image: url('data:image/jpeg;base64,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'); background-repeat: no-repeat; background-attachment: fixed;
  background-size: 100% 100%;">

    <h2>Signup</h2>

    <div class="signup-options">
        <div class="signup-option" onclick="showSignupForm('student')">Signup as Student</div>
        <div class="signup-option" onclick="showSignupForm('faculty')">Signup as Faculty</div>
    </div>

    <div class="signup-form" id="studentSignupForm">
        <h3>Student Signup</h3>
        <form method="post" action="process_signup.php">
            <input type="hidden" name="role" value="student">

            <label for="student_username">Username:</label>
            <input type="text" name="username" required>

            <label for="student_email">Email:</label>
            <input type="email" name="email" required>

            <label for="student_phone">Phone:</label>
            <input type="tel" name="phone" required>

            <label for="student_password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirmPassword" required>

            <label for="student_location">Location:</label>
            <input type="text" name="location" required>

            <label for="student_qualification">Qualification:</label>
            <input type="text" name="qualification" required>

            <input type="submit" value="Signup as Student">
        </form>
    </div>

    <div class="signup-form" id="facultySignupForm">
        <h3>Faculty Signup</h3>
        <form method="post" action="process_signup.php">
            <input type="hidden" name="role" value="faculty">

            <label for="faculty_username">Username:</label>
            <input type="text" name="username" required>

            <label for="faculty_email">Email:</label>
            <input type="email" name="email" required>

            <label for="faculty_phone">Phone:</label>
            <input type="tel" name="phone" required>

            <label for="faculty_password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_faculty_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirmPassword" required>

            <label for="faculty_location">Location:</label>
            <input type="text" name="location" required>

            <label for="faculty_qualification">Qualification:</label>
            <input type="text" name="qualification" required>

            <input type="submit" value="Signup as Faculty">
        </form>
    </div>

    <script>
        function showSignupForm(role) {
            document.getElementById('studentSignupForm').style.display = (role === 'student') ? 'block' : 'none';
            document.getElementById('facultySignupForm').style.display = (role === 'faculty') ? 'block' : 'none';
        }

        // JavaScript to check if the passwords match
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('password').addEventListener('input', function () {
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('confirmPassword').value;

                if (password !== confirmPassword) {
                    document.getElementById('confirmPassword').setCustomValidity('Passwords do not match');
                } else {
                    document.getElementById('confirmPassword').setCustomValidity('');
                }
            });

            document.getElementById('facultyPassword').addEventListener('input', function () {
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('confirmPassword').value;

                if (password !== confirmPassword) {
                    document.getElementById('confirmPassword').setCustomValidity('Passwords do not match');
                } else {
                    document.getElementById('confirmPassword').setCustomValidity('');
                }
            });
        });
    </script>

</body>
</html>
