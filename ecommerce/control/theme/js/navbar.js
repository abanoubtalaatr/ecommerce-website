let click_to_show_and_hide = document.getElementById("click_to_show_and_hide"),
    show_and_hide =document.getElementById("show_and_hide");
// this function to show and hide the list of itmes in navbar 
function check(){
    click_to_show_and_hide.onclick = function(){
        if(show_and_hide.style.display ==='none'){
            show_and_hide.style.display ='block';
        }
        else{
            show_and_hide.style.display = 'none';
        }
    };
}
check();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
// this function change the backgruond of li in show and hide id
let changeBackgroundForLi = document.querySelectorAll('.brand #click_to_show_and_hide #show_and_hide li');
function changeBackground(){
    for(let i=0; i<changeBackgroundForLi.length;i++){
        changeBackgroundForLi[i].onmouseover = function(){
            this.style.background = '#eaeae8';
        };
        changeBackgroundForLi[i].onmouseout = function(){
            this.style.background = '#c1bfbf';
        };
    }
}
changeBackground();


