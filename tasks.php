<?php
include "phpincludes/config.php";
include "phpincludes/header.php";
if(isset($_GET['id'])){
    $check_id = mysqli_query($connection, "SELECT * FROM `users` WHERE `id` =".$_GET['id']);
    if(mysqli_num_rows($check_id)){
        $group_id = mysqli_fetch_assoc($check_id)['users_group_id'];
        $group_status = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `status` FROM `users_groups` WHERE `id` =".$group_id))['status'];
        if($group_status == "admins"){
            include "phpincludes/groups_of_tasks_for_admins.php";
        }else if($group_status == "managers"){
            include "phpincludes/groups_of_tasks_for_managers.php";
        }else{
            include "phpincludes/groups_of_tasks_for_workers.php";
        }
    }else{?>
        <div class="not-found">Вы не вошли в аккаунт!</div>
        <a class="btn" href="index.php">Войти</a>
    <?}}else{?>
        <div class="not-found">Вы не вошли в аккаунт!</div>
        <a class="btn" href="index.php">Войти</a>
    <?}
include "phpincludes/footer.php";?>