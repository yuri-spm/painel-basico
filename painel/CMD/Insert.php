<?php

    require('Conection.php');
/* esse esta funcionando
try {
   //primeira forma de insert
   $res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES(:n, :t, :e)"); // serve para passar um parametro e depois substitui

   $nome = "Miriam Testes";
   $telefone = "25984566";
   $email = "mirian.santos@gmail.com";


   $res->bindValue(":n", $nome);
   $res->bindValue(":t", $telefone);
   $res->bindValue(":e", $email);
   $res->execute();
} catch (PDOException $exception) {
   var_dump($exception);
}


*/

   //segunda forma de insert
   $pdo->query("INSERT INTO PESSOA(nome, telefone, email) VALUES('Bruno', '33658972','brunomonteiro@gmail.com')");     //ele executa automaticamente.
