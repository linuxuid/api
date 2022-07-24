<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/api/Public/styles/homepage/present.css">
    <link rel="stylesheet" href="/api/Public/styles/account/cabinet.css">
    <title>Bird in Flight</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="above_top">
                <span>Bird in Flight</span>
            </div>
            <div class="top">
                <span>freedom & philosophy & anonymity & keep push</span> 
            </div>
            <nav class="menu">
                <a href="/api/main-page/" target="_blank">Home</a>
                <span>|</span>
                <a href="#" target="_blank">Spiritual</a>
                <span>|</span>
                <a href="/api/anonymity-topic/" target="_blank">Anonymity</a>
                <span>|</span>
                <a href="/api/whoami/" target="_blank">About me</a>
                <span>|</span>
                <a href="/api/guest-book/" target="_blank">guestbook</a>
                <span>|</span>
                <?php if(empty($user)): ?>
                <a href="/api/login/" class="login" target="_blank">Login</a>
                <span>|</span>
                <a href="/api/register/" class="login" target="_blank">Register</a>
                </div>
                <?php else: ?>
                    <form action="/api/logout/" method="POST">
                        <button>
                                logout
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </nav>
<span class="line">

</span>
        </header>

<main>
    <div class="content">
        <?php if(!empty($user)): ?>
            <h2>About you</h2>
            <form>
                <label>
                    Name:
                </label>
                <input type="text" name="name" value="<?= $user->getName() ?>" disabled>
                
                <label>
                    Email:
                </label>
                <input type="text" name="name" value="<?= $user->getEmail() ?>" disabled>
            </form>
            <br>
            <h2>Functions</h2>
            <form action="/api/change-password/" method="POST">
                <button>reset password</button>
            </form>

            <form action="/api/change-email/" method="POST">
                <button>reset email</button>
            </form>
        <?php else: ?>
            sign in -> <a href="/api/login/">login</a>
        <?php endif; ?>
    </div>
</main>

<?php include __DIR__ . '/../Layouts/footer.php' ?>