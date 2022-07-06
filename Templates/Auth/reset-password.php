<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
</head>
<body>

<?php if(isset($errors)): ?>

<?= $errors ?>

<?php endif; ?>
    <h2>Please write your email to reset password</h2>
    <form action="/api/forget-password/" method="POST">
        <label>Email: <input type="email" name="user_email"></label>
        <button>
            send email
        </button>
    </form>
</body>
</html>