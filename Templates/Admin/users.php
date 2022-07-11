<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>nickname</th>
                    <th>email</th>
                    <th>confirmed</th>
                    <th>role</th>
                    <th>status</th>
                    <th>ban</th>
                    <th>unban</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user->getId() ?></td>
                        <td><?= $user->getName() ?></td>
                        <td><?= $user->getEmail() ?></td>
                        <td><?= $user->getIsConfirmed() ?></td>
                        <td><?= $user->getRole() ?></td>
                        <td><?= $user->getStatus() ?></td>
                        <td><a href="/api/change-status-user-to-ban/<?= $user->getId() ?>/">ban</a></td>
                        <td><a href="/api/change-status-user-to-unban/<?= $user->getId() ?>/">unban</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
</table>
</body>
</html>