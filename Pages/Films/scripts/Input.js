const INPUTS = document.querySelectorAll('.main-input')


INPUTS.forEach(element =>{
   
    const label = element.querySelector('p')
    console.warn(label)
    element.querySelector('input').onblur = (e) => {
        console.log(e.currentTarget.value)
        if (e.currentTarget.value !== ''){
            label.classList.add('main-input__label_fixed')
            return
        }
        label.classList.remove('main-input__label_fixed')
    }
})
