<div class="go-back">
    <a class="btn" href="index.php"><</a>
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
                                    <h3 class="title-group"><?=$groups['title']?></h3>
                                </div>
                                <div class="total-group-cost"><span class="total-group-price">0</span>р.</div>
                            </div>
                            <?$tasks = mysqli_query($connection, "SELECT * FROM `tasks` WHERE `group_id` = '".$groups['id']."' AND `users_group_id` ='".$group_id."'");
                            if (mysqli_num_rows($tasks)) {
                                while ($task = mysqli_fetch_assoc($tasks)) {?>
                                    <div class="task">
                                            <div class="task-header">
                                                <h3 class="task-title"><?=$task['title']?></h3>
                                                <div class="task-header-btns">
                                                    <button class="btn dop-info-btn">Развернуть</button>
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
                            <?}}?>
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
Здесь пока ничего нет
<?}?>