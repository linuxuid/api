<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<?php if(empty($user)): ?> 
    <h1>
        Register
    </h1>

    <?php if(isset($errors)): ?>
        <?= $errors ?>
    <?php endif; ?>

    <form action="/api/stored-data/" method="POST">
        <label> Nickname: <input type="text" name="nickname"> </label>
        <label> Email: <input type="email" name="email"></label>
        <label> Password: <input type="password" name="password"></label>
        <input type="hidden" name="id"> 
        <button>
            SUBMIT
        </button>
    </form>
<?php else: ?>
    вы залогинены
<?php endif; ?> 

<form action="/api/logout/" method="POST">
        <button>
                logout
        </button>
    </form>
</body>
</html>