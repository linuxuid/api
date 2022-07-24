<?php include __DIR__ . '/../Layouts/header.php' ?>
<link rel="stylesheet" href="/api/Public/styles/auth/reset.css"> 
<!-- <link rel="stylesheet" href="/api/Public/styles/auth/footer_auth.css"> -->

<main>
    <div class="content">
        <form action="/api/forget-password/" method="POST">
        <?php if(isset($errors)): ?>
            <div class="errors">
                <span><?= $errors ?></span>
            </div> 
        <?php endif; ?>
        <h2>reset password</h2>
            <label>
                Email: 
            </label>
            <input type="email" name="user_email">
            <button>
                send email
            </button>
        </form>
    </div>
</main>

<footer>
        <span>
        © 2022 a non-commercial website with no specific purpose and maybe I can think of something better than the simple code in the background but like I said I don't like the front-end and prefer the back-end and I think that's what we live for to do what we like, because it's your life and you have to choose your own path.
        </span>
</footer>
