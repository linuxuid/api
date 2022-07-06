<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php if(empty($user)): ?> 
        <h1>Login</h1>
        <?php if(isset($errors)): ?>
            <?= $errors ?>
        <?php endif; ?>
        
        <form action="/api/login/" method="POST">
            <label>Email: <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
            <label>Password: <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
            <a href="/api/forget-password/">forget password?</a>
            <button>
                Sign In
            </button>
        </form>
    <?php else: ?>  
        Вы залогинены
    <?php endif; ?>
</body>
</html>