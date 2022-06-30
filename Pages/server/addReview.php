<?php
     require('../server/Database.php');
     var_dump($_GET);

    //  var_dump($userObject);

     $query = $pdo->prepare("INSERT INTO Reviews(user_id, film_id, stars, review_text) VALUES (?, ?, ?, ?)");
     $query->execute(array(
        $userObject['user_id'],
        $_GET['film-id'],
        $_GET['rating'],

        $_GET['text']
     ));
     $result = $query->fetchAll(PDO::FETCH_ASSOC);

     echo 1;