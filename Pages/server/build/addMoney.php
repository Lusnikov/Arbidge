<?php

require('../Database.php');
var_dump($_GET);

$cardNumber = implode(explode(' ',$_GET['number']));
$cardHolder = strtoupper($_GET['name']);
$expiry = $_GET['expiry'];
$cvc = $_GET['cvc'];
$money = $_GET['money'];



// ТЕСТОВЫЙ ДАННЫЕ АКТИВНОЙ КАРТЫ
// 4444 4444 4444 4444
// LUSHNIKOV KIRILL
// 04/44
// 444

// var_dump($cardHolder === 'LUSHNIKOV KIRILL');
// var_dump($cardNumber == '4444444444444444');
// var_dump($cvc === '444');
// var_dump($expiry === '04/44');


$dataIsRight = ( $cardHolder === 'LUSHNIKOV KIRILL' ) &&  ( $cardNumber == '4444444444444444')
             &&  ( $cvc === '444' ) &&   ($expiry === '04/44');

if ($dataIsRight){
    $query = $pdo->prepare("UPDATE `USERS` SET balance=balance+? WHERE user_id=?");
    $query->execute(array( $_GET['money'],$userObject['user_id']) );

    $query = $pdo->prepare("SELECT * FROM USERS WHERE user_id=? ");
    $query->execute(array($userObject['user_id']));
    $result = $query->fetch();
    $_SESSION['user'] = $result;

    $query = $pdo->prepare("INSERT INTO `Logs`(`user_id`, `type`, `description`) VALUES (?,'Money' , ?)");
    $query->execute(array(
        $userObject['user_id'],
        'Пополнение средств на '.$money.' рублей',

    ));
   
   
    header('Location: ../../Profile.php');
}

echo 1;
