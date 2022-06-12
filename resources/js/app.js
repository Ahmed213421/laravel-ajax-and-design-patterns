require('./bootstrap');
const { default: axios } = require('axios');


const messages = document.getElementById('messages');
const username = document.getElementById('username');
const message_input = document.getElementById('messageinput');
const message_form = document.getElementById('messageform');
const justify = document.getElementById('justify');
const userId = document.getElementById('userid');

message_form.addEventListener('submit',function(e){
    e.preventDefault();
    let has_errors = false;
    if(username.value == ""){
        alert('please enter a username...');
        has_errors = true;
    }
    if(message_input.value == ''){
        alert('please enter a message...');
        has_errors = true;
    }
    if(has_errors){
        return;
    }

    const options = {
        method: 'post',
        url: '/messages',
        data : {
            id: userId.value,
            username : username.value,
            message : message_input.value,
        }
    }

    axios(options);
});

window.Echo.channel('chat')

.listen('.message',(e)=>{
    messages.innerHTML += '<div class="message"><strong>'+e.username+'</strong>'+e.message+'</div>';

    // if(window.authId == e.id){
    //     justify.classList.remove('justify-content-end');
    //     justify.classList.add('justify-content-start');
    // }else{
    //     justify.classList.add('justify-content-end');
    // }
    
});

