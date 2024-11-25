
let alert_msg = document.querySelector("#alert-msg");

for(let i = 0; i < alert_msg.length; i++){
    setTimeout(function(){
        alert_msg[i].computedStyleMap.display = "none";
    }, 2000);
}