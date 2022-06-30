<?php
 require('../server/Database.php');

 $query = $pdo->prepare(
     "SELECT * FROM `filmlist`
        ORDER BY `filmlist`.`film_id`  DESC LIMIT 4");
 $query->execute();
 $result = $query->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/pleer.css">
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <header class="header ">
        <div class="header__content">
            <div class="header__logo">
                <a href="./Music.php">
                    <img src="../../Images/Arbidgemusic.png" alt="">
                </a>
            </div>
                <ul class="header__nav">
                    <li class="header__form hidden">
                    <form action="./foundMusic.php">
                            <div class="header__form-control">
                                <button>
                                    <img src="../../Images/Found.svg" alt="" width="24px">
                                </button>
                                
                                <input name="music-name" class="header__found-input" type="text">
                                <button type="button" class="header__close-found-input">x</button>
                            </div>
                            
                        </form>
                    </li>
                    <li class="header__nav-element"><a class="" href="#">Подкасты</a></li>
                    <li class="header__nav-element" ><a href="../Subscribe.php">Подписки</a></li>
                    <li class="header__nav-element" ><a href="./LikedSongs.php">Избранное</a></li>
                    
                      
                </ul>
              
                <div class="header__profile">
                    <button class="header__found">
                        <img src="../../Images/Found.svg" alt="">

                    </button>
                    

         
                    <?php if($userObject) :?>
                        <a href="../Profile.php" class="header__profile-s">
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
                        <form action="../server/Logout.php">
                            <button class=" test"  style="margin-left: 30px;">Выйти</button>
                        </form>
                
                     <?php endif; ?>
                    
                </div>
            </div>
        
    </header>
 
    <div class="modal auth__modal">
        <form class="forms  modal__content login-form">
            <h2>Вход личный кабинет</h2>
            <div class="login-form__image">
                <img src="../../Images/account_avatar_people_profile_user_icon_123297 2.svg" alt="">
            </div>
            <div class="login-form__content">
                <div class="login-form__input">
                    <label class="main-input main-input_dark login-form__input" for="">
                        <input name="login"  type="text" class="main-input__input main-input__label-fixed">
                        <p class="main-input__label ">Логин</p>
                    </label>
                </div>
                <div class="login-form__input">         
                    <label class="main-input main-input_dark login-form__input" for="">
                        <input name="login"  type="text" class="main-input__input main-input__label-fixed">
                        <p class="main-input__label ">Пароль</p>
                    </label>
                </div>
                <button class="">
                    Войти
                </button>
                <a class="login-form__forgot" href="">Забыли пароль?</a>
                <button class="login-form__toReg">К регистрации</button>
              
            </div>
        </form>
        <form class="forms   modal__content registration-form">
            <h2>Регистрация</h2>
            <div class="login-form__image">
                <img src="../../Images/account_avatar_people_profile_user_icon_123297 2.svg" alt="">
            </div>
            <div class="login-form__content">
                <div class="login-form__input">
                    <label class="main-input main-input_dark login-form__input" for="">
                        <input name="login"  type="text" class="main-input__input main-input__label-fixed">
                        <p class="main-input__label ">Логин</p>
                    </label>
                </div>
                <div class="login-form__input">         
                    <label class="main-input main-input_dark login-form__input" for="">
                        <input name="login"  type="text" class="main-input__input main-input__label-fixed">
                        <p class="main-input__label ">Пароль</p>
                    </label>
                </div>
                <button class="login-form__sumbit">
                    Войти
                </button>
                <a class="login-form__forgot" href="">Забыли пароль?</a>
                <button class="login-form__toReg">К регистрации</button>
              
            </div>
        </form>
    </div>

    <main>
        <section class="main">
            <div class="Container" style="padding: 10px; margin-bottom: 30px;">
                <h2 class="title">Новинки</h2>
            </div>

            <div class="carusel">
                <button class="carusel__slide-btn carusel__slide-btn_right" disabled>
                    <svg width="29" height="33" viewBox="0 0 29 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.494204 3.84314L5.76479 0L28.353 16.4706L5.76479 32.9412L0.494204 29.098L17.8119 16.4706L0.494204 3.84314Z" fill="#393939"/>
                    </svg>
                        
                </button>
                <button class="carusel__slide-btn carusel__slide-btn_left">
                    <svg width="28" height="33" viewBox="0 0 28 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.8588 29.098L22.5882 32.9412L0 16.4706L22.5882 -1.52588e-05L27.8588 3.84312L10.5412 16.4706L27.8588 29.098Z" fill="#393939"/>
                    </svg>
                        
                </button>
                <div class="carusel__scroll">
                    <?php foreach($result as $film) :?>
                        
                        <div class="carusel__item main-carusel">
                            <a href="">
                                
                            </a>
                            <div class="main-carusel__photo">
                                <a href="./ChoosenFIlm.php?id=<?= $film['film_id'];?>">
                                <img src="./video/<?= $film['film_image'];?>" alt="">
                            </a>
                            </div>
                            <div class="main-carusel__film-info">
                            <h2 class="main-carusel__film-name">
                                  <?= $film['film_name'] ;?>
                            </h2>
                            <p class="main-carusel__film-year">
                                <?= $film['film_year'] ;?>
                            </p>
                            <?php
                                $value = null;
                                 if($film['subscribe_id'] == 1){
                                    $value = "FREE";
                                 } elseif ($film['subscribe_id'] == 2){
                                     $value = "PRO";
                                 } else $value = "ELITE"
                           ?>
                            <div class="bage bage_<?= $value;?>">
                                <a href="#">
                                        <?= $value;?>
                                </a>   
                            </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                   

                    
                   
                  
                    
                </div>
                
            </div>
            <div class="Container">
                <div class="offer">
                    <p class="offer__content">
                        Оформите подписку и получите безграничный доступ к контенту
                    </p>
                    <a class="offer__link" href="#">
                            Оформить
                    </a>
                </div>
            </div>
            <div class="Container" style="padding: 10px; margin-bottom: 30px;">
                <h2 class="title">Детективы</h2>
                <?php
         
                    $query = $pdo->prepare(
                        " SELECT * FROM Films
                          JOIN FilmGenres ON Films.film_id=FilmGenres.film_id
                          where FilmGenres.genre_id=6");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                  
                ?>
            </div>
            <div class="carusel">
                <button class="carusel__slide-btn carusel__slide-btn_right">
                    <svg width="29" height="33" viewBox="0 0 29 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.494204 3.84314L5.76479 0L28.353 16.4706L5.76479 32.9412L0.494204 29.098L17.8119 16.4706L0.494204 3.84314Z" fill="#393939"/>
                    </svg>
                        
                </button>
                <button class="carusel__slide-btn carusel__slide-btn_left">
                    <svg width="28" height="33" viewBox="0 0 28 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.8588 29.098L22.5882 32.9412L0 16.4706L22.5882 -1.52588e-05L27.8588 3.84312L10.5412 16.4706L27.8588 29.098Z" fill="#393939"/>
                    </svg>
                        
                </button>
                <div class="carusel__scroll">
                  
                   
                
                   <?php foreach($result as $detectiveFilm) :?>
                    <div class="carusel__item standart-carusel">
                        <a href="./ChoosenFilm.php?id=<?= $detectiveFilm['film_id'];?>">
                            <div class="standart-carusel__photo">
                                <img src="./video/<?= $detectiveFilm['film_image'] ;?>" alt="">
                            </div>
                        </a>
                       
                        <div class="standart-carusel__film-info">
                           <h2 class="standart-carusel__film-name">
                                <?= $detectiveFilm['film_name'] ;?>
                           </h2>
                           <p class="standart-carusel__film-year">
                           <?= $detectiveFilm['film_year'] ;?>
                           </p>

                           <?php
                                $value = null;
                                 if($detectiveFilm['subscribe_id'] == 1){
                                    $value = "FREE";
                                 } elseif ($detectiveFilm['subscribe_id'] == 2){
                                     $value = "PRO";
                                 } else $value = "ELITE"
                           ?>
                           <div class="bage bage_<?= $value;?>">
                               <a href="#">
                                    <?= $value;?>
                               </a>   
                           </div>
                    </div>       
                    </div>
                   <?php endforeach; ?>
                    </div>
                    </div>
                                
                    <div class="Container" style="padding: 10px; margin-bottom: 30px;">
                <h2 class="title">Ужасы</h2>
                <?php
         
                    $query = $pdo->prepare(
                        " SELECT * FROM Films
                          JOIN FilmGenres ON Films.film_id=FilmGenres.film_id
                          where FilmGenres.genre_id=3");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                  
                ?>
            </div>
            <div class="carusel">
                <button class="carusel__slide-btn carusel__slide-btn_right">
                    <svg width="29" height="33" viewBox="0 0 29 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.494204 3.84314L5.76479 0L28.353 16.4706L5.76479 32.9412L0.494204 29.098L17.8119 16.4706L0.494204 3.84314Z" fill="#393939"/>
                    </svg>
                        
                </button>
                <button class="carusel__slide-btn carusel__slide-btn_left">
                    <svg width="28" height="33" viewBox="0 0 28 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.8588 29.098L22.5882 32.9412L0 16.4706L22.5882 -1.52588e-05L27.8588 3.84312L10.5412 16.4706L27.8588 29.098Z" fill="#393939"/>
                    </svg>
                        
                </button>
                <div class="carusel__scroll">
                
                   <?php foreach($result as $detectiveFilm) :?>
                    <div class="carusel__item standart-carusel">
                        <a href="./ChoosenFilm.php?id=<?= $detectiveFilm['film_id'];?>">
                            <div class="standart-carusel__photo">
                                <img src="./video/<?= $detectiveFilm['film_image'];?>" alt="">
                            </div>
                        </a>
                       
                        <div class="standart-carusel__film-info">
                           <h2 class="standart-carusel__film-name">
                                <?= $detectiveFilm['film_name'] ;?>
                           </h2>
                           <p class="standart-carusel__film-year">
                           <?= $detectiveFilm['film_year'] ;?>
                           </p>

                           <?php
                                $value = null;
                                 if($detectiveFilm['subscribe_id'] == 1){
                                    $value = "FREE";
                                 } elseif ($detectiveFilm['subscribe_id'] == 2){
                                     $value = "PRO";
                                 } else $value = "ELITE"
                           ?>
                           <div class="bage bage_<?= $value;?>">
                               <a href="#">
                                    <?= $value;?>
                               </a>   
                           </div>
                    </div>       
                    </div>
                   <?php endforeach; ?>
                    </div>
                    </div>
                 
          
                
            
            
            
        </section>

      
    </main>

    <script src="./scripts/header.js"></script>
    <script src="./scripts/pleer.js"></script>
    <script src="./scripts/Input.js"></script>
    <script src="./scripts/forms.js"></script>
    <script src="./scripts/slider.js"></script>
</body>
</html>