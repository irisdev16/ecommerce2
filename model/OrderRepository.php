<?php

class OrderRepository
{
// permet de sauvegarder une commande en session
    public function persistOrder($order){
        session_start();
        $_SESSION["order"] = $order;
    }
// permet de récupérer une commande en session
    public function findOrder(){
        session_start();
        return $_SESSION["order"];
    }
}