const openFullPleerBtn = document.querySelector('.pleer__open-full-screen')
const PLEER = document.querySelector('.pleer')

const ALL =  Array.from(document.querySelectorAll('.songs-list__song-item'))
console.error(ALL)


const FULLpleerImg =   document.querySelector('.pleer__hidden-album').querySelector('img');
console.log(FULLpleerImg)



const PLEER_WRAPPER = document.querySelector('.pleer__wrapper')

let MUSICTIME = document.querySelector('.pleer__music-time')
let CURRENTindex;

const progressBar = document.querySelector('.pleer__progress-line')

let inter;

function findObject(id){

    for (i of playlistObj){
        if (i.id == id){
           
            return i
        }
    }
}




const checkbox = PLEER.querySelector('.hace')

checkbox.onchange = event =>{
    console.log(event.currentTarget.checked)
    if (event.currentTarget.checked){
        TESTAUDIO.play()
    } else{
        pause()
        document.querySelectorAll('.songs-list__play > img').forEach(e =>{
            console.log(e.setAttribute('src', stopBtn))
        })
        
    }
}





const duration = 130;



// СКРЫТАЯ ФОТОГРАФИЯ
const hiddenAlbumPhoto  = document.querySelector('.pleer__hidden-album')

// ПОЛУЧАЕМ ВСЕ ОБЪЕКТЫ ПЕСЕН СО СТРАНИЦЫ

const pauseBtn = '../../Images/Layer_7_copy.svg'
const stopBtn = '../../Images/Group.svg';

let isPlay = false;
let TESTAUDIO  = new Audio();

let lastTarger = null;

checkbox.onChange = (e) =>{
    console.log(e.currentTarget.value())
    
}

function pause(){
    TESTAUDIO.pause();
 
}

let playlistObj = Array.from(document.querySelectorAll('[data-music]')).map((element, index) =>{ 
   const obj ={
        id: index,
        url: element.getAttribute('data-music'),
        authorName: element.getAttribute('data-author'),
        songName: element.getAttribute('data-songName') ,
        songId: element.getAttribute('data-songId'),
    }
    const {url,authorName, songName, id} = obj

    // console.warn(element.querySelector('.songs-list__play'))
    element.querySelector('.songs-list__play').addEventListener('click', (event) =>{
        CURRENTindex = id;
        console.log(ALL[CURRENTindex].getAttribute('data-music'))
        FULLpleerImg.setAttribute('src', `./AlbumImages/${ALL[CURRENTindex].getAttribute('data-album')}`)

 
      const pauseBTN = event.currentTarget.querySelector('img')
        
  
        const startBtnWasClicked = event.target.parentNode.classList.contains('songs-list__play')
        pause()
        if (startBtnWasClicked){
            if (event.target.getAttribute('src') === pauseBtn ){
                event.target.setAttribute('src', stopBtn)
                checkbox.removeAttribute('checked')
    
                
                return
            }
            
           
            checkbox.setAttribute('checked', '')
            
            // СБРОС ЗАПУЩЕННЫХ аудио
            document.querySelectorAll('.songs-list__song-item').forEach(e =>{
                const block = e.querySelector('.songs-list__play')
                block.querySelector('img').setAttribute('src', stopBtn)
              
            })
            
            if (lastTarger ===  event.target.parentNode){
                console.log('PLAY')
                checkbox.setAttribute('checked' , '')
                TESTAUDIO.play()
                
             
            } else{
                clearInterval(inter)
                TESTAUDIO = new Audio(url)
                TESTAUDIO.play()
                inter = setInterval(() =>{
                   
                    let  {duration, currentTime} = TESTAUDIO
                    duration = Math.round(duration);
                    const songNameDiv = PLEER.querySelector('.pleer_song-name')
                    const AuthorDiv = PLEER.querySelector('.pleer_song-author')

                    songNameDiv.innerHTML= songName
                    AuthorDiv.innerHTML = authorName

                    const percent = TESTAUDIO.currentTime/TESTAUDIO.duration*100;
                   
                    const result =  `${Math.trunc(+currentTime/60)}:${(+currentTime%60 < 10) ? '0'+Math.round(currentTime%60 ): +Math.round(currentTime%60 )}`;
                    progressBar.style.width = `${percent}%`;
                    MUSICTIME.innerHTML = result;

                    if (currentTime > duration-1){
                        clearInterval(inter)
                        setTimeout(() => {
                            nextSong()
                            pauseBTN.setAttribute('src', stopBtn)
                            console.warn(CURRENTindex)

                            console.warn(ALL[CURRENTindex].querySelector('button').querySelector('img').setAttribute('src', pauseBtn))
                            
                        }, 1000);
                        
                    }

                  
                }, 300)
                

                console.log()
                // console.log(element.)
                lastTarger = event.target.parentNode
            }

            
           
            console.log('СТАРТ')
            event.target.setAttribute('src', pauseBtn)

        }
     
        // if (event.target.cla)

    })

    return {
        id: index,
        url: element.getAttribute('data-music'),
        authorName: element.getAttribute('data-author'),
        songName: element.getAttribute('data-songName') ,
        songId: element.getAttribute('data-songId'),
    }
})

