const  filmplayerheader = document.querySelector('.film-player__header')

document.body.addEventListener('click', (e) =>{
    if (e.target.classList.contains('start-watch')){
        filmplayerheader.classList.add('hidden')
    }
})