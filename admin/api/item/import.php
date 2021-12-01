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
            $img = $xlsx->rows()[$i][3];
            $description = $xlsx->rows()[$i][4];
            $quantity = $xlsx->rows()[$i][5];
            $price = str_replace("RM ", "", $xlsx->rows()[$i][6]);
            $status = $xlsx->rows()[$i][7] == "Active" ? 1: 0;
            $catalogID = $xlsx->rows()[$i][9];
            $vendorID = $xlsx->rows()[$i][10];

            $sql = "insert into inventory (item_code, name, img, description, quantity, price, status, catalog_ID, vendor_ID) values (:itemcode, :name, :img, :description, :quantity, :price, :status, :catalogID, :vendorID)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":itemcode", $itemCode, PDO::PARAM_STR);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":img", $img, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_INT);
            $stmt->bindParam(":catalogID", $catalogID, PDO::PARAM_INT);
            $stmt->bindParam(":vendorID", $vendorID, PDO::PARAM_INT);
        
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
    $pdo=null;
