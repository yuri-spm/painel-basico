<?php

    require ('Conection.php');
    //atualizar primeiro comando
    /*
    $cmd = $pdo->prepare("UPDATE PESSOA SET email= :e WHERE id= :id ");
    $cmd->bindValue(":e", "mirian@gmail.com");
    $cmd->bindValue(":id",1);
    $cmd->execute();

    */

    //atualizar segundo comando

    $cmd = $pdo->query("UPDATE PESSOA SET email= 'bruno.monteiro@gmail.com' WHERE id= '4'");