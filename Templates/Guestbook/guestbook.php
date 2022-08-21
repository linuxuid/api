<?php include __DIR__ . '/../Layouts/header.php' ?>
<link rel="stylesheet" href="/api/Public/styles/guestbook/guestbook.css">

<main>
    <div class="content">
            <span class="about">About</span>
            <br>
            <span class="about_desc">
                you can leave your comment below and I can figure out how I can make things better, or just write what you want, doesn't matter.
            </span> 
<br><br>
            <?php 
            
            ?>

            <!-- comment block begin -->
            <div class="comment_block">
                <?php if(!empty($error)): ?>
                    <span class="error"><?= $error ?></span>
                <?php endif; ?>

                    <form action="/api/guest-book-store/" method="POST">
                        <h4>Leave your comment</h4>
                        <label>
                            Name:
                        </label>
                        <input type="text" name="name" placeholder="write your name..">
                        <label>
                            Your comment:
                        </label>
                        <textarea name="comment"></textarea>
                        <button type="submit" name="sub">
                            publish
                        </button>
                    </form>
                    <p class="comms">Comments</p>
                <?php foreach($comments as $comment): ?>
                    <p>
                        <span class="designations">Date:</span> 
                        <span class="dateVal"> <?= $comment->getDate() ?></span>
                        <br>
                        <span class="designations">Author:</span> 
                        <span class="value"> <?= $comment->getName() ?></span>
                        <br>
                        <span class="designations">Comment:</span> 
                        <span class="value"> <?= $comment->getTextUser() ?></span>
                    </p>
                <?php endforeach; ?>
            </div>

            <?php for ($pageNum = 1; $pageNum <= $pageCount; $pageNum++): ?>
                <a href="/<?= $pageNum === 1 ? '' : $pageNum ?>"><?= $pageNum ?></a>
            <?php endfor; ?>
            <!-- comment block end -->
    </div>
</main>

<?php include __DIR__ . '/../Layouts/footer.php' ?>
