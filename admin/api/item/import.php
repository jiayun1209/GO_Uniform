<?php
    session_start();
	include("../config.php");
	include("../SimpleXLSX.php");

    $isAuthorize = isset($_SESSION["userdata"]);
    $isParamFull = isset($_POST["file"]);

	if($isAuthorize)
    {
        $file = $_POST["file"];
        $fileName = time();
        
        $file = str_replace('data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,', '', $file);
        file_put_contents("./temp-$fileName.xls", base64_decode($file));
        
        $xlsx = SimpleXLSX::parse("temp-$fileName.xls");
        
        for($i=1; $i<count($xlsx->rows()); $i++){
            $itemCode = $xlsx->rows()[$i][1];
            $name = $xlsx->rows()[$i][2];
            $description = $xlsx->rows()[$i][3];
            $quantity = $xlsx->rows()[$i][4];
            $price = str_replace("RM ", "", $xlsx->rows()[$i][5]);
            $status = $xlsx->rows()[$i][6] == "Active" ? 1: 0;
            $catalogID = $xlsx->rows()[$i][8]; 

            $sql = "insert into inventory (item_code, name, description, quantity, price, status, catalog_ID) values (:itemcode, :name, :description, :quantity, :price, :status, :catalogID)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":itemcode", $itemCode, PDO::PARAM_STR);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_INT);
            $stmt->bindParam(":catalogID", $catalogID, PDO::PARAM_INT);
        
            if(!$stmt->execute())
            {
                echo -1;
                die();
            }
        }
        
        echo 1;
    }
    else{
        echo -1;
    }
    
    $pdo=null;