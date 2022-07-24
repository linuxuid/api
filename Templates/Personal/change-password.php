<?php include __DIR__ . '/../Layouts/header.php' ?>
<link rel="stylesheet" href="/api/Public/styles/auth/login.css">
<link rel="stylesheet" href="/api/Public/styles/account/resetpass.css">

    <main>
        <div class="content">
<?php if(!empty($user)): ?> 
    <form action="/api/change-password/" method="POST">
         <?php if(isset($errors)): ?>
            <div class="errors">
                <span><?= $errors ?></span>
            </div> 
        <?php endif; ?>
        <label>Old password: </label>
        <input type="password" name="old_password">
       
        <label>New password: </label>
        <input type="password" name="new_password">
       
        <label>Confrim: </label>
        <input type="password" name="confirm">
        <button>
            CHANGE
        </button>
            </form>
        <?php else: ?>
            your are not logged in

        <?php endif; ?>
        </div>
    </main>

<?php include __DIR__ . '/../Layouts/footer.php' ?>