console.error(playlistObj)





function block_body(){
    document.body.style.width = '100%';
    document.body.style.height = '100vh';
    document.body.style.overflow = 'hidden'
}

function unblock_body(){

    // document.body.style.height = 'auto';
    document.body.style.overflow = 'initial'
}


openFullPleerBtn.addEventListener('click', () =>{
    PLEER.classList.add('pleer__full')
    hiddenAlbumPhoto.classList.remove('hidden')
    block_body()
   
    
})


PLEER_WRAPPER.addEventListener('click', (e) =>{
    if (e.currentTarget === e.target || e.target.classList.contains('pleer__video')){
        PLEER.classList.remove('pleer__full')
        hiddenAlbumPhoto.classList.add('hidden')
        unblock_body()
       
    }
})

const [leftBtn, rightBtn] = document.querySelectorAll('.pleer__control-direction')

leftBtn.onclick = (event) =>{
    console.warn(findObject(1))
   if (CURRENTindex !== undefined){
       console.table(playlistObj)

       clearInterval(inter)
        TESTAUDIO.pause()
        if (+CURRENTindex-1 === -1){
            CURRENTindex = playlistObj.length-1
            console.log(CURRENTindex)
        } else{
            CURRENTindex -= 1;
            console.log(CURRENTindex)
        }
        const {url,authorName, songName, id, songId} = findObject(CURRENTindex)
        
        TESTAUDIO = new Audio(url)

        TESTAUDIO.play()
        const songNameDiv = PLEER.querySelector('.pleer_song-name')
        const AuthorDiv = PLEER.querySelector('.pleer_song-author')

        songNameDiv.innerHTML= songName
        AuthorDiv.innerHTML = authorName
        inter = setInterval(() =>{
                   
            let  {duration, currentTime} = TESTAUDIO
            duration = Math.round(duration);
            const percent = TESTAUDIO.currentTime/TESTAUDIO.duration*100;
           
            const result =  `${Math.trunc(+currentTime/60)}:${(+currentTime%60 < 10) ? '0'+Math.round(currentTime%60 ): +Math.round(currentTime%60 )}`;
            progressBar.style.width = `${percent}%`;
            MUSICTIME.innerHTML = result;

            if (currentTime == duration){
                alert()
                // nextSong()
            }
            

        }, 300)
      
   }



}

function nextSong(){
    if (CURRENTindex !== undefined){
        clearInterval(inter)
         TESTAUDIO.pause()
         if (+CURRENTindex+1 === playlistObj.length){
            CURRENTindex = 0
             console.log(CURRENTindex)
         } else{
             CURRENTindex += 1;
             console.log(CURRENTindex)
         }
         const {url,authorName, songName, id} = findObject(CURRENTindex)
         TESTAUDIO = new Audio(url)
         TESTAUDIO.play()
         const songNameDiv = PLEER.querySelector('.pleer_song-name')
         const AuthorDiv = PLEER.querySelector('.pleer_song-author')
 
         songNameDiv.innerHTML= songName
         AuthorDiv.innerHTML = authorName
         inter = setInterval(() =>{
                    
             let  {duration, currentTime} = TESTAUDIO
             duration = Math.round(duration);
        
 
             const percent = TESTAUDIO.currentTime/TESTAUDIO.duration*100;
            
             const result =  `${Math.trunc(+currentTime/60)}:${(+currentTime%60 < 10) ? '0'+Math.round(currentTime%60 ): +Math.round(currentTime%60 )}`;
             progressBar.style.width = `${percent}%`;
             MUSICTIME.innerHTML = result;
 
             if (currentTime > duration-1){
                TESTAUDIO.pause();
                nextSong()
                 
             }
 
         }, 300)
       
    }
}

rightBtn.onclick = (event) =>{
  
    nextSong()
 
 
 }


