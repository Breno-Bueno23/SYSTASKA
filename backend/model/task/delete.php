<?php

    include('../../connection/conn.php'); 

    if(empty($_POST['ID'])){    
        $dados = array(
            "type" => "error",
            "message" => "existem campos obrigatorios que nao foram preenchidos."
       );
    } else {
        try{
            $sql = "DELETE FROM task where ID = ?";
            $stmt = $pdo->prepare($sql); 
            $stmt->execute([
            $_POST['ID'],
        ]);   
            
            $dados = array(
                "type" => "success",
                "message" => "registro excluido com sucesso."
            );
        } catch(PDOException $e){
            $dados = array(
                "type" => "error",
                "message" => "Erro ao excluir o registro.".$e->getMessage()
            );
            
        }
    }

    $conn = null;
    echo json_encode($dados);
?>