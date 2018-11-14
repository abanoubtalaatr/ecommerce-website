// this function to hide place holder when you focus on the input field
let holdInput = document.getElementsByClassName('hide');
let date ='';
function hidePlaceholder(){
    for(let i =0 ; i<holdInput.length; i++){
        
        holdInput[i].onfocus =function(){
            date = this.placeholder;
            this.placeholder = '';
        };
        holdInput[i].onblur = function(){
            this.setAttribute('placeholder',date);
        };
    }
   
}
hidePlaceholder();
// This belong page item to make customer customer select
let contain_value_of_select  = document.getElementById('contain_value_of_select'),
    click_to_show_select_div = document.getElementById('click_to_show_select_div'),
    select                   = document.getElementById("select"),
    The_lis_in_select_class = document.querySelectorAll(".select ul li");
  

if(contain_value_of_select.innerHTML == "....."){
   contain_value_of_select.style.textAlign = 'star';
   contain_value_of_select.style.marginTop = '-23px';
   contain_value_of_select.style.fontSize = '37px';
   console.log('yes');
}
function check_if_select_block_or_none(){
    select.style.display = "none";
   click_to_show_select_div.onclick = function (){
    if(select.style.display =="none"){
        select.style.display = 'block';
    }else{
        select.style.display = 'none';
    }
   };
}

check_if_select_block_or_none();
let value = "";
function to_put_background_to_lis_in_select_class (){
    for(let i = 0 ; i < The_lis_in_select_class.length ; i++){
        The_lis_in_select_class[i].onmouseover = function (){
         The_lis_in_select_class[i].style.background ="#d8d7de";
        };
        The_lis_in_select_class[i].onmouseout= function(){
            The_lis_in_select_class[i].style.background = "#305063";
        };
    }
}
to_put_background_to_lis_in_select_class();
function to_get_value(){//to get value from li select and put it in conatain value id 
    for(let i = 0 ; i < The_lis_in_select_class.length ;i++){
        The_lis_in_select_class[i].onclick = function (){
            value = The_lis_in_select_class[i].value;
            contain_value_of_select.innerHTML = The_lis_in_select_class[i].innerHTML;
            select.style.display = 'none';
        };
    }
}
to_get_value();
