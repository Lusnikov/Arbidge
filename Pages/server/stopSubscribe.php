<?php
    require('./Database.php');

    $query = $pdo->prepare("UPDATE `USERS` SET `subscribe_id`=1,`end_subscribe_date`=null WHERE user_id=?");
    $query->execute(array($userObject['user_id']));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    header('Location: ../Profile.php');