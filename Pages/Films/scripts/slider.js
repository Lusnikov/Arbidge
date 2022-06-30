const SLIDERS = document.querySelectorAll('.carusel');

SLIDERS.forEach(slider =>{
    let currentPosition = 0;
    const slidesItems = Array.from(slider.querySelectorAll('.carusel__item'))
    const lengthItems = slidesItems.length
    const slideArea = slider.querySelector('.carusel__scroll')

    


    const slidePrev = slider.querySelector('.carusel__slide-btn_left')
    const slideNext = slider.querySelector('.carusel__slide-btn_right')


    // slideArea.style.transform = 'translateX(-33%)'
   
    const handlerSlidePrev = (e) =>{
            slideNext.removeAttribute('disabled')
            currentPosition += 1;
            if (currentPosition == lengthItems-2){
                e.currentTarget.setAttribute('disabled','')
            }
        slideArea.style.transform = `translateX(-${move*currentPosition}%)` 
    }

    const handlerSlideNext = (e) =>{
        slidePrev.removeAttribute('disabled')
        currentPosition -= 1;
            if (currentPosition == 0){
                e.currentTarget.setAttribute('disabled','')
            }
        slideArea.style.transform = `translateX(-${move*currentPosition}%)` 

    }

    slidePrev.onclick = handlerSlidePrev
    slideNext.onclick = handlerSlideNext
    // console.log(slidesItems[1].getBoundingClientRect)
   
   
    const nextBlockPosition = slidesItems[1].getBoundingClientRect().left
    
    slideArea.style.width = slidesItems[1].getBoundingClientRect().left*lengthItems+'px'

    console.error(slideArea)
   
    if (+(slidesItems[1].getBoundingClientRect().left*lengthItems) <= document.body.offsetWidth){
        console.warn()
        slidePrev.classList.add('hidden')
        slideNext.classList.add('hidden')
    }


    // console.error(slidesItems[1].offsetWidth)
    // console.log(slidesItems[0])
    console.error(slideArea.getBoundingClientRect())
    console.warn( slidesItems[1].getBoundingClientRect())
    const resultSlideCount = nextBlockPosition;
    const move = resultSlideCount/(slidesItems[1].getBoundingClientRect().left*lengthItems) * 100;
   
 
 
    // console.error( slidesItems[0].getBoundingClientRect())
    // console.warn( slidesItems[1].getBoundingClientRect()
    
})


