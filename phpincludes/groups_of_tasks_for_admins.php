<div class="go-back">
    <a class="btn" href="adminpanel.php?id=<?=$_GET['id']?>"><</a>
</div>
<?php $tasks_groups = mysqli_query($connection, "SELECT * FROM `tasks_group` ORDER BY `order_num`");
if (mysqli_num_rows($tasks_groups)) {?>
<main>
    <div class="slider-container">
        <div class="slider-track">
                <?php while ($groups = mysqli_fetch_assoc($tasks_groups)){?>
                    <div class="slider-item">
                        <div class="task-group">
                            <div class="group-header">
                                <div class="group-main-header">
                                    <div class="title-group"><?=$groups['title']?></div>
                                    <div class="group-btns">
                                        <form action="phpincludes/handlers_for_tasks.php" method="POST">
                                            <input class="hidden" name="del_id" value="<?=$groups['id']?>">
                                            <input type="hidden" name="del_on" value="<?=$groups['order_num']?>">
                                            <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="input-hidden">
                                            <button name="del" type="submit" class="btn add-toggle delete-btn">Удалить группу</button>
                                        </form>
                                        <button class="btn add-toggle">Добавить группу</button>
                                        <div class="form-bg hidden">
                                            <form action="phpincludes/handlers_for_tasks.php" method="POST" class="create-group">
                                                <div class="new-form-title">Создать новую группу</div>
                                                <div class="cancel close-form"></div>
                                                <label>
                                                    <div class="form-title new-group-title">Название группы</div>
                                                    <input class="new-group-input" type="text" name="ng-title">
                                                </label>
                                                <label>
                                                    <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="input-hidden">
                                                    <input type="hidden" name="add_on" value="<?=$groups['order_num']?>">
                                                </label>
                                                    <input class="btn n-g-btn" type="submit" name="add-group" value="Подтвердить">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="total-group-cost"><span class="total-group-price">0</span>р.</div>
                            </div>
                            <button class="btn btn-form-toggle">+</button>
                            <div class="form hidden">
                                <form class="add-task-form" action="phpincludes/handlers_for_tasks.php" method="POST">
                                    <div class="form-main-title">Новая задача</div>
                                    <label>
                                        <div class="form-title">Название задачи</div>
                                        <input type="text" name="title">
                                    </label>
                                    <label>
                                        <div class="form-title">Текст задачи</div>
                                        <textarea name="text" rows="5"></textarea>
                                    </label>
                                    <fieldset>
                                        <legend>
                                            Информация о заказчике
                                        </legend> 
                                        <label>
                                            <div class="form-title">Номер заказчика</div>
                                            <input type="tel" name="con-phone">
                                        </label>
                                        <label>
                                            <div class="form-title">Email заказчика</div>
                                            <input type="email" name="con-email">
                                        </label>
                                        <label>
                                            <div class="form-title">Имя заказчика</div>
                                            <input type="text" name="con-name">
                                        </label>
                                    </fieldset>
                                    <label>
                                        <div class="form-title">
                                            <span>Для группы:</span>
                                            <select name="workers-group-id">
                                                <? $users_groups = mysqli_query($connection, "SELECT * FROM `users_groups` WHERE `status` != 'admins' AND `status` != 'managers'");
                                                if (mysqli_num_rows($users_groups)) {
                                                    while ($users_group = mysqli_fetch_assoc($users_groups)) { ?>
                                                    <option value="<?=$users_group['id']?>"><?=$users_group['title']?></option>
                                                <?}}?>
                                            </select>
                                    </div>
                                    </label>
                                    <label>
                                        <div class="form-title">Стоимость заказа</div>
                                        <input type="number" name="cost">
                                    </label>
                                    <input class="hidden" name="add_task_id" value="<?=$groups['id']?>">
                                    <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="input-hidden">
                                        <center>
                                            <input class="btn" type="submit" name="addtask" value="Подтвердить">
                                        </center>
                                </form>
                            </div>
                            <div class="tasks-wrapper">
                            <?$users_groups = mysqli_query($connection, "SELECT * FROM `users_groups` WHERE `status` != 'admins' AND `status` != 'managers'");
                            if (mysqli_num_rows($users_groups)){
                                    while ($users_group = mysqli_fetch_assoc($users_groups)){
                                $tasks = mysqli_query($connection, "SELECT * FROM `tasks` WHERE `group_id` = '".$groups['id']."' AND `users_group_id` = '".$users_group['id']."'");?>
                                <fieldset class="tasks-fieldset">
                                    <legend class="tasks-legend">
                                        <?=$users_group['title']?>
                                    </legend>
                                <?if (mysqli_num_rows($tasks)){?>
                                    <?while ($task = mysqli_fetch_assoc($tasks)){?>
                                        <div class="task">
                                            <div class="task-header">
                                                <h3 class="task-title"><?=$task['title']?></h3>
                                                <div class="task-header-btns">
                                                    <button class="btn dop-info-btn">Развернуть</button>
                                                    <form class="delete-task-form" action="phpincludes/handlers_for_tasks.php" method="post">
                                                        <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="input-hidden">
                                                        <input type="hidden" name="dt_id" value="<?=$task['id']?>">
                                                        <input type="submit" name="del_task" class="btn task-cncl-btn delete-btn" value="Удалить">
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="dop-info-hidden dop-info">
                                                <fieldset>
                                                    <legend>Дополнительная информация</legend>
                                                    <p class="task-text"><?=$task['text']?></p>
                                                    <fieldset>
                                                        <legend>Контакты заказчика</legend>
                                                        <div class="task-contacts">Имя: <?=$task['con_name']?></div>
                                                        <div class="task-contacts">Почта: <?=$task['con_email']?></div>
                                                        <div class="task-contacts">Телефон: <?=$task['con_phone']?></div>
                                                    </fieldset>
                                                </fieldset>
                                            </div>
                                            <div class="task-cost"><span class="task-price"><?=$task['cost']?></span>р.</div>
                                            <div class="task-btns">
                                                <form action="phpincludes/handlers_for_tasks.php" method="POST">
                                                    <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="input-hidden">
                                                    <input class="hidden" name="tm_id" value="<?=$task['id']?>">
                                                    <button type="submit" value="<?=$task['group_id']?>" name="order-minus" class="btn task-minus task-btn">В группу назад</button>
                                                </form>
                                                <form action="phpincludes/handlers_for_tasks.php" method="POST">
                                                    <input type="hidden" name="get-id" value="<?=$_GET['id']?>" class="input-hidden">
                                                    <input class="hidden" name="tp_id" value="<?=$task['id']?>">
                                                    <button type="submit" value="<?=$task['group_id']?>" name="order-plus" class="btn task-plus task-btn">В группу вперед</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?}?>
                                <?}else{?>
                                    <center>Здесь пока ничего нет</center>
                                </fieldset>
                            <?}}}?>
                            </div>
                        </div>
                    </div>
                <?}?>
        </div>
    </div>
    <div class="slider-btns">
        <button class="slider-btn btn-prev"><</button>
        <button class="slider-btn btn-next">></button>
    </div>
</main>  
<?}else{?>
<div class="form-bg">
    <form action="phpincludes/handlers_for_tasks.php" class="create-group" method="POST">
        <div class="new-form-title">Создать новую группу</div>
        <label>
            <div class="form-title new-group-title">Название группы</div>
            <input class="new-group-input" type="text" name="c-new-group-title">
        </label>
        <label>
            <input type="hidden" name="get-id" value="<?=$_GET['id']?>">
            <input type="hidden" name="c-new-group-order" value="1">
        </label>
            <input class="btn n-g-btn" class="create-group-submit" type="submit" name="create-group" value="Подтвердить">
    </form>
</div>
<?}?>