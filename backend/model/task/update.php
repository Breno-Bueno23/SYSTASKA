<?php

    include('../../connection/conn.php'); 

if(empty($_POST['TITLE']) || empty($_POST['DATE_TIME']) || empty($_POST['DESCRIPTION']) || empty($_POST['USER_ID'])
|| empty($_POST['ID'])){    
    $dados = array(
        "type" => "error",
        "message" => "existem campos obrigatorios que nao foram preenchidos."
   );
} else {
    try{
        $sql = "UPDATE task set TITLE = ?, DATE_TIME = ?, DESCRIPTION = ?, USER_ID = ? where ID = ?";
        $stmt = $pdo->prepare($sql); 
        $stmt->execute([
        $_POST['TITLE'],
        $_POST['DATE_TIME'],
        $_POST['DESCRIPTION'],
        $_POST['USER_ID'],
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