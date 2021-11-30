<?php
    session_start();
    include("../config.php");
    
    $isAuthorize = isset($_SESSION["userdata"]);
    $isParamFull = isset($_POST["staffID"]);
    
    if($isAuthorize && $isParamFull)
    {
        $staffID = $_POST["staffID"];
        $purchasedTotal = 0;
        $budget = 0;
        
        //Get purchased total
        $sql = "SELECT sum(prd.unit_price * prd.quantity) as total FROM purchase_requisitions pr join purchase_requisitions_details prd on pr.id = prd.pr_id WHERE pr.staff_id = :staffID";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":staffID", $staffID, PDO::PARAM_INT);
        
        $stmt->execute(); 
        $row = $stmt->fetch();
        
        $purchasedTotal = $row['total']?$row['total']:0;
        
        //Get budget value
        $sql = "SELECT amount FROM budget_limit WHERE staff_ID = :staffID";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":staffID", $staffID, PDO::PARAM_INT);
        
        $stmt->execute(); 
        $row = $stmt->fetch();
        
        $budget = $row['amount'];
        
        echo $budget - $purchasedTotal;
    }
    else{
        echo -1;
    }
    
    $pdo=null;
?> 