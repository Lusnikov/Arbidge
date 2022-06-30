const video = document.querySelector('video')
const inputRange = document.querySelector('.input-range')
inputRange.value = 0;
const VIDEOPLAYER = document.querySelector('.film-player')




let TIMEINPUT = document.querySelector('.TIMEINPUT')

const togglebtn = document.querySelector('.film-player__toggle-Video')

const stopSVG = `
    <path d="M16.6775 55.9999H5.80509C3.15132 55.9999 1 53.8777 1 51.2598V5.78457C1 3.16666 3.15132 1.04443 5.80509 1.04443H16.6775C19.3313 1.04443 21.4826 3.16666 21.4826 5.78457V51.2598C21.4826 53.8777 19.3313 55.9999 16.6775 55.9999Z" fill="black"/>
    <path d="M51.1949 55.9555H40.3224C37.6686 55.9555 35.5173 53.8332 35.5173 51.2153V5.74014C35.5173 3.12223 37.6686 1 40.3224 1H51.1949C53.8486 1 56 3.12223 56 5.74014V51.2153C56 53.8332 53.8486 55.9555 51.1949 55.9555Z" fill="black"/>
    <path d="M17.5107 1.12744C18.4485 1.99246 19.0437 3.21479 19.0437 4.58148V50.0567C19.0437 52.6746 16.8924 54.7968 14.2386 54.7968H3.36617C3.08079 54.7968 2.80517 54.7607 2.5332 54.7138C3.39178 55.5054 4.53695 55.9999 5.8053 55.9999H16.6777C19.3315 55.9999 21.4828 53.8777 21.4828 51.2598V5.78456C21.4828 3.44818 19.7657 1.51844 17.5107 1.12744Z" fill="black"/>
    <path d="M52.028 1.08301C52.9659 1.94802 53.561 3.17035 53.561 4.53705V50.0123C53.561 52.6302 51.4097 54.7524 48.7559 54.7524H37.8835C37.5981 54.7524 37.3225 54.7163 37.0505 54.6694C37.9091 55.461 39.0543 55.9555 40.3226 55.9555H51.1951C53.8488 55.9555 56.0002 53.8332 56.0002 51.2153V5.74013C56.0002 3.40375 54.283 1.47281 52.028 1.08301Z" fill="black"/>
    <path d="M16.6775 55.9999H5.80509C3.15132 55.9999 1 53.8777 1 51.2598V5.78457C1 3.16666 3.15132 1.04443 5.80509 1.04443H16.6775C19.3313 1.04443 21.4826 3.16666 21.4826 5.78457V51.2598C21.4826 53.8777 19.3313 55.9999 16.6775 55.9999Z" stroke="black" stroke-miterlimit="10"/>
    <path d="M51.1949 55.9555H40.3224C37.6686 55.9555 35.5173 53.8332 35.5173 51.2153V5.74014C35.5173 3.12223 37.6686 1 40.3224 1H51.1949C53.8486 1 56 3.12223 56 5.74014V51.2153C56 53.8332 53.8486 55.9555 51.1949 55.9555Z" stroke="black" stroke-miterlimit="10"/> 
    `
const playSVG=`
<path d="M27.9714 0C12.5118 0 0 12.4942 0 27.9353C0 43.3751 12.5101 55.8707 27.9714 55.8707C43.431 55.8707 55.9427 43.3765 55.9427 27.9353C55.9427 12.4956 43.4324 0 27.9714 0ZM38.0496 31.0364L24.9059 38.6212C23.7971 39.261 22.4299 39.2621 21.3192 38.6221C20.2093 37.9825 19.5256 36.7999 19.5256 35.5202V20.3506C19.5256 19.0708 20.2094 17.8883 21.3192 17.2487C21.8738 16.9289 22.4928 16.7691 23.1118 16.7691C23.7313 16.7691 24.3509 16.9293 24.9059 17.2494L38.0497 24.8342C39.1586 25.4741 39.8416 26.6561 39.8416 27.9352C39.8416 29.2145 39.1585 30.3964 38.0496 31.0364Z" 
fill=""/>
`

let intervall;

inputRange.addEventListener('mousedown', () =>{
    clearInterval(intervall)
    // video.pause()
})

inputRange.addEventListener('mouseup', (e) =>{
   const  beginstatus = video.paused

    clearInterval(intervall)
    
    video.currentTime= video.duration/100*e.target.value;    
    startVIDEO()
})
   





function startVIDEO(){
    video.play()
    intervall = setInterval(() => {
        setProgress() 
        console.error(video.currentTime)
    }, 300);
    
    togglebtn.querySelector('svg').innerHTML=stopSVG
}


togglebtn.onclick = (event) =>{
    if (video.paused){
        startVIDEO()
        return
    }
    togglebtn.querySelector('svg').innerHTML=playSVG
    video.pause()
    clearInterval(intervall)
  
}

function setProgress(){

    inputRange.value = video.currentTime/video.duration*100;
    // console.log(toDateTime()
   
    TIMEINPUT.innerHTML = toDateTime(video.currentTime).split(' ')[4]
}


function toDateTime(secs) {
    var t = new Date(1970, 0, 1); // Epoch
    return String(t);
}

console.error(toDateTime(300))


document.querySelector('.full-width-btn').onclick = (event) =>{
    VIDEOPLAYER.classList.toggle('film-player_full')
}
