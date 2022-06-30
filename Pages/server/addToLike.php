<?php
    require_once('./Database.php');

    $query = $pdo->prepare("SELECT * FROM `UserMusicLibrary` 
                            where music_id=? AND user_id=?");
    $query->execute(array($_GET['id'], $userObject['user_id']));
    $checkResult = $query->fetch();

    var_dump($checkResult);
    $id = $checkResult['idMusicLibrary'];

    if (!$checkResult){
        $query = $pdo->prepare("INSERT INTO `UserMusicLibrary`( `user_id`, `music_id`) VALUES (?, ?)");
        $query->execute(array($userObject['user_id'], $_GET['id']));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
       
    }
    else{
        echo 'убрать';
        $query = $pdo->prepare("DELETE FROM UserMusicLibrary WHERE idMusicLibrary=? ");
        $query->execute(array($id));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }
 

    header('Location: ../Music/Music.php');


    
?>