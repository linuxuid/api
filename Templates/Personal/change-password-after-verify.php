<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php if(isset($errors)): ?>

<?= $errors ?>

<?php endif; ?>
    <form action="" method="POST">
        <label>New password: <input type="password" name="reset_password"></label>
        <label>Confirm: <input type="password" name="confirm_password"></label>
        <button>
            RESET PASSWORD
        </button>
    </form>
</body>
</html>