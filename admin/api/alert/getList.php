<?php
    session_start();
    include("../config.php");

    $isAuthorize = isset($_SESSION["userdata"]);
    if($isAuthorize)
    {
        $userID = $_SESSION["userdata"]["id"];
        
        $sql = "select * from alert where userID = :userID";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);

        $stmt->execute(); 
        
        $alertList = [];
        while ($row = $stmt->fetch()) {
            $alertList[] = [
                'alert_name' => $row['alert_name'],  
                'description' => $row['description'],
                'type' => $row['type'],
                'url' => $row['url']
            ];
        }
        
        echo json_encode($alertList);
    }
    else{
        echo -1;
    }
    
    $pdo=null;
?> 