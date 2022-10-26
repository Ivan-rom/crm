<div class="go-back">
    <a class="btn" href="adminpanel.php?id=<?=$_GET['id']?>"><</a>
</div>
<div class="groups">
    <?php
    include "phpincludes/config.php";
    $users_groups = mysqli_query($connection, "SELECT * FROM `users_groups`");
    if (mysqli_num_rows($users_groups)) {
        while ($users_group = mysqli_fetch_assoc($users_groups)){?>
            <div class="group">
                <div class="title-of-group">
                    <center>
                        <?=$users_group['title']?>
                        <?if($users_group['status'] == "admins"){?>
                            <span class="caption-of-title">(Админы)</span>
                        <?}else if($users_group['status'] == "managers"){?>
                            <span class="caption-of-title">(Менеджеры)</span>
                        <?}else if($users_group['status'] == "workers"){?>
                            <span class="caption-of-title">(Работники)</span>
                        <?}?>
                    </center>
                </div>
                <div class="row">
                    <div class="data name">Имя</div>
                    <div class="data login">Логин</div>
                    <div class="data password">Пароль</div>
                    <div class="data delete">
                        <form class="form-data" action="phpincludes/handlers_for_users.php" method="post">
                            <input type="hidden" name="del_group_id" value="<?=$users_group['id']?>" class="input-hidden">
                            <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="input-hidden">
                            <button type="submit" class="btn delete-btn delete-group" name="delete_group">Удалить</button>
                        </form>
                    </div>
                </div>
                <? $users = mysqli_query($connection, "SELECT * FROM `users` WHERE `users_group_id` = " .$users_group['id']);
                if (mysqli_num_rows($users)) {
                    while ($user = mysqli_fetch_assoc($users)) {?>
                    <div class="row">
                        <div class="data name"><?=$user['name']?></div>
                        <div class="data login"><?=$user['login']?></div>
                        <div class="data password"><?=$user['password']?></div>
                        <div class="data delete"><form class="form-data" action="phpincludes/handlers_for_users.php" method="post">
                            <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="input-hidden">
                            <input type="hidden" name="del_id" value="<?=$user['id']?>" class="input-hidden">
                            <button type="submit" class="btn delete-btn delete-group" name="delete">Удалить</button>
                        </form></div>
                    </div>
                <?}}?>
                <button class="btn add-account btn-form-toggle">Добавить аккаунт</button>
                <div class="form hidden">
                    <form action="phpincludes/handlers_for_users.php" method="post" class="create-group">
                        <div class="form-title">Регистрация</div>
                        <label>
                            <div class="input-title">Имя</div>
                            <input type="text" name="name">
                        </label>
                        <label>
                            <div class="input-title">Логин</div>
                            <input type="text" name="login">
                        </label>
                        <label>
                            <div class="input-title">Пароль</div>
                            <input type="password" name="password">
                        </label>
                        <label>
                            <div class="input-title">Подтвердить пароль</div>
                            <input type="password" name="second-password">
                        </label>
                        <label>
                            <input type="hidden" name="group_id" value="<?=$users_group['id']?>">
                            <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="input-hidden">
                        </label>
                        <label>
                                <input class="btn add-account-btn" type="submit" name="add-group" value="Подтвердить">
                        </label>
                    </form>
                </div>
            </div>
        <?}
    }?>
</div>
<form class="add-group" action="phpincludes/handlers_for_users.php" method="post">
    <label>
        <div>Название групы</div>
        <input type="text" name="workers_group_name">
    </label>
    <div>
        <label>
            <input type="radio" name="add-group-status" value="admins">
            Админы
        </label>
        <br>
        <label>
            <input type="radio" name="add-group-status" value="managers">
            Менеджеры
        </label>
        <br>
        <label>
            <input type="radio" name="add-group-status" value="workers" checked="checked">
            Рабочие
        </label>
    </div>
    <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="hidden">
    <input class="btn" type="submit" name="add_workers_group" value="Добавить группу">    
</form>