<?php include __DIR__ . '/../Layouts/header.php' ?>
<link rel="stylesheet" href="/api/Public/styles/auth/reset.css"> 


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


<?php include __DIR__ . '/../Layouts/footer.php' ?>
