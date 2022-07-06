<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php if(!empty($errors)): ?>

<?= $errors ?>

<?php endif; ?>

<?php if(!empty($user)): ?> 
    <form action="/api/change-password/" method="POST">
        <label>Old password: <input type="password" name="old_password"></label>
        <label>New password: <input type="password" name="new_password"></label>
        <label>Confrim: <input type="password" name="confirm"></label>
        <button>
            CHANGE
        </button>
    </form>
<?php else: ?>
    your are not logged in

<?php endif; ?>
</body>
</html>