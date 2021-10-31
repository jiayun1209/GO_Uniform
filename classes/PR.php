<?php

require_once('../config.php');

Class PR extends DBConnection {

    private $settings;

    public function __construct() {
        global $_settings;
        $this->settings = $_settings;
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    function capture_err() {
        if (!$this->conn->error)
            return false;
        else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
            return json_encode($resp);
            exit;
        }
    }

    function add_pr() {
        extract($_POST);
        $dataPR = "";
        $dataPRDetails = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('pr_ID'))) {
                $v = addslashes(trim($v));

                if ($k === "quantity_request" || $k === "item_ID") {
                    if (!empty($dataPRDetails))
                    $dataPRDetails .= ",";
                    $dataPRDetails .= " `{$k}`='{$v}' ";
                } elseif ($k == "pr_ID") {
                    if (!empty($dataPRDetails))
                        $dataPRDetails .= ",";
                    if (!empty($dataPR))
                        $dataPR .= ",";
                        $dataPRDetails .= " `{$k}`='{$v}' ";
                        $dataPR .= " `{$k}`='{$v}' ";
                } else {
                    if (!empty($dataPR))
                    $dataPR .= ",";
                    $dataPR .= " `{$k}`='{$v}' ";
                }
            }
        }


        $check = $this->conn->query("SELECT * FROM `purchase_requisition` where `type` = '{$type}' " . (!empty($pr_ID) ? " and pr_ID != {$pr_ID} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "The PR Type already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($pr_ID)) {
            $sql = "INSERT INTO `purchase_requisition` set {$dataPR} ";
        } else {
            $sql = "UPDATE `purchase_requisition` set {$dataPR} where pr_ID = '{$pr_ID}'";
        }
        $add = $this->conn->query($sql);
        $last_id = $this->conn->insert_id;
        
        if (empty($pr_ID)) {
            $sql = "INSERT INTO `purchase_requisiton_details` set pr_ID = $last_id, {$dataPRDetails} ";
            
        } else {
            $sql = "UPDATE `purchase_requisiton_details` set {$dataPRDetails} where pr_ID = '{$pr_ID}'";
        }
        
        
        $add = $this->conn->query($sql);

        if ($add) {
            $resp['status'] = 'success';
            if (empty($pr_ID))
                $this->settings->set_flashdata('success', "New PR successfully saved.");
            else
                $this->settings->set_flashdata('success', "PR successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }
    
    
    
     function save_pr_test() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('pr_ID')) && !is_array($_POST[$k])) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (!empty($pr_ID)) {
            $check = $this->conn->query("SELECT * FROM `purchase_requisition` where `type` = '{$type}' " . ($pr_ID > 0 ? " and pr_ID != '{$pr_ID}' " : ""))->num_rows;
            if ($this->capture_err())
                return $this->capture_err();
            if ($check > 0) {
                $resp['status'] = 'failed';
                $resp['msg'] = "Purchase Requisition Type already exist.";
                return json_encode($resp);
                exit;
            }
        } 
       

        if (empty($pr_ID)) {
            $sql = "INSERT INTO `purchase_requisition` set {$data} ";
        } else {
            $sql = "UPDATE `purchase_requisition` set {$data} where pr_ID = '{$pr_ID}' ";
        }
        $save = $this->conn->query($sql);
        if ($save) {
            $resp['status'] = 'success';
            $pr_ID = empty($pr_ID) ? $this->conn->insert_id : $pr_ID;
            $resp['pr_ID'] = $pr_ID;
            $data = "";
            foreach ($item_id as $k => $v) {
                if (!empty($data))
                    $data .= ",";
                $data .= "('{$pr_ID}','{$v}')";
            }
            if (!empty($data)) {
                $this->conn->query("DELETE FROM `purchase_requisiton_details` where pr_ID = '{$pr_ID}'");
                $save = $this->conn->query("INSERT INTO `purchase_requisiton_details` (`pr_ID`,`item_id`,`quantity_request`) VALUES {$data} ");
            }
            if (empty($pr_ID))
                $this->settings->set_flashdata('success', "PR successfully saved.");
            else
                $this->settings->set_flashdata('success', "PR successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }


    function delete_pr() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `purchase_requisition` where pr_ID = '{$pr_ID}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "PR successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }
    
    function create_pr() {
        extract($_POST);
        $dataPR = "";
        $dataPRDetails = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('pr_ID'))) {
                $v = addslashes(trim($v));

                if ($k === "quantity_request" || $k === "item_ID") {
                    if (!empty($dataPRDetails))
                        $dataPRDetails .= ",";
                    $dataPRDetails .= " `{$k}`='{$v}' ";
                } elseif ($k == "pr_ID") {
                    if (!empty($dataPRDetails))
                        $dataPRDetails .= ",";
                    if (!empty($dataPR))
                        $dataPR .= ",";
                    $dataPRDetails .= " `{$k}`='{$v}' ";
                    $dataPR .= " `{$k}`='{$v}' ";
                } else {
                    if (!empty($dataPR))
                        $dataPR .= ",";
                    $dataPR .= " `{$k}`='{$v}' ";
                }
            }
        }

        $check = $this->conn->query("SELECT * FROM `purchase_requisition` where `pr_ID` = '{$pr_ID}' " . 
                (!empty($pr_ID) ? " and pr_ID != {$pr_ID} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "The PR already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($pr_ID)) {
            $sql = "INSERT INTO `purchase_requisition` set {$dataPR} ";
        }

        $add = $this->conn->query($sql);
        $last_id = $this->conn->insert_id;

        if (empty($pr_ID)) {
            $sql = "INSERT INTO `purchase_requisiton_details` set pr_ID = $last_id, {$dataPRDetails} ";
        }


        $add = $this->conn->query($sql);

        if ($add) {
            $resp['status'] = 'success';
            if (empty($pr_ID))
                $this->settings->set_flashdata('success', "New PR successfully saved.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }
}
    

    
$PR = new PR();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {

    
    case 'add_pr':
        echo $PR->add_pr();
        break;
    case 'delete_pr':
        echo $PR->delete_pr();
        break;
    case 'create_pr':
        echo $PR->create_pr();
        break;
    case 'save_pr_test':
        echo $PR->save_pr_test();
        break;
    default:
        // echo $sysset->index();
        break;
}
