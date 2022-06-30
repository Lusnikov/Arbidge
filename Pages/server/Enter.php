<?php
    require_once('./Database.php');

    $query = $pdo->prepare("SELECT * FROM USERS
    WHERE login=?");
    $query->execute(array($_GET['login']));
    $ar = $query->fetchAll(PDO::FETCH_ASSOC);

  
    if (count($ar)){
        $crypt = hash('sha512',$_GET['password']);
        var_dump($ar[0]['password'] == $crypt);
        $_SESSION['user'] = $ar[0];
       
        header('Location: ../Music/Music.php');
    }
    else{
        echo 'Данные аккаунта неверны';
    }

?>