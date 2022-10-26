<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="style.css">
    <title>Вход</title>
</head>
<body>
    <form action="phpincludes/login.php" class="create-group" method="post">
        <div class="main-title"><center>ВХОД В CRM</center></div>
        <label>
            <div class="form-title">ЛОГИН</div>
            <input class="new-group-input" type="text" name="login">
        </label>
        <label>
            <div class="form-title">ПАРОЛЬ</div>
            <input class="order-input" type="password" name="password">
        </label>
        <label>
            <center>
                <input class="btn create-group-submit" type="submit" name="login-submit" value="ВХОД">
            </center>
        </label>
    </form>
</body>
</html>