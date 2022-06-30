const about = document.querySelector('.about')

const aboutParagraphs = Array.from(about.querySelectorAll('p'))
const aboutToggle = about.querySelector('.about__toggle')
const blockToShow = aboutParagraphs.filter(e => e.classList.contains('hidden'))

aboutToggle.addEventListener('click', event =>{
    event.currentTarget.classList.toggle('expand_collapse')
    if (event.currentTarget.textContent === 'Развернуть'){
        blockToShow.forEach(e => e.classList.remove('hidden'))
        event.currentTarget.textContent = 'Свернуть'
        return;
    }
    blockToShow.forEach(e => e.classList.add('hidden'))
    event.currentTarget.textContent = 'Развернуть'
})

