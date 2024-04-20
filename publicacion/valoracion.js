const estrellas = document.querySelectorAll('.bi-star-fill');

estrellas.forEach(function(estrella,index) {
    estrella.addEventListener('click',function(){
        for(let i =0; i<=index; i++){
            estrellas[i].classList.add('checado');
            estrellas[i].classList.remove('estrella');
        }
        for(let i=index+1; i<=estrellas.length; i++){
            estrellas[i].classList.remove('checado');
            estrellas[i].classList.remove('estrella');
        }
    })
});