"use strict";

const chat = document.querySelector('.blockChat .chat');
const messageInp=document.querySelector('#message');
let sendBtn=document.querySelector('#sendMessage');
let conn;


if(sendBtn){
    sendBtn.addEventListener("click", handleMessage);
    messageInp.addEventListener("keypress", e=>e.key==="Enter"?handleMessage.bind(sendBtn)():"");
    login();
}



function login(){
    if( !conn){
        conn=new WebSocket("ws://localhost:8000");
        messageInp.focus();
        setting();
    }
    else if (conn)
    {
        sendMessage("Server", `${user} est déconnecté(e)!`);
        conn.close();
        conn= undefined;

    }
}
function setting (){
    conn.onopen=()=>{
        onMessage({sender:"Server", message:"Connexion établie"});

        sendMessage("Server",`${user} est connecté(e) !`);
        sendMessage("Server", user, "login");
    };
    conn.onclose= ()=>onMessage({sender:"Server", message:"Déconnecté(e)!"});
    conn.onmessage=e=>onMessage(JSON.parse(e.data));
}
/**
 * récupere le message en paramètre et l'affiche dans la zone de chat (ici le pre)
 * 
 */
function onMessage(m){
    console.log(m);
    if(m.length){
        m.forEach(element => {
            chat.textContent += `${element.username}: ${element.content}\r\n`;
        });
        //Adding date?=>
        // chat.textContent += `[${element.createdat}]${element.username} :${element.content}\r\n`;
    }
    else if(m.option === "login")
    {
        // TODO selectionner "users logged" et ajouter l'utilisateur
       
    }
    else{
        chat.textContent += `${m.sender} :${m.message}\r\n`;
    }
    //[${m.createdat}] a ajouter entre crochet pour ajouter l'heure.
    chat.scrollTop=chat.scrollHeight;
}

function handleMessage(){
    if(messageInp.value)
    {
        const currentDate = new Date();
        const formattedDate = currentDate.toISOString().replace(/T/, ' ').replace(/\..+/, '');
        onMessage({sender:user, message:messageInp.value, createdat: formattedDate});
        sendMessage(user, messageInp.value);
        messageInp.value="";
        messageInp.focus();

    }
}
function sendMessage(u, m, o = "message"){
    conn.send(JSON.stringify({sender:u, message:m, senderid: userid, option: o}));
}


var updateBtn = document.getElementById("updatetoggle");
var closeupdate = document.getElementById("closeupdateBtn");
var deleteBtn = document.getElementById("deleteAccountBtn");
var confirmModalDelete = document.getElementById("confirmModal");
var updateModal = document.getElementById("updateModal");
// var updateModal = document.getElementById("updateModals");
var confirmBtn = document.getElementById("confirmDelete");

// Ouvrir modales
deleteBtn.addEventListener("click", function() {
    confirmModalDelete.showModal();
});
updatetoggle.addEventListener("click", function() {
    updateModal.showModal();
  });



// Écouter le choix de l'utilisateur
confirmModalDelete.addEventListener("close", function() {
  if (confirmModalDelete.returnValue === 'default') {
    console.log("Compte supprimé");
    //Gestion de la suppression réalisé en phpsur /userdelete.
  }
});

//fermeture modale Update
updateModal.addEventListener("close", function() {
    if (updateModal.returnValue === 'default') {
      console.log("fermeture modalUpdate");      
    }
  });

  closeupdate.addEventListener("click", function() {
    // Fermer la boîte de dialogue updateModal
    updateModal.close();
    console.log("fermeture modalUpdate");
  });
