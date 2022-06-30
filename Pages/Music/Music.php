<?php
    require('../server/Database.php');

    $query = $pdo->prepare("SELECT * FROM musiclist");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $pdo->prepare(
        "SELECT * FROM `Albums` WHERE 1
        ORDER BY `Listens` DESC 
        LIMIT 6 ");
    $query->execute();
    $albums = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $likedSongs = NULL;
    if ($userObject){
        $query = $pdo->prepare("SELECT * FROM UserMusicLibrary WHERE user_id = ?");
        $query->execute(array($userObject['user_id']));
        $likedSongs = $query->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
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
                <h2 class="title">Главное</h2>
            </div>
            <div class="album-list">
                <div class="Container album-list__container"> 
                    <?php foreach($albums as $album) :?>
                        <div class="album-list__album-item" >
                        <div class="album-list__album-info">
                            <div class="album-list__album-name">
                                <?= $album['album_name'] ;?>
                            </div>
                            <div class="album-list__album-author">
                                <?php
                                    $query = $pdo->prepare("SELECT * FROM Albums WHERE album_id=?");
                                    $query->execute(array($album['album_id']));
                                    $e = $query->fetchAll(PDO::FETCH_ASSOC);

                                    $query = $pdo->prepare("SELECT * FROM musiclist WHERE album_id=?");
                                    $query->execute(array($album['album_id']));
                                    $artistName = $query->fetchAll(PDO::FETCH_ASSOC);
                                    
                                  
                                ?>
                                Insert
                            </div>       
                            <div class="album-list__btn-wrapper">
                                <a class="album-list__listen-btn" href="./Album.php?id=<?= $album['album_id'];?>">
                                    <svg width="32" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.9714 0C12.5118 0 0 12.4942 0 27.9353C0 43.3751 12.5101 55.8707 27.9714 55.8707C43.431 55.8707 55.9427 
                                        43.3765 55.9427 27.9353C55.9427 12.4956 43.4324 0 27.9714 0ZM38.0496 31.0364L24.9059 38.6212C23.7971 39.261 22.4299 39.2621 
                                        21.3192 38.6221C20.2093 37.9825 19.5256 36.7999 19.5256 35.5202V20.3506C19.5256 19.0708 20.2094 17.8883 21.3192 
                                        17.2487C21.8738 16.9289 22.4928 16.7691 23.1118 16.7691C23.7313 16.7691 24.3509 16.9293 24.9059 17.2494L38.0497 24.8342C39.1586 25.4741 39.8416 26.6561 39.8416 27.9352C39.8416 29.2145 39.1585 30.3964 38.0496 31.0364Z" 
                                        />
                                    </svg>
                                    Слушать
                                </a>
                            </div>
                                
                        </div>
                        <img src="./AlbumImages/<?= $e[0]['album_url'];?>" alt="">
                    </div>
                    <?php endforeach; ?>
                    
                
                
                    
                
                </div>
            </div>
            
        </section>

        <section class="popular">
            <div class="Container" style="padding: 10px; margin-bottom: 30px;">
                <h2 class="title">Популярные песни</h2>
            </div>

            <div class="songs-list">
                <?php foreach($result as $musicItem) :?>
                    <div 
                    class="songs-list__song-item" 
                    data-music="./musicFiles/<?= $musicItem['music_url'] ;?>"
                    data-author=" <?= $musicItem['AristName'] ;?>"
                    data-songName=" <?=  $musicItem['music_name'] ;?>"
                    data-songId=" <?=  $musicItem['music_id'] ;?>"
                    >
                    
                    <div class="songs-list__song-info">
                        <div class="songs-list__album-photo">
                            <?php
                                  $query = $pdo->prepare("SELECT album_url FROM `Albums` WHERE album_id=?");
                                  $query->execute(array($musicItem['album_id']));
                                  $tr = $query->fetchAll(PDO::FETCH_ASSOC)[0];
                                
                            ?>
                            <img src="./AlbumImages/<?=  $tr['album_url'];?>" alt="">
                        </div>
                        <button class="songs-list__play">
                            <img src="../../Images/Group.svg" alt="">
                        </button>
                      
                        <div class="">
                            <p class="songs-list__song-name">
                                <?=  $musicItem['music_name'] ;?>
                            </p>
                            <p class="songs-list__author-name">
                                <a href="">
                                  <?= $musicItem['AristName'] ;?>
                                </a>        
                            </p>
                        </div>        
                    </div>
                    <div class="songs-list__last-block">
                        <a href="../server/addToLike.php?id=<?=  $musicItem['music_id'];?>">
                            <svg width="35" height="32" viewBox="0 0 35 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.77275 4.01428C9.71294 4.01899 9.51914 4.04019 9.34209 4.06138C5.78913 4.46643 2.87259 7.11099 2.162 10.5703C1.84379 12.1246 2.0017 14.1192 2.57113 15.8053C3.17406 17.5785 4.18611 19.1281 5.91354 20.9202C6.7318 21.7679 7.43043 22.4038 9.71294 24.3819C10.2656 24.8599 10.8805 25.3945 11.0767 25.5711C13.5267 27.7376 15.2278 29.5556 16.6897 31.5691L17.0007 32H17.3165L17.6323 31.9976L17.9434 31.5455C19.276 29.6098 20.8431 27.8718 23.1711 25.7501C23.6281 25.3309 24.1473 24.8717 25.6283 23.5765C27.9156 21.5701 29.0855 20.4139 30.033 19.2199C31.5714 17.2771 32.349 15.445 32.5787 13.2078C32.6241 12.7463 32.6194 11.6418 32.5667 11.2415C32.3155 9.34579 31.5116 7.7162 30.1789 6.40451C28.8463 5.09283 27.1882 4.29923 25.2646 4.05432C24.8028 3.9978 23.798 3.9978 23.3266 4.05432C21.5729 4.27332 20.0273 4.96567 18.7329 6.11251C18.2759 6.51755 17.7615 7.0945 17.4529 7.549C17.3811 7.65497 17.3165 7.7421 17.3093 7.7421C17.3022 7.7421 17.2376 7.65497 17.1658 7.549C16.8571 7.0945 16.3427 6.51755 15.8858 6.11251C14.6153 4.98686 13.0865 4.29216 11.3925 4.0708C11.0432 4.0237 10.0479 3.99073 9.77275 4.01428Z" fill="#9A9A9A"/>
                                <path d="M9.77275 4.01428C9.71294 4.01899 9.51914 4.04019 9.34209 4.06138C5.78913 4.46643 2.87259 7.11099 2.162 10.5703C1.84379 12.1246 2.0017 14.1192 2.57113 15.8053C3.17406 17.5785 4.18611 19.1281 5.91354 20.9202C6.7318 21.7679 7.43043 22.4038 9.71294 24.3819C10.2656 24.8599 10.8805 25.3945 11.0767 25.5711C13.5267 27.7376 15.2278 29.5556 16.6897 31.5691L17.0007 32H17.3165L17.6323 31.9976L17.9434 31.5455C19.276 29.6098 20.8431 27.8718 23.1711 25.7501C23.6281 25.3309 24.1473 24.8717 25.6283 23.5765C27.9156 21.5701 29.0855 20.4139 30.033 19.2199C31.5714 17.2771 32.349 15.445 32.5787 13.2078C32.6241 12.7463 32.6194 11.6418 32.5667 11.2415C32.3155 9.34579 31.5116 7.7162 30.1789 6.40451C28.8463 5.09283 27.1882 4.29923 25.2646 4.05432C24.8028 3.9978 23.798 3.9978 23.3266 4.05432C21.5729 4.27332 20.0273 4.96567 18.7329 6.11251C18.2759 6.51755 17.7615 7.0945 17.4529 7.549C17.3811 7.65497 17.3165 7.7421 17.3093 7.7421C17.3022 7.7421 17.2376 7.65497 17.1658 7.549C16.8571 7.0945 16.3427 6.51755 15.8858 6.11251C14.6153 4.98686 13.0865 4.29216 11.3925 4.0708C11.0432 4.0237 10.0479 3.99073 9.77275 4.01428Z" 
                                fill="<?= SongInLibrary($res, $musicItem['music_id']) ? 'red' : '#9A9A9A';?>"/>
                            </svg>  
                        </a>
                       
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