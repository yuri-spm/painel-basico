<?php

    require ('Conection.php');
    //primeira forma de selecionar

    $cmd = $pdo->prepare("SELECT * FROM PESSOA WHERE id = :id");
    $cmd->bindValue(":id", 4);
    $cmd->execute();
    //transformar informação do banco em um array
    //PDO::FETCH_ASSOC tras informação reduzida do banco de dados
    //$cmd->fetchAll(); //retorna todas as informações do bd
    $resul = $cmd->fetch(PDO::FETCH_ASSOC); //retorna uma informação

    foreach($resul as $key=>$value){
            echo "{$key}: {$value}</br>";
    }



/*
  UTILIZADO PARA TESTE
    echo 'RESULTADO COM var_dump';
    var_dump($resul);

    echo '<pre>';
    echo 'RESULTADO COM print_r';
    print_r($resul);

*/