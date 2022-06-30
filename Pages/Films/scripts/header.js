const FounderMain = document.querySelector('.header__found')

const HiddenHeaderForm = document.querySelector('.header__form')

console.warn(FounderMain)


FounderMain.addEventListener('click', () =>{
    HiddenHeaderForm.classList.remove('hidden')
    FounderMain.classList.add('hidden')

    document.querySelectorAll('.header__nav-element').forEach((elem) =>{
        console.warn(elem)
        elem.classList.add('hidden')
    })
})


document.querySelector('.header__close-found-input').addEventListener('click',() =>{
    HiddenHeaderForm.classList.add('hidden')

    document.querySelectorAll('.header__nav-element').forEach((elem) =>{
        console.warn(elem)
        elem.classList.remove('hidden')
    })
    FounderMain.classList.remove('hidden')
})
