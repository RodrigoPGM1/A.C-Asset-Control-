const container=document.querySelector('.conteiner');
const iniciarlink=document.querySelector('.Iniciarlink');
const registratelink=document.querySelector('.registrarse');
registratelink.addEventListener('click',()=>{
    container.classList.add('active');
})
iniciarlink.addEventListener('click',()=>{
    container.classList.remove('active');
})