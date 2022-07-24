<?php include __DIR__ . '/../Layouts/header.php' ?>
<link rel="stylesheet" href="/api/Public/styles/auth/login.css">
<link rel="stylesheet" href="/api/Public/styles/account/resetpass.css">

    <main>
        <div class="content">
<?php if(!empty($user)): ?> 
    <form action="/api/change-email/" method="POST">
        <?php if(isset($errors)): ?>
            <div class="errors">
                <span><?= $errors ?></span>
            </div> 
        <?php endif; ?>
        <label>New email:</label><input type="email" name="old_email">
        <button name="sub">
            CHANGE
        </button>
    </form>
        <?php else: ?>
            your are not logged in

        <?php endif; ?>
        </div>
    </main>

<?php include __DIR__ . '/../Layouts/footer.php' ?>