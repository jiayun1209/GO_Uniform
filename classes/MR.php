<?php

require_once('../config.php');

Class MR extends DBConnection {

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

    function add_mr() {
        extract($_POST);
        $dataMR = "";
        $dataMRDetails = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('mr_ID'))) {
                $v = addslashes(trim($v));

                if ($k === "quantity_request" || $k === "item_ID") {
                    if (!empty($dataMRDetails))
                    $dataMRDetails .= ",";
                    $dataMRDetails .= " `{$k}`='{$v}' ";
                } elseif ($k == "mr_ID") {
                    if (!empty($dataMRDetails))
                        $dataMRDetails .= ",";
                    if (!empty($dataMR))
                        $dataMR .= ",";
                        $dataMRDetails .= " `{$k}`='{$v}' ";
                        $dataMR .= " `{$k}`='{$v}' ";
                } else {
                    if (!empty($dataMR))
                    $dataMR .= ",";
                    $dataMR .= " `{$k}`='{$v}' ";
                }
            }
        }


        $check = $this->conn->query("SELECT * FROM `materials_requisition` where `type` = '{$type}' " . (!empty($mr_ID) ? " and mr_ID != {$mr_ID} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "The MR type already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($mr_ID)) {
            $sql = "INSERT INTO `materials_requisition` set {$dataMR} ";
        } else {
            $sql = "UPDATE `materials_requisition` set {$dataMR} where mr_ID = '{$mr_ID}'";
        }
        $add = $this->conn->query($sql);
        $last_id = $this->conn->insert_id;
        
        if (empty($mr_ID)) {
            $sql = "INSERT INTO `materials_requisition_details` set mr_ID = $last_id, {$dataMRDetails} ";
            
        } else {
            $sql = "UPDATE `materials_requisition_details` set {$dataMRDetails} where mr_ID = '{$mr_ID}'";
        }
        
        
        $add = $this->conn->query($sql);

        if ($add) {
            $resp['status'] = 'success';
            if (empty($mr_ID))
                $this->settings->set_flashdata('success', "New MR successfully saved.");
            else
                $this->settings->set_flashdata('success', "MR successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_mr() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `materials_requisition` where mr_ID = '{$mr_ID}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "MR successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function search_mr() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('mr_ID'))) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }

        if (empty($mr_ID)) {
            $sql = "INSERT INTO `materials_requisition` set {$data} ";
        }

        $add = $this->conn->query($sql);
        if ($add) {
            $resp['status'] = 'success';
            if (empty($mr_ID))
                $this->settings->set_flashdata('success', "New MR successfully saved.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }


function create_mr() {
     extract($_POST);
        $dataMR = "";
        $dataMRDetails = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('mr_ID'))) {
                $v = addslashes(trim($v));

                if ($k === "quantity_request" || $k === "item_ID") {
                    if (!empty($dataMRDetails))
                    $dataMRDetails .= ",";
                    $dataMRDetails .= " `{$k}`='{$v}' ";
                } elseif ($k == "mr_ID") {
                    if (!empty($dataMRDetails))
                        $dataMRDetails .= ",";
                    if (!empty($dataMR))
                        $dataMR .= ",";
                        $dataMRDetails .= " `{$k}`='{$v}' ";
                        $dataMR .= " `{$k}`='{$v}' ";
                } else {
                    if (!empty($dataMR))
                    $dataMR .= ",";
                    $dataMR .= " `{$k}`='{$v}' ";
                }
            }
        }

        $check = $this->conn->query("SELECT * FROM `materials_requisition` where `type` = '{$type}' " . (!empty($mr_ID) ? " and mr_ID != {$mr_ID} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "The MR type already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($mr_ID)) {
            $sql = "INSERT INTO `materials_requisition` set {$dataMR} ";
        }
   
        $add = $this->conn->query($sql);
        $last_id = $this->conn->insert_id;
        
        if (empty($mr_ID)) {
            $sql = "INSERT INTO `materials_requisition_details` set mr_ID = $last_id, {$dataMRDetails} ";    
        }
        
        
        $add = $this->conn->query($sql);

        if ($add) {
            $resp['status'] = 'success';
            if (empty($mr_ID))
                $this->settings->set_flashdata('success', "New MR successfully saved.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }
    
}
    
$MR = new MR();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {

    case 'add_mr':
        echo $MR->add_mr();
        break;
    case 'delete_mr':
        echo $MR->delete_mr();
        break;
    case 'search_mr':
        echo $MR->search_mr();
        break;
    case 'create_mr':
        echo $MR->create_mr();
        break;
    default:
        // echo $sysset->index();
        break;
}
