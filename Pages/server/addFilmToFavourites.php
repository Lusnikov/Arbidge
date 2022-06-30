<?php
    require_once('./Database.php');


    $isBuy = true;

    $query = $pdo->prepare("SELECT * FROM `filmlist` WHERE `film_id`=?");
    $query->execute(array($_GET['id']));
    $price = $query->fetch();
    
    $rentPrice = $price['rent_price'];
    $fullPrice = $price['full_price'];

    if (isset($_GET['isRent'])){
        $isBuy = false;
    }

    if ($userObject && isset($_GET['id'])){
        $resultedPrice = null;
        if ($isBuy){
            $resultedPrice = $fullPrice;
            $query = $pdo->prepare(
                "INSERT INTO `UserLibrary`(`user_id`, `film_id`, `end_lib_date`) 
                 VALUES (?, ?, null)");
        } else{
            $resultedPrice = $rentPrice;
            $query = $pdo->prepare(
                "INSERT INTO `UserLibrary`(`user_id`, `film_id`, `end_lib_date`) 
                 VALUES (?, ?, DATE_ADD(CURRENT_DATE(), INTERVAL 2 DAY))");
         
        }
        var_dump($resultedPrice);
        
        if (dropBalance((int)$resultedPrice, $userObject['user_id'], $pdo)){
            $query->execute(
                array(
                    $userObject['user_id'],
                    $_GET['id'],
                )
            );
            echo $resultedPrice;
            echo 'Покупка успешна';
        }
        else{
            echo 'Недостаточно средств';
        }
       
       
        
    }
    else {
        echo 'Вы не вошли или выбрали неверный фильм';
    }
?>