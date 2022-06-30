<?php
    require('./server/Database.php');

    


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
        <div class="Container">
            <h2 class="title" style="margin-bottom: 40px">Панель администрирования</h2>

            <div class="tips">
                <div class="tip active" >
                    <div class="tip__to-open" data-value="tip-1">
                        Загрузка песен
                    </div>
                   

                </div>
                <div class="tip" >
                    <div class="tip__to-open" data-value="tip-2">
                        Значение 2
                    </div>
                

                </div>    
            </div>

            <div class="content">
                    <form enctype="multipart/form-data" class="content__item" data-value="tip-1" action="./server/addMusic.php" method="post">
                        Загрузка песен       
                        <div class="af">
                            
                             <input name="file" type="file" id="download-music" >
         
                            <label class="download-label" for="download-music">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="white"  width="24" height="24" viewBox="0 0 24 24"><path d="M12 21l-8-9h6v-12h4v12h6l-8 9zm9-1v2h-18v-2h-2v4h22v-4h-2z"/></svg>
                                <span>Загрузить музыку</span>
                            <a href=""></a>
                            </label>
                        </div>
                       
                        <label class="main-input">
                            <input name="name"  type="text" placeholder="Название трека" class="main-input__input main-input__label-fixed">
                         
                        </label>
                        <div class="">
                            <?php
                                $query = $pdo->prepare("SELECT * FROM `Albums` WHERE 1");
                                $query->execute();
                                $ab = $query->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                        <select id="choose-album" name="album">
                            <?php foreach($ab as $item) :?>
                                <option value="<?= $item['album_id'] ;?>"><?= $item['album_name'] ;?></option>
        
                            <?php endforeach; ?>
                            
                        </select>
                        </div>
                        <button style="margin-top: 30px" class="test">Загрузить песню</button>


                    </form>
                
                    <div class="content__item hidden" data-value="tip-2">
                        2222
                    </div>
            </div>
        </div>
    </main>

    <script>
        document.body.addEventListener('click', (e) =>{
            if (e.target.classList.contains('tip__to-open')){
                document.querySelectorAll('.tip').forEach(e =>{
                    e.classList.remove('active')
                })
                e.target.parentNode.classList.add('active')
               let a=
                document.querySelectorAll(`.content__item[data-value]`).forEach(el =>{
                    if (e.target.getAttribute('data-value') === el.getAttribute('data-value')){
                        console.log(el)
                        document.querySelectorAll('.content__item').forEach(element =>{
                            element.classList.add('hidden')
                        })
                        el.classList.remove('hidden')
                        
                       return
                    }
                })
                
            }
        })
    </script>

    <style>
        #choose-album{
            margin-top: 30px;
            display: inline-block;
            width: 30%;
        }
        .af{
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .content{
            padding: 20px;
            background: gray;
            max-width: 800px;
            margin: 0 auto;
        }

        #download-music{
            display: none;
        }
        .download-label{
            display: flex;
            align-items: center;
            cursor: pointer;
        }

         .download-label svg{
             margin-right: 10px;
         }
         .download-label svg::after{
             content: "1";
             display: block;
             width: 100px;
             height: 100px;
             background: red;
         }
        .Container{
            overflow: hidden;
        }
        .tips{
            overflow: scroll;
            display: flex;
            padding: 30px 20px;

        }

        .tip{
            display: inline-block;
            cursor: pointer;
            min-width: 100px;
            margin-right: 20px;
        }

        .tip.active{
            color: red
        }
    </style>
   
    <script src="./Music/scripts/Input.js"></script>
    <script src="./scripts/changeSubscribes.js"></script>

    <script src="./Music/scripts/header.js"></script>

  


</body>
</html>