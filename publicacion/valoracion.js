const estrellas = document.querySelectorAll('.estrella');

estrellas.forEach(function(estrella,index) {
    estrella.addEventListener('click',function(){
        for(let i =0; i<=index; i++){
            estrellas[i].classList.add('checado');
        }
        for(let i=index+1; i<=estrellas.length; i++){
            estrellas[i].classList.remove('checado');
        }
    })
});