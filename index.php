<?php
require_once ('vendor/autoload.php'); // if you use Composer
//require_once('ultramsg.class.php'); // if you download ultramsg.class.php

session_start();
$ultramsg_token="ycyzgg3n1nm95cz6"; // Ultramsg.com token
$instance_id="instance22302"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

//Enviar primeira Mensagem
if(!isset($_SESSION['i'])) {
    $to="5547999163758"; 
    $body="Olá (nome do comprador)😊
    
Bem vindo ao nosso autoatendimento!🤖
    
Gostaria de confirmar a compra do produto *(nome do produto)*🛍️ para o endereço (endereço do comprador)🗺️ ?
    
    *• Sim*
    *• Não*
    "; 
    $api=$client->sendChatMessage($to,$body);
    print_r($api);
    $_SESSION['i'] = 1;
    exit;
    echo "<hr>";
}

//Ler primeira resposta
if($_SESSION["i"] == 1) {
    $chatId="554799163758@c.us";
    $limit=100;
    $api=$client->getChatsMessages($chatId,$limit);

    //Opção de segunda resposta
    if(end($api)["body"] == "sim") {
        $to="5547999163758"; 
        $body="Confirmação bem sucedida!!🥳🥳🥳🥳🥳🥳🥳🥳

Qual seria o melhor período para receber o produto?☀🌥️🌕
        
    *• Manhã*
    *• Tarde*
    *• Noite*
        "; 

    $api=$client->sendChatMessage($to,$body);
    $_SESSION['i'] = 2.1;
    print_r($api);

    //Opção de segunda resposta
    } elseif(end($api)["body"] == "nao") {
        $to="5547999163758"; 
        $body="Desculpa o incomodo🙁

Poderia me dizer qual foi o erro cometido?🤔
        
    *1 - Número errado*
    *2 - Produto errado*
    *3 - Endereço errado*
    *4 - Compra foi cancelada*
        "; 

    $api=$client->sendChatMessage($to,$body);
    $_SESSION['i'] = 2.2;
    print_r($api);
    } else {
        unset($_SESSION["i"]);
    }
    
    echo "<hr>";
}

//Ler segunda resposta

if($_SESSION["i"] == 2.1) {
    $chatId="554799163758@c.us";
    $limit=100;
    $api=$client->getChatsMessages($chatId,$limit);

    //Opção de terceira resposta
    
    if(end($api)["body"] == "tarde") {
        $to="5547999163758"; 
        $body="Agradecemos pela preferência 🥳🥳

Sua encomenda está sendo separada nesse instante ✉️
        
Assim que o entregador sair para a entrega você receberá um link aonde poderá acompanhar a localização do envio em tempo real 🚚🚚
        "; 

    $api=$client->sendChatMessage($to,$body);
    $_SESSION['i'] = 2.1;
    print_r($api);
    }

}

// session_destroy();