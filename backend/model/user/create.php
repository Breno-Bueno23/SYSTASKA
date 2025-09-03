<?php

    include('../../connection/conn.php');   

     if(empty($_POST['NAME']) || empty($_POST['EMAIL']) || empty($_POST['PASSWORD']) || empty($_POST['LEVEL'])){    
         $dados = array(
             "type" => "error",
             "message" => "existem campos obrigatorios que nao foram preenchidos."
        );
     } else {
        try{
            $sql = "INSERT INTO user (NAME, EMAIL, PASSWORD, LEVEL) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql); // Abreviatura de Statement
            $stmt->execute([
            $_POST['NAME'],
            $_POST['EMAIL'],
            $_POST['PASSWORD'],
            $_POST['LEVEL']]);   
            
            $dados = array(
                "type" => "success",
                "message" => "registro salvo com sucesso."
            );
        } catch(PDOException $e){
            $dados = array(
                "type" => "error",
                "message" => "Erro ao salvar o registro.".$e->getMessage()
            );
            
        }
    }


    $conn = null;
    echo json_encode($dados);
?>