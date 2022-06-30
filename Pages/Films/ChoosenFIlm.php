<?php
 require('../server/Database.php');

 $query = $pdo->prepare("SELECT * FROM `filmlist` WHERE film_id=?");
 $query->execute(array($_GET['id']));

 $result = $query->fetch();

 $filmIsFree = $result['subscribe_id'] == 1 ? true : false;
 $a = null;
 if ($userObject){
    $query = $pdo->prepare("SELECT * FROM `UserLibrary` WHERE `user_id`=? AND film_id=?");
    $query->execute(array($userObject['user_id'],$_GET['id'] ));
    $a = $query->fetch();
 }
 $userCanSee = $filmIsFree || (int)$userObject['subscribe_id'] >= (int)$result['subscribe_id'] || $a;

 $value = null;
 if($result['subscribe_id'] == 1){
    $value = "FREE";
 } elseif ($result['subscribe_id'] == 2){
     $value = "PRO";
 } else $value = "ELITE";

 $description = $result['film_description'];
 $resultDescription = [];

 $dividedResult = explode('.', $description);
 $string = '';

 for ($i=1; $i<=count($dividedResult); $i++){
    if ($i%3==0 || $i==count($dividedResult)){
        array_push($resultDescription, $string);  
    } 
    $string =  $string.$dividedResult[$i].'. ';
 }



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


 
    <?php require('../loginModal.php') ;?>
    <div class="modal review-modal" style="position: fixed;">
        <form class="forms  modal__content login-form" action="../server/addReview.php">
            <h2>Отзыв</h2>

            <input name="rating" id="review-input" type="hidden" value="1">
            <input name="film-id" type="text" value="<?=  $_GET['id'] ;?>">
            <div class="login-form__image">
                <img src="../../Images/account_avatar_people_profile_user_icon_123297 2.svg" alt="">
            </div>
            <div class="login-form__content">
                <div class="login-form__input">
                    <label class="main-input main-input_dark login-form__input" for="">
                        <textarea style="width: 100%" name="text" id="" cols="30" rows="10"></textarea>
                    </label>
                </div>
               
                <button class="test" style="color: black;" type="submit">
                   Создать отзыв
                </button>  
            </div>
        </form>
      
    </div>
    
    <main>
        <section class="main">
            <div class="film-player ">
                <div class="film-player__header">
                    <div class="film-player__background">
                        <img src="./video/<?= $result['film_image'];?>" alt="">
                    </div>
                    <div class="film-player__main-info">
                        
                        <div class="film-player__rating">
                            <?= $result['rating'] ? $result['rating'] : 'Рейтинга еще нет' ; ?>
                        </div>
                        <div class="bage bage_<?= $value; ?>">
                            <a href="#">
                                <?= $value; ?>
                            </a>   
                        </div>
                        <div class="film-player__name">
                            <?= $result['film_name'] ;?>
                        </div>
                        <div class="film-player__date">
                            2020
                        </div>
                        <?php if($userCanSee) :?>
                            <button class="film-player__start-btn start-watch" >
                            Начать просмотр
                        </button>
                        <?php else :?>
                            <a class="film-player__start-btn" href="../Subscribe.php" style="display: inline-block;">
                            Смотреть по подписке
                             </a>  
                             <div class="" style="margin: 10px 0">
                              или
                             </div>
                             <div class="">
                                 <a href="../server/addFilmToFavourites.php?id=<?= $_GET['id'] ;?>" class="film-player__start-btn" style="display: inline-block;"> Купить за <?=  $result['full_price']  ?>р</a>
                                 <a href="../server/addFilmToFavourites.php?id=<?= $_GET['id'] ;?>&isRent" class="film-player__start-btn" style="display: inline-block;"> Напрокат за <?=  $result['rent_price']  ?>р</a>
                             </div>
                          
                        <?php endif; ?>
                     
                      
                    </div>
                    
                </div>
                
                <div class="film-player__video">
                    <video src="./video/film.mp4" id="myVideo"></video>

                    <div class="PANEL">
                        <div class="film-player__progress-bar">
                            <input class="input-range" type="range" max="100">
                            <p class="TIMEINPUT">TIME</p>
                        </div>
                        <div class="film-player__panel">
                            <button class="film-player__toggle-Video">
                                <svg width="37" height="37" viewBox="0 0 57 57" fill="white" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.9714 0C12.5118 0 0 12.4942 0 27.9353C0 43.3751 12.5101 55.8707 27.9714 55.8707C43.431 55.8707 55.9427 43.3765 55.9427 27.9353C55.9427 12.4956 43.4324 0 27.9714 0ZM38.0496 31.0364L24.9059 38.6212C23.7971 39.261 22.4299 39.2621 21.3192 38.6221C20.2093 37.9825 19.5256 36.7999 19.5256 35.5202V20.3506C19.5256 19.0708 20.2094 17.8883 21.3192 17.2487C21.8738 16.9289 22.4928 16.7691 23.1118 16.7691C23.7313 16.7691 24.3509 16.9293 24.9059 17.2494L38.0497 24.8342C39.1586 25.4741 39.8416 26.6561 39.8416 27.9352C39.8416 29.2145 39.1585 30.3964 38.0496 31.0364Z" 
                                    fill="white"/>
                                    <!-- <path d="M16.6775 55.9999H5.80509C3.15132 55.9999 1 53.8777 1 51.2598V5.78457C1 3.16666 3.15132 1.04443 5.80509 1.04443H16.6775C19.3313 1.04443 21.4826 3.16666 21.4826 5.78457V51.2598C21.4826 53.8777 19.3313 55.9999 16.6775 55.9999Z" fill="black"/>
                                    <path d="M51.1949 55.9555H40.3224C37.6686 55.9555 35.5173 53.8332 35.5173 51.2153V5.74014C35.5173 3.12223 37.6686 1 40.3224 1H51.1949C53.8486 1 56 3.12223 56 5.74014V51.2153C56 53.8332 53.8486 55.9555 51.1949 55.9555Z" fill="black"/>
                                    <path d="M17.5107 1.12744C18.4485 1.99246 19.0437 3.21479 19.0437 4.58148V50.0567C19.0437 52.6746 16.8924 54.7968 14.2386 54.7968H3.36617C3.08079 54.7968 2.80517 54.7607 2.5332 54.7138C3.39178 55.5054 4.53695 55.9999 5.8053 55.9999H16.6777C19.3315 55.9999 21.4828 53.8777 21.4828 51.2598V5.78456C21.4828 3.44818 19.7657 1.51844 17.5107 1.12744Z" fill="black"/>
                                    <path d="M52.028 1.08301C52.9659 1.94802 53.561 3.17035 53.561 4.53705V50.0123C53.561 52.6302 51.4097 54.7524 48.7559 54.7524H37.8835C37.5981 54.7524 37.3225 54.7163 37.0505 54.6694C37.9091 55.461 39.0543 55.9555 40.3226 55.9555H51.1951C53.8488 55.9555 56.0002 53.8332 56.0002 51.2153V5.74013C56.0002 3.40375 54.283 1.47281 52.028 1.08301Z" fill="black"/>
                                    <path d="M16.6775 55.9999H5.80509C3.15132 55.9999 1 53.8777 1 51.2598V5.78457C1 3.16666 3.15132 1.04443 5.80509 1.04443H16.6775C19.3313 1.04443 21.4826 3.16666 21.4826 5.78457V51.2598C21.4826 53.8777 19.3313 55.9999 16.6775 55.9999Z" stroke="black" stroke-miterlimit="10"/>
                                    <path d="M51.1949 55.9555H40.3224C37.6686 55.9555 35.5173 53.8332 35.5173 51.2153V5.74014C35.5173 3.12223 37.6686 1 40.3224 1H51.1949C53.8486 1 56 3.12223 56 5.74014V51.2153C56 53.8332 53.8486 55.9555 51.1949 55.9555Z" stroke="black" stroke-miterlimit="10"/> -->
                                    </svg>		
                                    
                                
                                    </svg>	
                            </button>
                            <button class="full-width-btn">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 36V0H36V36H0ZM33.2308 2.775H2.76923V33.2308H33.2308V2.775V2.775V2.775ZM8.30769 25.7365L25.7308 8.30192H19.3846V5.53269H27.6923H30.4615V8.30192V16.6038H27.6923V10.2577L10.2692 27.6865H16.6154V30.4558H8.30769H5.53846V27.6865V19.3788H8.30769V25.7365V25.7365Z" fill="white"/>
                                    </svg>
                                    
                            </button>	
                    </div>
                </div>
                
            </div>
           </div>

           <div class="about">
              <h2 class="title Container" style="padding: 10px; margin-bottom: 30px;">Новинки</h2>
            

              <?php 
                    for ($i=1; $i<=count($resultDescription); $i++){
                        if ($i>2){
                            echo '  <p class="about__paragraph hidden">'.$resultDescription[$i].'</p>';
                            continue;
                         }
                       echo '  <p class="about__paragraph">'.$resultDescription[$i].'</p>';
                    }

             ?>
            
            <?php if(count($resultDescription) >2 ) :?>
                <button class="about__toggle expand">Развернуть</button>
            <?php endif; ?>
       
           </div>
          <div class="review">
            <h2 class="title Container" style="padding: 10px; margin-bottom: 30px;">
              Оставьте отзыв
            </h2>
            <div class="review__stars">
              <svg class="review__star-item " viewBox="0 0 48 44" fill="none" xmlns="http://www.w3.org/2000/svg" data-value="5">
                <path d="M48 16.9231H30.8571L24 0L17.1429 16.9231H0L15.4286 27.0769L8.57143 44L24 33.8462L39.4286 44L32.5714 27.0769L48 16.9231Z" fill=""/>
              </svg>
              <svg class="review__star-item" viewBox="0 0 48 44" fill="none" xmlns="http://www.w3.org/2000/svg" data-value="4">
                <path d="M48 16.9231H30.8571L24 0L17.1429 16.9231H0L15.4286 27.0769L8.57143 44L24 33.8462L39.4286 44L32.5714 27.0769L48 16.9231Z" fill=""/>
              </svg>
              <svg class="review__star-item" viewBox="0 0 48 44" fill="none" xmlns="http://www.w3.org/2000/svg" data-value="3">
                <path d="M48 16.9231H30.8571L24 0L17.1429 16.9231H0L15.4286 27.0769L8.57143 44L24 33.8462L39.4286 44L32.5714 27.0769L48 16.9231Z" fill=""/>
              </svg>
              <svg class="review__star-item" viewBox="0 0 48 44" fill="none" xmlns="http://www.w3.org/2000/svg" data-value="2">
                <path d="M48 16.9231H30.8571L24 0L17.1429 16.9231H0L15.4286 27.0769L8.57143 44L24 33.8462L39.4286 44L32.5714 27.0769L48 16.9231Z" fill=""/>
              </svg>
              <svg class="review__star-item" viewBox="0 0 48 44" fill="none" xmlns="http://www.w3.org/2000/svg" data-value="1">
                <path d="M48 16.9231H30.8571L24 0L17.1429 16.9231H0L15.4286 27.0769L8.57143 44L24 33.8462L39.4286 44L32.5714 27.0769L48 16.9231Z" fill=""/>
              </svg>
                
            </div>
            <button class="review__submit">Оставить отзыв</button>
          </div>
         
          <div class="carusel recommends">
            <h2 class="title Container" style="padding: 10px; margin-bottom: 30px;">Рекомендуем к просмотру</h2>
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
            
                <div class="carusel__item standart-carusel">
                    <div class="standart-carusel__photo">
                        <img src="./images/SHELLY.png" alt="">
                    </div>
                    <div class="standart-carusel__film-info">
                       <h2 class="standart-carusel__film-name">
                            Биография Булла
                       </h2>
                       <p class="standart-carusel__film-year">
                            2020
                       </p>
                       <div class="bage bage_ELITE">
                           <a href="#">
                                ELITE
                           </a>   
                       </div>
                </div>       
                </div>
                <div class="carusel__item standart-carusel">
                    <div class="standart-carusel__photo">
                        <img src="./images/BULLFILM.png" alt="">
                    </div>
                    <div class="standart-carusel__film-info">
                       <h2 class="standart-carusel__film-name">
                            Биография Булла
                       </h2>
                       <p class="standart-carusel__film-year">
                            2020
                       </p>
                       <div class="bage bage_PRO">
                           <a href="#">
                                PRO
                           </a>   
                       </div>
                </div>

                </div>
                <div class="carusel__item standart-carusel">
                    <div class="standart-carusel__photo">
                        <img src="./images/MEGA.png" alt="">
                    </div>
                    <div class="standart-carusel__film-info">
                       <h2 class="standart-carusel__film-name">
                            Биография Булла
                       </h2>
                       <p class="standart-carusel__film-year">
                            2020
                       </p>
                       <div class="bage">
                           <a href="#">
                                FREE
                           </a>   
                       </div>
                </div>
       
                </div>
                <div class="carusel__item standart-carusel">
                    <div class="standart-carusel__photo">
                        <img src="./images/MEGA.png" alt="">
                    </div>
                    <div class="standart-carusel__film-info">
                       <h2 class="standart-carusel__film-name">
                            Биография Булла
                       </h2>
                       <p class="standart-carusel__film-year">
                            2020
                       </p>
                       <div class="bage">
                           <a href="#">
                                FREE
                           </a>   
                       </div>
                </div>             
            </div>   
        </div>
        </section>
    </main>

    <script>
        document.querySelector('.review__submit').onclick = event =>{

            const modal =   document.querySelector('.review-modal')
            
            modal.classList.add('modal_active')
            modal.querySelector("form").classList.add('form_active', 'forms__enter');
            modal.querySelector("form").style.opacity = '1'
            
          
            
        }
        
    </script>

    <script src="./scripts/header.js"></script>
    <script src="./scripts/videoPlayer.js"></script>
    <script src="./scripts/Input.js"></script>
    <script src="./scripts/forms.js"></script>
    <script src="./scripts/filmShevron.js"></script>
    <script src="./scripts/rating.js"></script>
    <script src="./scripts/slider.js"></script>
    <script src="./scripts/startWatch.js"></script>
</body>
</html>