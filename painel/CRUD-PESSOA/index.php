<?php
    require_once ("classe_pessoa.php");
    $p =new Pessoa("CRUDPDO","localhost","yuri","7q5eb6eb@#");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Cadastro Pessoa</title>
    <link rel="stylesheet" href="estilo.css"/>
</head>
<body>
<?php
    //usuario clicou no botao editar ou botão cadastrar
    if(isset($_POST['nome'])) {
        //-------------------------EDITAR-------------------------
        if (isset($_GET['id_up']) && !empty($_GET['id_up'])) {
            $id_update = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']); // não permite a inserção de codigos maliciosos
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            if (!empty($nome) && !empty($telefone) && !empty($email)) {

                //----------------------ENVIAR ATUALIZACAO----------------
                $p->atualizarDados($id_update, $nome, $telefone, $email);
                header('location:index.php');
            } else {
                    ?>
                    <div class="aviso">
                        <img src="aviso.jpg">
                        <h4>Preencha todos os campos</h4>
                    </div>
                    <?php
                    }

            }
                     //------------------------CADASTRAR-----------------------
            else {
                $nome = addslashes($_POST['nome']); // não permite a inserção de codigos maliciosos
                $telefone = addslashes($_POST['telefone']);
                $email = addslashes($_POST['email']);
                if (!empty($nome) && !empty($telefone) && !empty($email)) {

                    //--------------ENVIAR CADASTRO------------------
                    if (!$p->cadastrarPessoa($nome, $telefone, $email)) {

                        ?>
                        <div class="aviso">
                            <img src="aviso.jpeg">
                            <h4>Email ja esta cadastrado</h4>
                        </div>
                        <?php
                    }

            } else {
                ?>
                <div class="aviso">
                    <img src="aviso.jpeg">
                    <h4>Preencha todos os campos</h4>
                </div>
                <?php

            }
        }
    }

?>
<?php

    //buscando informaçoes pelo id
    if(isset($_GET['id_up'])){
        $id_update = addslashes($_GET['id_up']);
        $res = $p->buscarDadosPessoa($id_update);

    }
?>
    <section id="esquerda">

        <form method="POST">

            <h2>CADASTRAR PESSOA</h2>
            <label for="nome">NOME</label>
                <input  type="txt" name="nome" id="nome"
                       value="<?php if(isset($res)){echo $res['nome'];}?>">


            <label form="telefone">TELEFONE</label>
                <input  type="txt" name="telefone" id="telefone"
                       value="<?php if(isset($res)) {echo $res['telefone'];}?>">

            <label form="email">E-MAIL</label>
                <input type="email" name="email" id="email"
                       value="<?php if(isset($res)){echo $res['email'];} ?>">

            <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}
                else{echo "Cadastrar";}?>">
    </section>
    <section id="direita">
        <table>
            <tr id="titulo">
                <td>NOME</td>
                <td>TELEFONE</td>
                <td colspan="2">E-MAIL</td>
            </tr>
        <?php
            //buscando dados
            $dados = $p->buscarDados();
            //verifica de dados e maior que banco de dados
            if(count($dados)>0){
                //itera com itens do bd
                for($i=0;$i<count($dados);$i++){
                    echo "<tr>";
                    //imprime os dados do bd excluindo o id
                    foreach ($dados[$i] as $key=>$value){
                        if($key !="id"){

                            echo "<td>".$value."</td>";
                        }

                    }
                    //excluindo um cadastro pelo id
        ?>
                    <td>
                        <a href="index.php?id_up=<?= $dados[$i]['id'];?>">Editar</a>

                        <a href="index.php?id=<?= $dados[$i]['id'];?>">Excluir</a> </td>

         <?php

              echo "</tr>";
                }
            }else{
                ?>
                  </table>
                        <div class="aviso">
                            <h4>Ainda não há pessoas cadastradas</h4>
                        </div>

                <?php
            }
            ?>

    </section>









</body>
</html>

<?php
    //deletando um cadastro pelo login
    //isset verifica se id existe
    if(isset($_GET['id'])){
        $pessoa =  addslashes($_GET['id']);
        $p->deletarPessoa($pessoa);
        header("location: index.php");
    }
?>