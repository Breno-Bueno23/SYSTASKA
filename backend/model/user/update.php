<?php

    include('../../connection/conn.php'); 

    if(empty($_POST['NAME']) || empty($_POST['EMAIL']) || empty($_POST['PASSWORD']) || empty($_POST['LEVEL']) 
    || empty($_POST['ID'])){    
        $dados = array(
            "type" => "error",
            "message" => "existem campos obrigatorios que nao foram preenchidos."
       );
    } else {
        try{
            $sql = "UPDATE user set NAME = ?, EMAIL = ?, PASSWORD = ?, LEVEL = ? where ID = ?";
            $stmt = $pdo->prepare($sql); 
            $stmt->execute([
            $_POST['NAME'],
            $_POST['EMAIL'],
            $_POST['PASSWORD'],
            $_POST['LEVEL'],
            $_POST['ID'],
        ]);   
            
            $dados = array(
                "type" => "success",
                "message" => "registro atualizado com sucesso."
            );
        } catch(PDOException $e){
            $dados = array(
                "type" => "error",
                "message" => "Erro ao atualizar o registro.".$e->getMessage()
            );
            
        }
    }

    $conn = null;
    echo json_encode($dados);
?>