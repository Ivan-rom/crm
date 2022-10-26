<? include "phpincludes/config.php";
if(isset($_GET['id'])){
    $check_id = mysqli_query($connection, "SELECT * FROM `users` WHERE `id` =".$_GET['id']);
    if(mysqli_num_rows($check_id)){
        $group_id = mysqli_fetch_assoc($check_id)['users_group_id'];
        $group_status = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `status` FROM `users_groups` WHERE `id` =".$group_id))['status'];
        if($group_status == "admins"){?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Панель админа</title>
                <link rel="stylesheet" href="main.css">
                <link rel="stylesheet" href="admin.css">
            </head>
            <body>
            <div class="go-back">
                <a class="btn" href="index.php"><</a>
            </div>
                <div class="btns">
                    <a class="btn" href="users.php?id=<?=$_GET['id']?>">Списки сотрудников</a>
                    <a class="btn" href="tasks.php?id=<?=$_GET['id']?>">Списки задач</a>
                </div>
            </body>
            </html>
        <?}else{?>
        <div class="not-found">Вы не вошли в аккаунт!</div>
        <a class="btn" href="index.php">Войти</a>
        <?}}else{?>
        <div class="not-found">Вы не вошли в аккаунт!</div>
        <a class="btn" href="index.php">Войти</a>
        <?}}else{?>
            <div class="not-found">Вы не вошли в аккаунт!</div>
            <a class="btn" href="index.php">Войти</a>
        <?}?>