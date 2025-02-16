window.addEventListener('scroll',reveal);

function reveal(){
    let reveals = document.querySelectorAll('.reveals');

    for(let i=0;i<reveals.length;i++){
        let windowsHeight = window.innerHeight;
        let revealtop= reveals[i].getBoundingClientRect().top;
        if(revealtop <windowsHeight-150) reveals[i].classList.add('active');  
        else reveals[i].classList.remove('active');  

}
}


