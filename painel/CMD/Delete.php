<?php

    require ('Conection.php');
    /*
    //primeira forma de delete

    $cmd = $pdo->prepare("DELETE FROM PESSOA WHERE  id = :id"    );
    $id =2;
    $cmd->bindValue(":id",$id);
    $cmd->execute();

    */
    //segunda forma

    $cmd = $pdo->query("DELETE FROM PESSOA WHERE  id = '4'");