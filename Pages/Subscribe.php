<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подписки</title>
    <link rel="stylesheet" href="./Films/styles/main.css">
</head>
<body>
    <header class="header">
        <div class="header__content">
            <div class="header__logo">
                <a href="">
                    <img src="../../Images/Arbidgemusic.png" alt="">
                </a>
            </div>
                <ul class="header__nav">
                    <li class="header__form hidden">
                        <form action="">
                            <div class="header__form-control">
                                <button>
                                    <img src="../../Images/Found.svg" alt="" width="24px">
                                </button>
                                <input name="music-name" class="header__found-input" type="text">
                                <button type="button" class="header__close-found-input">x</button>
                            </div>
                            
                        </form>
                    </li>
                    <li class="header__nav-element"><a class="" href="./Music/Music.html">Музыка</a></li>
                    <li class="header__nav-element" ><a href="./Films/Films.html">Фильмы</a></li>
                      
                </ul>
              
                <div class="header__profile">
                    <button class="header__found">
                        <img src="../../Images/Found.svg" alt="">
                    </button>
                   
                    <a href="" class="header__profile-s">
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

    <main>
        <div class="Container" style="padding: 10px; margin-bottom: 30px;">
            <h2 class="title" style="margin-bottom: 30px">Подписки</h2>     
            <p style="margin-bottom: 30px">На нашем ресурсе существуют различные варианты подписок на разный разделы. Для более выгодной покупки у вас есть возможность выбрать комплексную подписку</p>      
            <h2 class="subscribe-title" style="margin-bottom: 30px">Arbidge</h2>
            <div class="subscribe-list">
                <div class="subscribe-list__item item-subscribe">
                    <div class="item-subscribe__container">
                        <h2 class="item-subscribe__title">FREE</h2>
                        <ul class="item-subscribe__benefits-list">
                            <div class="item-subscribe__wrapper">                      
                                <li> Доступ к бесплатным фильмам</li>
                            </div>
                            
                           
                        </ul>
                        <div class="item-subscribe__footer">
                            <div class="item-subscribe__price-block">
                                <p>Стоимость</p>
                                <p class="item-subscribe__price-field">0 руб/мес</p>
                            </div>
                            <a class="item-subscribe__btn-buy" href="#">Приобрести</a>
                        </div>
                    </div>
                </div>
                <div class="subscribe-list__item item-subscribe">
                    <div class="item-subscribe__container">
                        <h2 class="item-subscribe__title">Подписка Pro</h2>
                        <ul class="item-subscribe__benefits-list">
                            <div class="item-subscribe__wrapper">
                                <li>
                                    Бесплатное прослушивание
                                </li>
                                <li>Доступ к тысячам песен</li>
                                <li> Доступ к сервису movie Доступ к сервису movie Доступ к сервису movie</li>
                            </div>  
                        </ul>
                        <div class="item-subscribe__footer">
                            <div class="item-subscribe__price-block">
                                <p>Стоимость</p>
                                <p class="item-subscribe__price-field">299 руб/мес</p>
                            </div>
                            <a class="item-subscribe__btn-buy" href="./server/subscribe.php?id=2">Приобрести</a>
                        </div>
                    </div>
                </div>
                <div class="subscribe-list__item item-subscribe">
                    <div class="item-subscribe__container">
                    <h2 class="item-subscribe__title">Подписка Elite</h2>
                        <ul class="item-subscribe__benefits-list">
                            <div class="item-subscribe__wrapper">
                                <li>
                                    Бесплатное прослушивание
                                </li>
                                <li>Доступ к тысячам песен</li>
                                <li> Доступ к сервису movie Доступ к сервису movie Доступ к сервису movie</li>
                            </div>
                            
                           
                        </ul>
                        <div class="item-subscribe__footer">
                            <div class="item-subscribe__price-block">
                                <p>Стоимость</p>
                                <p class="item-subscribe__price-field">499 руб/мес</p>
                            </div>
                            <a class="item-subscribe__btn-buy" href="./server/subscribe.php?id=3">Приобрести</a>
                        </div>
                    </div>
                </div>
               
            </div>
            <h2 class="subscribe-title">ArbidgeMovie</h2>
 
            
        </div>
    </main>
    

    <script src="./Music/scripts/header.js"></script>
    <script src="./Music/scripts/Input.js"></script>
    <script src="./scripts/changeSubscribes.js"></script>


</body>
</html>