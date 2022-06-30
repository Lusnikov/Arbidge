<?php
    require_once('./Database.php');

    $query = $pdo->prepare("SELECT * FROM USERS
    WHERE login=?");
    $query->execute(array($_GET['login']));
    $ar = $query->fetchAll(PDO::FETCH_ASSOC);

    if (fieldsIsValid($_GET)){
        if (!count($ar)){
            $crypt = hash('sha512',$_GET['password']);
            $dateFormat =   formatDate($_GET['date']);
            $query = $pdo->prepare(
                "INSERT INTO USERS(fio, phone, birhday, email, login, password) 
                VALUES (?,?,?,?,?, ?)");
            $query->execute(
                array(
                    $_GET['FIO'],
                    $_GET['Phone'],
                    $dateFormat,
                    $_GET['email'],
                    $_GET['login'],
                    $crypt,
                   
                )
            );
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            header('Location: ../Music/Music.php');
        }
        else{
            echo 'Пользователем с таким логином уже существует. Введите другой';
        }
    } else{
        echo 'Некоторые поля пустые';
    }

 
    

?>