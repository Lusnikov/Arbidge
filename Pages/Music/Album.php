<?php
    require('../server/Database.php');

    $query = $pdo->prepare("SELECT * FROM Albums WHERE album_id=?");
    $query->execute(array($_GET['id']));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $pdo->prepare("SELECT * FROM musiclist WHERE album_id=?");
    $query->execute(array($_GET['id']));
    $albumMusic = $query->fetchAll(PDO::FETCH_ASSOC);


    $likedSongs = NULL;
    $res = [];
    if ($userObject){
        $query = $pdo->prepare("SELECT * FROM UserMusicLibrary WHERE user_id = ?");
        $query->execute(array($userObject['user_id']));
        $likedSongs = $query->fetchAll(PDO::FETCH_ASSOC);
       
        foreach ($likedSongs as $likedSong){
            array_push($res, $likedSong['music_id']);
        }
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

                    <button class="login-form__open-forms">Войти</button>
                   
                    <a href="../Profile.html" class="header__profile-s">
                        <div class="header__avatar">
                            <img src="../../Images/Avatar.svg" alt="">
                        </div>
                        <div class="header__user-name">
                            Sam Smith
                        </div>
                    </a>
                    
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
        <div class="pleer  ">
            <div class="pleer__wrapper">
                <video class="pleer__video" autoplay muted loop id="myVideo">
                    <source src="../../mainVideo.mp4" type="video/mp4">
                </video>
                <div class="pleer__contenter">
                <div class="pleer__hidden-album hidden">
                    <img src="../../Images/Unknown.jpg" alt="">
                </div>
                <div class="pleer__progress-bar">
                    <div class="pleer__progress-line"></div>
                    <p class="pleer__music-time">3:02</p>
                </div>
                <div class="pleer__content">
                    <div class="pleer__control-panel">
                        <div class="pleer__control-direction">
                            <img src="../../Images/PrevSong.svg" alt="">
                        </div>
                        <label class="pleer_panel-start" for="hace">
                            <input class="hace" type="checkbox" id="hace">
                            <div class="hace-content"></div>
                        </label>
                        <div class="pleer__control-direction">
                            <img src="../../Images/Vector.svg" alt="">
                        </div>
                        
                    </div>
                
                    <div class="pleer__song-info af">
                        <div class="pleer__song-photo">
                            <!-- <img src="../../Images/Unknown.jpg" alt=""> -->
                        </div>
                        <div class="pleer__song-info">
                            <div class="pleer__author-info">
                                <p class="pleer_song-name">Выберите песню</p>
                                <p class="pleer_song-author">
                                   
                                </p>
                            </div>  
                            <label class="pleer_like-btn"  for="abcderf">
                                <input class="hidden" type="checkbox" id="abcderf">
                                <div class="">
                                    
                                </div>
                                
                            </label> 
                            
                            <img src="../../Images/cancel.svg" alt="">
                        </div>
                    
                </div>

                <img class="pleer__open-full-screen" src="../../Images/full-screen_icon-icons.com_64712 1.svg" alt="">
            </div>
                
            </div>
        </div>

        </div>

        <section class="main">
            <div class="Container" style="padding: 10px; margin-bottom: 30px;">
                <h2 class="title">КОНКРЕТНЫЙ АЛЬБРОМ</h2>
            </div>
            <div class="album">

                <div class="album__photo">
                    <img src="./AlbumImages/<?= $result[0]['album_url'] ;?>" alt="">
                </div>
                <div class="album__name">
                    <h2 class="">
                    <?= $result[0]['album_name'] ;?>
                    </h2>
                    <p>
                         <?= $result[0]['album_description'] ;?>
                    </p>
                </div>
                
            </div>
            <div class="songs-list">
                <?php foreach($albumMusic as $music) :?>
                    <div 
                    class="songs-list__song-item" 
                    data-music="./musicFiles/<?= $music['music_url'];?>"
                    data-author="<?= $music['AristName'];?>"
                    data-songName="<?= $music['music_name'];?>"
                    data-album="<?=$result[0]['album_url'];?>"
                    data-songId="2"
                    >
                    
                    <div class="songs-list__song-info">
                        <div class="songs-list__album-photo">
                            <img src="./AlbumImages/<?= $result[0]['album_url'] ;?>" alt="">
                        </div>
                        <button class="songs-list__play">
                            <img src="../../Images/Group.svg" alt="">
                        </button>
                
                        <div class="">
                            <p class="songs-list__song-name">
                                <?= $music['music_name'];?>
                            </p>
                            <p class="songs-list__author-name">
                                <a href="">
                                    <?= $music['AristName'];?>
                                </a>        
                            </p>
                        </div>        
                    </div>
                    <div class="songs-list__last-block">
                       
                        
                    <svg width="35" height="32" viewBox="0 0 35 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.77275 4.01428C9.71294 4.01899 9.51914 4.04019 9.34209 4.06138C5.78913 4.46643 2.87259 7.11099 2.162 10.5703C1.84379 12.1246 2.0017 14.1192 2.57113 15.8053C3.17406 17.5785 4.18611 19.1281 5.91354 20.9202C6.7318 21.7679 7.43043 22.4038 9.71294 24.3819C10.2656 24.8599 10.8805 25.3945 11.0767 25.5711C13.5267 27.7376 15.2278 29.5556 16.6897 31.5691L17.0007 32H17.3165L17.6323 31.9976L17.9434 31.5455C19.276 29.6098 20.8431 27.8718 23.1711 25.7501C23.6281 25.3309 24.1473 24.8717 25.6283 23.5765C27.9156 21.5701 29.0855 20.4139 30.033 19.2199C31.5714 17.2771 32.349 15.445 32.5787 13.2078C32.6241 12.7463 32.6194 11.6418 32.5667 11.2415C32.3155 9.34579 31.5116 7.7162 30.1789 6.40451C28.8463 5.09283 27.1882 4.29923 25.2646 4.05432C24.8028 3.9978 23.798 3.9978 23.3266 4.05432C21.5729 4.27332 20.0273 4.96567 18.7329 6.11251C18.2759 6.51755 17.7615 7.0945 17.4529 7.549C17.3811 7.65497 17.3165 7.7421 17.3093 7.7421C17.3022 7.7421 17.2376 7.65497 17.1658 7.549C16.8571 7.0945 16.3427 6.51755 15.8858 6.11251C14.6153 4.98686 13.0865 4.29216 11.3925 4.0708C11.0432 4.0237 10.0479 3.99073 9.77275 4.01428Z" fill="#9A9A9A"/>
                                <path d="M9.77275 4.01428C9.71294 4.01899 9.51914 4.04019 9.34209 4.06138C5.78913 4.46643 2.87259 7.11099 2.162 10.5703C1.84379 12.1246 2.0017 14.1192 2.57113 15.8053C3.17406 17.5785 4.18611 19.1281 5.91354 20.9202C6.7318 21.7679 7.43043 22.4038 9.71294 24.3819C10.2656 24.8599 10.8805 25.3945 11.0767 25.5711C13.5267 27.7376 15.2278 29.5556 16.6897 31.5691L17.0007 32H17.3165L17.6323 31.9976L17.9434 31.5455C19.276 29.6098 20.8431 27.8718 23.1711 25.7501C23.6281 25.3309 24.1473 24.8717 25.6283 23.5765C27.9156 21.5701 29.0855 20.4139 30.033 19.2199C31.5714 17.2771 32.349 15.445 32.5787 13.2078C32.6241 12.7463 32.6194 11.6418 32.5667 11.2415C32.3155 9.34579 31.5116 7.7162 30.1789 6.40451C28.8463 5.09283 27.1882 4.29923 25.2646 4.05432C24.8028 3.9978 23.798 3.9978 23.3266 4.05432C21.5729 4.27332 20.0273 4.96567 18.7329 6.11251C18.2759 6.51755 17.7615 7.0945 17.4529 7.549C17.3811 7.65497 17.3165 7.7421 17.3093 7.7421C17.3022 7.7421 17.2376 7.65497 17.1658 7.549C16.8571 7.0945 16.3427 6.51755 15.8858 6.11251C14.6153 4.98686 13.0865 4.29216 11.3925 4.0708C11.0432 4.0237 10.0479 3.99073 9.77275 4.01428Z" 
                                fill="<?= SongInLibrary($res, $musicItem['music_id']) ? '#9A9A9A' : 'red';?>"/>
                    </svg>  
                        <img src="../../Images/cancel.svg" alt="">     
                    </div>
                    
                </div>
                <?php endforeach; ?>   
               
            </div>
            
        </section>

      
    </main>

    <script src="./scripts/header.js"></script>
    <script src="./scripts/pleer.js"></script>
    <script src="./scripts/Input.js"></script>
    <script src="./scripts/forms.js"></script>
</body>
</html>