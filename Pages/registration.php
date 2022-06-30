<?php
  
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href="./Music/styles/main.css">
    <link rel="stylesheet" href="./styles/form.css">
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
                                    <img src="../../Images/Found.svg" alt="" width="24">
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
        <form class="form" action="./server/registerNewProfile.php">
            <h2 style="text-align:center; margin-bottom: 30px;">Форма регистрации</h2>

            <label class="main-input">
                <input name="login"  type="text" class="main-input__input main-input__label-fixed" placeholder="Login">             
            </label>
            <label class="main-input">
                <input name="password"  type="password" class="main-input__input main-input__label-fixed" placeholder="Password">             
            </label>
            <label class="main-input">
                <input name="FIO"  type="text" class="main-input__input main-input__label-fixed" placeholder="Fio">             
            </label>
            <label class="main-input" >
                <input name="email"  type="Email" class="main-input__input main-input__label-fixed" placeholder="email">             
            </label>
            <label class="main-input">
                <input name="Phone" id="phone"  type="text" class="main-input__input main-input__label-fixed" placeholder="phone">             
            </label>
            <label class="main-input" >
                <input name="date" id="date-mask"  type="text" class="main-input__input main-input__label-fixed" placeholder="birthday">             
            </label>

            <button type="submit" class="test">Зарегестрироваться</button>
        </form>
    </main>
    <script src="./Music/scripts/header.js"></script>
    <script src="./Music/scripts/Input.js"></script>
    <script src="./scripts/changeSubscribes.js"></script>
    <script src="https://unpkg.com/imask"></script>

    <script>
        var element = document.getElementById('phone');
        var maskOptions = {
        mask: '+{7}(000)000-00-00'
        };
        var mask = IMask(element, maskOptions);

        var dateMask = IMask(
        document.getElementById('date-mask'),
        {
            mask: Date,
            min: new Date(1950, 0, 1),
            max: new Date(2020, 0, 1),
            lazy: false
        });

    </script>



</body>
</html>