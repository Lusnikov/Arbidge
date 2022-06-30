<div class="modal auth__modal">
        <form class="forms  modal__content login-form" action="../server/Enter.php">
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
                        <input name="password"  type="password" class="main-input__input main-input__label-fixed">
                        <p class="main-input__label ">Пароль</p>
                    </label>
                </div>
                <button class="test" style="color: black;" type="submit">
                    Войти
                </button>
                <div class="">
                    <a class="login-form__forgot" href="">Забыли пароль?</a>
                </div>
                <div class="">
                <a class="login-form__toReg " href="../registration.php">К регистрации</a>
                </div>
                
                
              
            </div>
        </form>
      
    </div>