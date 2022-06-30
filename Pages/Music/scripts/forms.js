const openFormBTN = document.querySelector('.login-form__open-forms')


const AUTHmodal = document.querySelector('.auth__modal')
const loginForm = document.querySelector('.login-form')
const registrationForm = document.querySelector('.registration-form')



if (openFormBTN){
    openFormBTN.addEventListener('click', () =>{
        AUTHmodal.classList.add('modal_active');
        loginForm.classList.add('forms_active')
        
        setTimeout(() =>{
            loginForm.classList.add('forms__enter')
        }, 10)
    })
}


AUTHmodal.addEventListener('click', event =>{
    if (event.currentTarget === event.target){
        closeModal()
    }
})

function closeModal() {
    AUTHmodal.classList.remove('modal_active')

    // очищаем формы
    const forms = Array.from( AUTHmodal.querySelectorAll('.forms'))
    
    for (form of forms){
        form.classList.remove('forms_active')
        form.classList.remove('forms__enter')
        form.classList.remove('forms__exit')
    }
    
}