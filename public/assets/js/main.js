const searchBtn = document.getElementById('searchBtn');
const searchContent = document.getElementById('searchContent');
if(searchBtn){
searchBtn.addEventListener("click",function(){
    searchContent.classList.toggle('d-none');
})
}
const filterClose = document.getElementById('filterClose');
const filterOpen = document.getElementById('filterOpen');
const aside = document.getElementById("aside")
if(filterOpen){
filterOpen.addEventListener("click",function(){
    aside.classList.add('visible');
})
filterClose.addEventListener("click",function(){
    aside.classList.remove('visible');
})
}

const controlNum = document.querySelectorAll(".quantity-control")

controlNum.forEach(function(item){
    const add= item.querySelector('.quantity-increment');
    const sub= item.querySelector('.quantity-reduce');
    var num=item.querySelector('.quantity-num ')

    add.addEventListener("click",function(){
        if(parseInt(num.value) < 100){
        num.value = parseInt(num.value)+1;
    }})
    sub.addEventListener("click",function(){
        if(parseInt(num.value) > 1){
        num.value = parseInt(num.value) - 1;
    }}) 
})
    



