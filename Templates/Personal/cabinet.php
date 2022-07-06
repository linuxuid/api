<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php if(!empty($user)): ?>
    <a href="/api/change-password/">change password</a>
    <a href="/api/change-email/">change email</a>
<?php else: ?>
    sign in -> <a href="/api/login/">login</a>
<?php endif; ?>
</body>
</html>