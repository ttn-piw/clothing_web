const plus = document.querySelectorAll('.plus_pro')
const minus = document.querySelectorAll('.minus_pro');
const quantity = document.querySelectorAll('.quantity');
const pro_money = document.querySelectorAll('.product_money');


minus.forEach(function(button){
    button.addEventListener('click', () =>{
        //Lay vi tri cua nut button tuong ung
        var index = button.value;
        const cost = parseInt(pro_money[index].innerHTML);
        // console.log(pro_money[index].innerHTML);
        if (quantity[index].value < 1) {
            quantity[index] = 0; 
        } else
            quantity[index].value = parseInt(quantity[index].value) - 1;
        // console.log(typeof parseInt(pro_money[index].value));
        pro_money[index].innerHTML =  cost * parseInt(quantity[index].value); 

    })
})

plus.forEach(function(button){
    button.addEventListener('click', () =>{
        //Lay vi tri cua nut button tuong ung
        var index = button.value;
        const cost = parseInt(pro_money[index].innerHTML);
        var max_pro = quantity[index].getAttribute('max');
        if (quantity[index].value >= max_pro)
            quantity[index].value = max_pro;
        else   
            quantity[index].value = parseInt(quantity[index].value) + 1;
        
        pro_money[index].innerHTML =  cost * parseInt(quantity[index].value); 
    })
})


