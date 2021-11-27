<?php
    session_start();
	include("../config.php");

    $isAuthorize = isset($_SESSION["userdata"]);

	if($isAuthorize)
    {
        $sql = "select i.*, c.description catalog_name from inventory i join catalog c on c.id = i.catalog_ID";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute(); 
        
        $inventoryList = [];
        while ($row = $stmt->fetch()) {
            $inventoryList[] = [
                'id' => $row['id'],
                'item_code' => $row['item_code'],
                'name' => $row['name'],
                'description' => $row['description'],
                'quantity' => $row['quantity'],
                'price' => $row['price'],
                'status' => $row['status'],
                'date_created' => $row['date_created'],
                'catalog_ID' => $row['catalog_ID'],
                'catalog_name' => $row['catalog_name']
            ];
        }
        
        echo json_encode($inventoryList);
    }
    else{
        echo -1;
    }
    
    $pdo=null;
?> 