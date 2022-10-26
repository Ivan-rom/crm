<?php include "config.php";
$get_id = $_POST['get-id'];

$ng_title = $_POST['ng-title'];
$add_group_od = $_POST['add_on'];
if(isset($_POST['add-group'])){
    $on_gt_s = mysqli_query($connection, "SELECT * FROM `tasks_group` WHERE `order_num` >" . $add_group_od);
    if (mysqli_num_rows($on_gt_s)){
        while ($on_gt = mysqli_fetch_assoc($on_gt_s)){
            $total_gt = $on_gt['order_num'] + 1;
            mysqli_query($connection, "UPDATE `tasks_group` SET `order_num` = '".$total_gt."' WHERE `id` = ".$on_gt['id']."");
        }
    }
    $add_group_od = $add_group_od + 1;
    mysqli_query($connection, "INSERT INTO `tasks_group`(`title`, `order_num`) VALUES ('".$ng_title."','".$add_group_od."')");
}

$group_id_tm = $_POST['order-minus'];
$tm_id = $_POST['tm_id'];
if(isset($_POST['order-minus'])){
    $group_order_tm = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `order_num` FROM `tasks_group` WHERE `id` = ".$group_id_tm))['order_num'];
    $goal_order_num = $group_order_tm - 1;
    $goal_group_q = mysqli_query($connection, "SELECT * FROM `tasks_group` WHERE `order_num` = ". $goal_order_num);
    if (mysqli_num_rows($goal_group_q)){
        $goal_group = mysqli_fetch_assoc($goal_group_q);
        $goal_group_id = $goal_group['id'];
        mysqli_query($connection, "UPDATE `tasks` SET `group_id` = '".$goal_group_id."' WHERE `id` = ".$tm_id);
    }}
$group_id_tp = $_POST['order-plus'];
$tp_id = $_POST['tp_id'];
if(isset($_POST['order-plus'])){
    $group_order_tp = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `order_num` FROM `tasks_group` WHERE `id` = ".$group_id_tp))['order_num'];
    $goal_order_num = $group_order_tp + 1;
    $goal_group_q = mysqli_query($connection, "SELECT * FROM `tasks_group` WHERE `order_num` = ". $goal_order_num);
    if (mysqli_num_rows($goal_group_q)){
        $goal_group = mysqli_fetch_assoc($goal_group_q);
        $goal_group_id = $goal_group['id'];
        mysqli_query($connection, "UPDATE `tasks` SET `group_id` = '".$goal_group_id."' WHERE `id` = ".$tp_id);
    }}

$title = $_POST['title'];
$text = $_POST['text'];
$con_phone = $_POST['con-phone'];
$con_email = $_POST['con-email'];
$con_name = $_POST['con-name'];
$cost = $_POST['cost'];
$at_id = $_POST['add_task_id'];
$w_id = $_POST['workers-group-id'];
if(isset($_POST['addtask'])){mysqli_query($connection, "INSERT INTO `tasks`(`title`, `text`, `cost`, `con_phone`, `con_email`, `con_name`, `users_group_id`, `group_id`) VALUES ('".$title."','".$text."','".$cost."','".$con_phone."','".$con_email."','".$con_name."','".$w_id."','".$at_id."')");}

$c_ng_title = $_POST['c-new-group-title'];
$c_ng_order = $_POST['c-new-group-order'];
if(isset($_POST['create-group'])){mysqli_query($connection, "INSERT INTO `tasks_group`(`id`, `title`, `order_num`) VALUES (NULL,'".$c_ng_title."','".$c_ng_order."')");}

$dt_id = $_POST['dt_id'];
if(isset($_POST['del_task'])){mysqli_query($connection, "DELETE FROM `tasks` WHERE `id` = " . $dt_id);}

$d_id = $_POST['del_id'];
$d_on = $_POST['del_on'];
if(isset($_POST['del'])){
    $orders_down = mysqli_query($connection, "SELECT * FROM `tasks_group` WHERE `order_num` >" . $d_on);
    if (mysqli_num_rows($orders_down)) {
        while ($o_d = mysqli_fetch_assoc($orders_down)){
            $total = $o_d['order_num'] - 1;
            mysqli_query($connection, "UPDATE `tasks_group` SET `order_num` = '".$total."' WHERE `id` = ".$o_d['id']."");}}
    mysqli_query($connection, "DELETE FROM `tasks` WHERE `group_id` = " . $d_id);
    mysqli_query($connection, "DELETE FROM `tasks_group` WHERE `id` = " . $d_id);
}

header("location: ../tasks.php?id=".$get_id."");