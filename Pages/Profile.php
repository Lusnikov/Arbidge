<?php
    require('./server/Database.php');

    function sqlDateFormat($date){
       $sqlFormat = explode('-', $date);
        $res = [];
        $res[0] = $sqlFormat[2];
        $res[1] = $sqlFormat[1];
        $res[2] = $sqlFormat[0];
        return implode('.',$res);
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href="./Music/styles/main.css">
</head>
<body>
<header class="header ">
        <div class="header__content">
            <div class="header__logo">
                <a href="./Music.php">
                    <img src="../Images/Arbidgemusic.png" alt="">
                </a>
            </div>
                <ul class="header__nav">

                    <li class="header__nav-element"><a class="" href="./Music/Music.php">Музыка</a></li>
                    <li class="header__nav-element" ><a href="./Films/Films.php">Фильмы</a></li>
                    <li class="header__nav-element" ><a href="./Admin.php">Администрирование</a></li>
                </ul>
              
                <div class="header__profile">
               
                    

         
                    <?php if($userObject) :?>
                        <a href="./Profile.php" class="header__profile-s">
                            <div class="header__avatar">
                                <img src="../../Images/Avatar.svg" alt="">
                            </div>
                           
                        
                            <div class="header__user-name" style="display: block;">
                                    <?= explode(' ', $userObject['fio'])[1];?>
                                    <div class="" style="display: block;">
                                        Баланс: <?=   $userObject['balance'] ?  $userObject['balance']: 0 ;?>
                                    </div>
                                    
                            
                            </div>
                        </a>
                    <?php endif; ?>
                    <?php if(!$userObject) :?>
                        <button class="login-form__open-forms test" style="margin-left: 30px;">Войти</button>
                    <?php else :?>
                        <form action="./server/Logout.php">
                            <button class=" test"  style="margin-left: 30px;">Выйти</button>
                        </form>
                
                     <?php endif; ?>
                    
                </div>
            </div>
        
    </header>
    <main>
        <div class="Container" style="padding: 10px; margin-bottom: 30px;">
            <h2 class="title" style="margin-bottom: 80px">Главное</h2>
            <div class="Profile">
                <div class="Profile__image">
                    <img src="../Images/Avatar.svg" width="202" alt="">
                    <p>Изменить фотографию</p>
                </div>
                <div class="Profile__forms">
                    <form action="1">
                        <label class="main-input">
                            <input name="login"  type="text" class="main-input__input main-input__label-fixed">
                            <p class="main-input__label ">Логин</p>
                        </label>
                        <button class="test" type="submit">Изменить</button>
                    </form>
                    <form action="1">
                        <label class="main-input" >
                            <input name="login"  type="text" class="main-input__input main-input__label-fixed">
                            <p class="main-input__label ">ФИО</p>
                        </label>
                        <button class="test" type="submit">Изменить</button>
                    </form>
                    <form action="./server/build/index.html">
                        <label class="main-input" >
                            <input name="sum"  type="number" class="main-input__input main-input__label-fixed">
                            <p class="main-input__label ">Сумма пополнения</p>
                        </label>
                        <button class="test" type="submit" href="">Пополнить</button>
                        
                    </form>

                </div>
            </div>
            <section class="subscribe">
                <h2 class="title subscribe__title">Подписки</h2>
                <p class="subscribe__paragraph">
                    Здесь будут отображаться ваши подписки на наши сервисы.
                </p>
                <p class="subscribe__paragraph">
                    Для просмотра существующих подписок  интересующий
                    вас раздел

                <div class="subscribe__variations">
                    <p>
                        <span class="subscribe__section subscribe__section-active" data-id="1">AbridgeMovie</span>
                        or
                        <span class="subscribe__section" data-id="2">AbridgeMusic</span>
                    </p>

                    <div class="subscribe__info " data-id="1">
                        <p>Текущая действующая подписка на <span class="subscribe__section-active">AbridgeMovie</span></p>
                        <div class="subscribe__item">
                            <?php if($userObject['subscribe_id'] == 1) :?>
                                <h2 class="subscribe__name">
                                    Подписки нет, можно оформить
                                </h2>
                                <div class="">
                                    <a class="subscribe__cancel еу" href="./Subscribe.php">
                                        Получить подписку
                                    </a>
                                </div>
                            <?php else: ?> 
                                <h2 class="subscribe__name">
                                    <?php
                                        $query = $pdo->prepare("SELECT * FROM Subscribes WHERE subscribe_id=?");
                                        $query->execute(array($userObject['subscribe_id']));
                                        $result = $query->fetch();
                                
                                    ?>
                                Подписка “<?= $result['subscribe_name'];?>”
                                </h2>
                                <p class="subscribe__end">
                                    
                                    Истекает <?= sqlDateFormat($userObject['end_subscribe_date']) ;?>
                                </p>
                                <a class="subscribe__cancel" href="./server/stopSubscribe.php">
                                    Отменить подписку
                                </a>

                             <?php endif; ?>
                           
                           

                        </div>
                    </div>
                    <div class="subscribe__info hidden" data-id="2">
                        <p>Текущая действующая подписка на <span class="subscribe__section-active">AbridgeMusic</span></p>
                        <div class="subscribe__item">
                        <?php if($userObject['subscribe_id'] == 1) :?>
                                <h2 class="subscribe__name">
                                    Подписки нет, можно оформить
                                </h2>
                                <div class="">
                                    <a class="subscribe__cancel" href="./Subscribe.php">
                                        Получить подписку
                                    </a>
                                </div>
                            <?php else: ?> 
                                <h2 class="subscribe__name">
                                    <?php
                                        $query = $pdo->prepare("SELECT * FROM Subscribes WHERE subscribe_id=?");
                                        $query->execute(array($userObject['subscribe_id']));
                                        $result = $query->fetch();
                                
                                    ?>
                                Подписка “<?= $result['subscribe_name'];?>”
                                </h2>
                                <p class="subscribe__end">
                                    
                                    Истекает <?= sqlDateFormat($userObject['end_subscribe_date']) ;?>
                                </p>
                                <a class="subscribe__cancel" href="./server/stopSubscribe.php">
                                    Отменить подписку
                                </a>

                             <?php endif; ?>

                        </div>
                    </div>
                </div>
            </section>
     
            
        </div>
    </main>
   
    <script src="./Music/scripts/Input.js"></script>
    <script src="./scripts/changeSubscribes.js"></script>
    <script src="./Music/scripts/header.js"></script>


</body>
</html>