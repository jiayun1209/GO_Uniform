<?php

class Alert{
    
    function add_alert($name, $description, $type, $userID, $url){
        include("config.php");
        
        $sql = "insert into alert (alert_name, description, type, userID, url, date_alert) values (:alert_name, :description, :type, :userID, :url, now())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":alert_name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_INT);
        $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt->bindParam(":url", $url, PDO::PARAM_STR);

        if($stmt->execute())
		{
            return "success";
		}
        
        return "fail";
    }
    
     function add_alert_group($name, $description, $type, $userType, $url){
        include("config.php");
        
        $sql = "INSERT INTO alert (alert_name, description, type, userID, url, date_alert) "
                ."SELECT :alert_name, :description, :type, staff.id, :url, now() FROM staff WHERE staff.type = :userType";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":alert_name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_INT);
        $stmt->bindParam(":userType", $userType, PDO::PARAM_INT);
        $stmt->bindParam(":url", $url, PDO::PARAM_STR);

        if($stmt->execute())
	{
            return "success";
	}
        
        return "fail";
    }
}


