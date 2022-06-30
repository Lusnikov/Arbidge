<?php
    require_once('./Database.php');

    $query = $pdo->prepare("SELECT * FROM `Subscribes` WHERE `subscribe_id`=?");
    $query->execute(array($_GET['id']));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $subscribePrice = $result[0]['month_price'];



    
    if ( $subscribePrice <= $userObject['balance'] && $userObject['subscribe_id'] != 2 &&  $userObject['subscribe_id'] != 3){
        $query = $pdo->prepare(
            "UPDATE `USERS` 
            SET `subscribe_id`=? ,
                balance=balance-?,
                `end_subscribe_date`=DATE_ADD( CURRENT_DATE(), INTERVAL 1 MONTH)
            WHERE user_id=?
        ");
    
        $query->execute(
            array(
                $_GET['id'],
                $subscribePrice,
                $userObject['user_id']
            )
        );


    }
   
    header('Location: ../Profile.php');
   
