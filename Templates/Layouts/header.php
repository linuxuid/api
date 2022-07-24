<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/api/Public/styles/homepage/present.css">
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
                    <a href="/api/your-account/" target="_blank">account</a>
                    <span class="user">Hello, <?= $user->getName(); ?></span>
                    <span>|</span>
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
