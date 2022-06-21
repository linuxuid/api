<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In front of you</title>
</head>
<body>
    <?php foreach($articles as $article): ?>

        <?= $article['name'] ?>

    <?php endforeach; ?>
</body>
</html>