<?php include __DIR__ . '/../Layouts/header.php' ?>
<link rel="stylesheet" href="/api/Public/styles/auth/login.css">        
<link rel="stylesheet" href="/api/Public/styles/homepage/present.css">

<main>
    <div class="content">
    <form action="/api/login/" method="POST">
    <?php if(isset($_REQUEST['sub']) and !empty($errors)): ?>
        <div class="errors">
                <span><?= $errors ?></span>
        </div> 
        <?php endif; ?>

        <?php if(empty($user)): ?> 
            <h1>Login</h1>

        <label>
            Email: 
        </label>     
            <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>">
        <label>
            Password: 
        </label>
            <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>">
        <a href="/api/forget-password/">forget password?</a>

        <button name="sub">
            Sign In
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

    
<?php include __DIR__ . '/../Layouts/footer.php' ?>