document.addEventListener('DOMContentLoaded',() => {
    const btnVaciar = document.querySelector('a[href*="accion=vaciar"]');
    if(btnVaciar){
        btnVaciar.addEventListener('click',(e)=>{
            if(!confirm('¿Estas seguro de vaciar todo el carrode compras?')){
                e.preventDefault();
            }
        });
    }
    const cards = document.querySelectorAll(".product-card");
    cards.forEach(card =>{
        card.addEventListener('mouseenter',()=>{
            card.lastElementChild.borderColor ='var(--secondary-color)';
        });
        card.addEventListener('mouseleave',()=>{
            card.style. borderColor = 'transparent';
        });
    });
});