<?php
    require_once('./Database.php');
    var_dump($_FILES);

    $filename = upload_image( $_FILES['file'], '../Music/musicFiles');

    
    $query = $pdo->prepare("INSERT INTO `Music`( `album_id`, `music_name`, `music_url`) VALUES (?,?,?)");
    $query->execute(array(
        $_POST['album'],
        $_POST['name'],
        $filename 
    ));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    // header('Location: ../Admin.php');
