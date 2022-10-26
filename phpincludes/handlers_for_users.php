<? include "config.php";
$get_id = $_POST['get-id'];

$del_id = $_POST['del_id'];
if (isset($_POST['delete'])) {
    mysqli_query($connection, "DELETE FROM `users` WHERE `id` =".$del_id);
    header("location: ../users.php?id=".$get_id."");
}

$del_group_id = $_POST['del_group_id'];
if (isset($_POST['delete_group'])) {
    mysqli_query($connection, "DELETE FROM `users_groups` WHERE `id` =".$del_group_id);
    mysqli_query($connection, "DELETE FROM `users` WHERE `users_group_id` =".$del_group_id);
    header("location: ../users.php?id=".$get_id."");
}

$w_group_name = $_POST['workers_group_name'];
$w_group_status = $_POST['add-group-status'];

if(isset($_POST['add_workers_group'])){
    mysqli_query($connection, "INSERT INTO `users_groups` (`title`,`status`) VALUES ('".$w_group_name."','".$w_group_status."')");
    header("location: ../users.php?id=".$get_id."");
}

$login = $_POST['login'];
$pass = $_POST['password'];
$s_pass = $_POST['second-password'];
$name = $_POST['name'];
$group_id = $_POST['group_id'];

$errors = array();
if($name == ''){$errors[] = 'Введите имя!';}

if($login == ''){$errors[] = 'Введите логин!';}
else{
	$check = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) FROM `users` WHERE login = '".$login."'"));
	if($check['COUNT(*)'] != 0)
    $errors[] = 'Такой логин уже используется!';}

if($pass == ''){
	$errors[] = 'Введите пароль!';
}else if (strlen($pass) < 6){
	$errors[] = 'Пароль должен быть не короче 6 символов!';
}else if ($pass != $s_pass){
	$errors[] = 'Пароли не совпадают!';
}

if (empty($errors)){
    mysqli_query($connection, "INSERT INTO `users`(`login`, `password`, `name`, `users_group_id`) VALUES ('".$login."', '".$pass."', '".$name."', '".$group_id."')");
    header("location: ../users.php?id=".$get_id."");
} else {?>
    <ul>
        <? foreach ($errors as $error) {?>
            <li><?=$error?></li>
        <?}?>
    </ul>
    <a href="../users.php?id=<?=$get_id?>">Вернуться назад</a>
<?}?>