

const RRDS = document.querySelector('.subscribe__variations > p')
const [span1 , span2 ] = Array.from(RRDS.querySelectorAll('span'))


const SPANVALUES = {
    1: 'movie',
    2: 'music',
}

// subscribe__section-active

document.addEventListener('click', (event) =>{
    if (event.target.classList.contains('subscribe__section')){
        let currentBlock;
       
        event.target.parentNode.querySelectorAll('span').forEach(e => e.classList.remove('subscribe__section-active'))
       
        event.target.classList.add('subscribe__section-active')
        console.log(  event.target.getAttribute('data-id'))

        const res = Array.from(document.querySelectorAll('.subscribe__info')).filter(element => {
            if (+element.getAttribute('data-id') === +event.target.getAttribute('data-id')){
                currentBlock = element
            }
            return !(+element.getAttribute('data-id') === +event.target.getAttribute('data-id'))
        })
        res.map(e => e.classList.add('hidden'))
        currentBlock.classList.remove('hidden')

        
      
    }
})