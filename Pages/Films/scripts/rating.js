const stars = Array.from(document.querySelectorAll('.review__star-item'))

let value = 0;
let indexARRAY = {
    fromInd: null,
    toInd: null

}


stars.map((star,index) =>{
    star.addEventListener('click', (event) =>{
        const copy = [...stars]
        indexARRAY.fromInd = index;
        indexARRAY.toInd = stars.length
        value = star.getAttribute('data-value')

        console.log(value)
        document.querySelector('#review-input').value = value
                

                
        stars.map(e => {e.classList.remove('review__star-item_active')})
        copy.splice(index,stars.length).map(elem => elem.classList.add('review__star-item_active'))
    })

    star.addEventListener('mouseover', (event) =>{
        const copy = [...stars]
        copy.splice(0, index).map(elem => elem.classList.remove('review__star-item_active'))
        event.currentTarget
    })
    star.addEventListener('mouseout', (event) =>{
        const copy = [...stars]
       copy.slice( indexARRAY.fromInd,  indexARRAY.toInd).map(e => e.classList.add('review__star-item_active'))
    })

}) 
