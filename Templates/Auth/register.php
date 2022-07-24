<?php include __DIR__ . '/../Layouts/header.php' ?>
<link rel="stylesheet" href="/api/Public/styles/auth/register.css">       
<link rel="stylesheet" href="/api/Public/styles/homepage/present.css">
<link rel="stylesheet" href="/api/Public/styles/auth/footer_auth.css">

<main>
    <div class="content">
    <form action="/api/stored-data/" method="POST">
        <?php if(isset($errors)): ?>
            <div class="errors">
                <span><?= $errors ?></span>
            </div> 
        <?php endif; ?>

        <?php if(empty($user)): ?> 
            <h1>Register</h1>

        <label> 
            Nickname: 
        </label> 
        <input type="text" name="nickname"> 

        <label> 
            Email: 
        </label>
        <input type="email" name="email">

        <label> 
            Password: 
        </label>
        <input type="password" name="password">
        <input type="hidden" name="id"> 
        <a href="/api/login/">are you already registered?</a>
        <button>
            SUBMIT
        </button>
    </form>
    <?php else: ?>  
                <div class="logged">
                    <p>You are logged in already, you can use this links:</p>
                        <div class="links">
                            <a href="#">link1</a>
                            <a href="#">link1</a>
                            <a href="#">link1</a>
                            <a href="#">link1</a>
                        </div>
                </div>
            <?php endif; ?>
    </div>
</main>


<footer>
        <span>
        © 2022 a non-commercial website with no specific purpose and maybe I can think of something better than the simple code in the background but like I said I don't like the front-end and prefer the back-end and I think that's what we live for to do what we like, because it's your life and you have to choose your own path.
        </span>
</footer>