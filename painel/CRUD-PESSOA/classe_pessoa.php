<?php


class Pessoa
{
    private $pdo;
    //6 funções

    //CONEXAO COM O BANCO DE DADOS
    public function __construct($dbname, $host, $user, $senha)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha,
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_CASE => PDO::CASE_NATURAL
                ]);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //dbname = nome do banco dedados
            //host = endereço do servidor
            //username = usuario
            //senha

          //pega o erro e coloca dentro da variavel $e
        } catch (PDOException $e) {
            echo "Erro com banco de dados: {$e->getMessage()}";

            exit();
        } catch (Exception $e) {
            echo "Erro generico: {$e->getMessage()}";
        }
    }


    //funcao busca dados e  coloca no canto direito
    public function buscarDados()
    {
            //criando um array fazio
            //select dentro do banco em ordem crescente
            //fecthall retorna todos os itens
            $res = array();
            $cmd = $this->pdo->query("SELECT *FROM pessoa ORDER BY id ASC ");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
    }

    //CADASTRAR PESSOA NO BANCO DE DADOS
    //antes de cadastrar verificar se ja existe email
    public function cadastrarPessoa($nome, $telefone, $email)
    {
        //antes de cadastrar verificar se ja tem email cadastrado

        $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE  email= :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        //rowCount > 0 ja existe e-mail
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES (:n, :t, :e)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            return true;
        }
    }
    //deletando cadastro pelo id
    public function deletarPessoa($id){
            $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id= :id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
    }

    //buscar dados de uma pessoa
    public function buscarDadosPessoa($id){
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * from pessoa WHERE id = :id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
            //var_dump($res);
    }
    public function atualizarDados($id,$nome, $telefone, $email){
            $cmd = $this->pdo->prepare("UPDATE pessoa SET nome= :n, telefone= :t, email= :e WHERE id= :id");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            return true;

        }


}

