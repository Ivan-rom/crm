<? include "config.php";
$login = $_POST['login'];
$pass = $_POST['password'];

$check_login = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '".$login."'");
if (mysqli_num_rows($check_login)){
    $checked_login = mysqli_fetch_assoc($check_login);
    $check_pass = $checked_login['password'];
    if ($pass == $check_pass) {
        $login_group = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `status` FROM `users_groups` WHERE `id` =".$checked_login['users_group_id']));

        if ($login_group['status'] == "admins") {
            header("location: /adminpanel.php?id=".$checked_login['id']."");
        } else if ($login_group['status'] == "managers") {
            header("location: /tasks.php?id=".$checked_login['id']."");
        } else {
            header("location: /tasks.php?id=".$checked_login['id']."");
        }
    } else {
        echo "Пароль введен неверно!";?>
        <a class="btn" href="../">Вернуться назад</a>
    <?}
} else {
    echo "Такой логин не зарегистрирован!";?>
    <a class="btn" href="../">Вернуться назад</a>
<?}?>