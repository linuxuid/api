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
    <?php ?>
    <form action="/api/change-email/" method="POST">
        <label>New email: <input type="email" name="old_email"></label>
        <button>
            CHANGE
        </button>
    </form>
    <?php ?>
<?php else: ?>
    your are not logged in

<?php endif; ?>
</body>
</html>