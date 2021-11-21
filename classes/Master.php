<?php

require_once('../config.php');

Class Master extends DBConnection {

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

    function save_supplier() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('vendor_ID'))) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        $check = $this->conn->query("SELECT * FROM `vendor` where `name` = '{$name}' " . (!empty($vendor_ID) ? " and vendor_ID != {$vendor_ID} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Supplier already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($vendor_ID)) {
            $sql = "INSERT INTO `vendor` set {$data} ";
            $save = $this->conn->query($sql);
        } else {
            $sql = "UPDATE `vendor` set {$data} where vendor_ID = '{$vendor_ID}' ";
            $save = $this->conn->query($sql);
        }
        if ($save) {
            $resp['status'] = 'success';
            if (empty($vendor_ID))
                $this->settings->set_flashdata('success', "New Supplier successfully saved.");
            else
                $this->settings->set_flashdata('success', "Supplier successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_supplier() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `vendor` where vendor_ID = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Supplier successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_rating() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('rating_ID'))) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        $check = $this->conn->query("SELECT * FROM `rating`  where `performance_ID` = '{$performance_ID}' " . (!empty($rating_ID) ? " and rating_ID != {$rating_ID} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Rating already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($rating_ID)) {
            $sql = "INSERT INTO `rating` set {$data} ";
            $save = $this->conn->query($sql);
        } else {
            $sql = "UPDATE `rating` set {$data} where rating_ID = '{$rating_ID}' ";
            $save = $this->conn->query($sql);
        }
        if ($save) {
            $resp['status'] = 'success';
            if (empty($rating_ID))
                $this->settings->set_flashdata('success', "New Rating successfully saved.");
            else
                $this->settings->set_flashdata('success', "Rating successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function save_subcontractor() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('subcontractor_ID'))) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        $check = $this->conn->query("SELECT * FROM `subcontractor` where `name` = '{$name}' " . (!empty($subcontractor_ID) ? " and subcontractor_ID != {$subcontractor_ID} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Subcontractor already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($subcontractor_ID)) {
            $sql = "INSERT INTO `subcontractor` set {$data} ";
            $save = $this->conn->query($sql);
        } else {
            $sql = "UPDATE `subcontractor` set {$data} where subcontractor_ID = '{$subcontractor_ID}' ";
            $save = $this->conn->query($sql);
        }
        if ($save) {
            $resp['status'] = 'success';
            if (empty($subcontractor_ID))
                $this->settings->set_flashdata('success', "New Subcontractor successfully saved.");
            else
                $this->settings->set_flashdata('success', "Subcontractor successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_subcontractor() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `subcontractor` where subcontractor_ID = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "subcontractor successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_con() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id'))) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        $check = $this->conn->query("SELECT * FROM `id` where `startDate` = '{startDate}' " . (!empty($startDate) ? " and startDate != {$startDate} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Contract already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($id)) {
            $sql = "INSERT INTO `contract` set {$data} ";
            $save = $this->conn->query($sql);
        } else {
            $sql = "UPDATE `contract` set {$data} where id = '{$id}' ";
            $save = $this->conn->query($sql);
        }
        if ($save) {
            $resp['status'] = 'success';
            if (empty($id))
                $this->settings->set_flashdata('success', "New Contract successfully saved.");
            else
                $this->settings->set_flashdata('success', "Contract successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_con() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `contract` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "This contract successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_rfq() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (in_array($k, array('discount_amount', 'tax_amount')))
                $v = str_replace(',', '', $v);
            if (!in_array($k, array('id', 'q_ID')) && !is_array($_POST[$k])) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (!empty($q_ID)) {
            $check = $this->conn->query("SELECT * FROM `quotation` where `q_ID` = '{$q_ID}' " . ($id > 0 ? " and id != '{$id}' " : ""))->num_rows;
            if ($this->capture_err())
                return $this->capture_err();
            if ($check > 0) {
                $resp['status'] = 'po_failed';
                $resp['msg'] = "RFQ Number already exist.";
                return json_encode($resp);
                exit;
            }
        } else {
            $q_ID = "";
            while (true) {
                $q_ID = "20RFQ" . (sprintf("%'.011d", mt_rand(1, 99999999999)));
                $check = $this->conn->query("SELECT * FROM `quotation` where `q_ID` = '{$q_ID}'")->num_rows;
                if ($check <= 0)
                    break;
            }
        }
        $data .= ", q_ID = '{$q_ID}' ";

        if (empty($id)) {
            $sql = "INSERT INTO `quotation` set {$data} ";
        } else {
            $sql = "UPDATE `quotation` set {$data} where id = '{$id}' ";
        }
        $save = $this->conn->query($sql);
        if ($save) {
            $resp['status'] = 'success';
            $rfq_no = empty($id) ? $this->conn->insert_id : $id;
            $resp['id'] = $rfq_no;
            $data = "";
            foreach ($item_id as $k => $v) {
                if (!empty($data))
                    $data .= ",";
                $data .= "('{$rfq_no}','{$v}','{$unit_price[$k]}','{$qty[$k]}')";
            }
            if (!empty($data)) {
                $this->conn->query("DELETE FROM `rfq` where rfq_no= '{$rfq_no}'");
                $save = $this->conn->query("INSERT INTO `rfq` (`rfq_no`,`item_id`,`unit_price`,`quantity`) VALUES {$data} ");
            }
            if (empty($id))
                $this->settings->set_flashdata('success', "RFQ successfully saved.");
            else
                $this->settings->set_flashdata('success', "RFQ successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_rfq() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `quotation` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "RFQ successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_item() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id', 'description'))) {
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (isset($_POST['description'])) {
            if (!empty($data))
                $data .= ",";
            $data .= " `description`='" . addslashes(htmlentities($description)) . "' ";
        }
        $check = $this->conn->query("SELECT * FROM `inventory` where `name` = '{$name}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Item Name already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($id)) {
            $sql = "INSERT INTO `inventory` set {$data} ";
        } else {
            $sql = "UPDATE `inventory` set {$data} where id = '{$id}' ";
        }
        $save = $this->conn->query($sql);
        if ($save) {
            $resp['status'] = 'success';
            if (empty($id))
                $this->settings->set_flashdata('success', "New item successfully saved.");
            else
                $this->settings->set_flashdata('success', "item successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_item() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `inventory` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "item successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_catalog() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id', 'description'))) {
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (isset($_POST['description'])) {
            if (!empty($data))
                $data .= ",";
            $data .= " `description`='" . addslashes(htmlentities($description)) . "' ";
        }
        $check = $this->conn->query("SELECT * FROM `catalog` where `catalog_ID` = '{$catalog_ID}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Catalog already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($id)) {
            $sql = "INSERT INTO `catalog` set {$data} ";
        } else {
            $sql = "UPDATE `catalog` set {$data} where id = '{$id}' ";
        }
        $save = $this->conn->query($sql);
        if ($save) {
            $resp['status'] = 'success';
            if (empty($id))
                $this->settings->set_flashdata('success', "New catalog successfully saved.");
            else
                $this->settings->set_flashdata('success', "Catalog successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_catalog() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `catalog` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "catalog successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function search_items() {
        extract($_POST);
        $qry = $this->conn->query("SELECT * FROM inventory where `name` LIKE '%{$q}%'");
        $data = array();
        while ($row = $qry->fetch_assoc()) {
            $data[] = array("label" => $row['name'], "id" => $row['id'], "description" => $row['description'], "id" => $row['id'], "item_code" => $row['item_code']);
        }
        return json_encode($data);
    }

    function search_rating() {
        extract($_POST);
        $qry = $this->conn->query("SELECT * FROM rating_measurement where `name` LIKE '%{$q}%'");
        $data = array();
        while ($row = $qry->fetch_assoc()) {
            $data[] = array("label" => $row['performance_ID'], "performance_ID" => $row['performance_ID'], "remarks" => $row['remarks'], "performance_ID" => $row['performance_ID'], "point" => $row['point']);
        }
        return json_encode($data);
    }

    function search_pr() {
        extract($_POST);
        $qry = $this->conn->query("SELECT * FROM purchase_requisitions_details where `quantity`");
        $data = array();
        while ($row = $qry->fetch_assoc()) {
            $data[] = array("label" => $row['id'], "quantity" => $row['quantity'], "id" => $row['id'], "pr_id" => $row['pr_id']);
        }
        return json_encode($data);
    }

    function save_po() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (in_array($k, array('discount_amount', 'tax_amount')))
                $v = str_replace(',', '', $v);
            if (!in_array($k, array('id', 'po_no')) && !is_array($_POST[$k])) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (!empty($po_no)) {
            $check = $this->conn->query("SELECT * FROM `purchase_order` where `po_no` = '{$po_no}' " . ($id > 0 ? " and id != '{$id}' " : ""))->num_rows;
            if ($this->capture_err())
                return $this->capture_err();
            if ($check > 0) {
                $resp['status'] = 'po_failed';
                $resp['msg'] = "Purchase Order Number already exist.";
                return json_encode($resp);
                exit;
            }
        } else {
            $po_no = "";
            while (true) {
                $po_no = "PO-" . (sprintf("%'.011d", mt_rand(1, 99999999999)));
                $check = $this->conn->query("SELECT * FROM `purchase_order` where `po_no` = '{$po_no}'")->num_rows;
                if ($check <= 0)
                    break;
            }
        }
        $data .= ", po_no = '{$po_no}' ";

        if (empty($id)) {
            $sql = "INSERT INTO `purchase_order` set {$data} ";
        } else {
            $sql = "UPDATE `purchase_order` set {$data} where id = '{$id}' ";
        }
        $save = $this->conn->query($sql);
        if ($save) {
            $resp['status'] = 'success';
            $po_id = empty($id) ? $this->conn->insert_id : $id;
            $resp['id'] = $po_id;
            $data = "";
            foreach ($item_id as $k => $v) {
                if (!empty($data))
                    $data .= ",";
                $data .= "('{$po_id}','{$v}','{$unit_price[$k]}','{$qty[$k]}')";
            }
            if (!empty($data)) {
                $this->conn->query("DELETE FROM `purchase_order_details` where po_id = '{$po_id}'");
                $save = $this->conn->query("INSERT INTO `purchase_order_details` (`po_id`,`item_id`,`unit_price`,`quantity`) VALUES {$data} ");
            }
            if (empty($id))
                $this->settings->set_flashdata('success', "Purchase Order successfully saved.");
            else
                $this->settings->set_flashdata('success', "Purchase Order successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_po() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `purchase_order` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Purchase Order successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function get_price() {
        extract($_POST);
        $qry = $this->conn->query("SELECT * FROM price_list where unit_id = '{$unit_id}'");
        $this->capture_err();
        if ($qry->num_rows > 0) {
            $res = $qry->fetch_array();
            switch ($rent_type) {
                case '1':
                    $resp['price'] = $res['monthly'];
                    break;
                case '2':
                    $resp['price'] = $res['quarterly'];
                    break;
                case '3':
                    $resp['price'] = $res['annually'];
                    break;
            }
        } else {
            $resp['price'] = "0";
        }
        return json_encode($resp);
    }

    function save_rent() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id')) && !is_array($_POST[$k])) {
                if (!empty($data))
                    $data .= ",";
                $v = addslashes($v);
                $data .= " `{$k}`='{$v}' ";
            }
        }
        switch ($rent_type) {
            case 1:
                $data .= ", `date_end`='" . date("Y-m-d", strtotime($date_rented . ' +1 month')) . "' ";
                break;

            case 2:
                $data .= ", `date_end`='" . date("Y-m-d", strtotime($date_rented . ' +3 month')) . "' ";
                break;
            case 3:
                $data .= ", `date_end`='" . date("Y-m-d", strtotime($date_rented . ' +1 year')) . "' ";
                break;
            default:
                # code...
                break;
        }
        if (empty($id)) {
            $sql = "INSERT INTO `rent_list` set {$data} ";
        } else {
            $sql = "UPDATE `rent_list` set {$data} where id = '{$id}' ";
        }
        $save = $this->conn->query($sql);
        if ($save) {
            $resp['status'] = 'success';
            if (empty($id))
                $this->settings->set_flashdata('success', "New Rent successfully saved.");
            else
                $this->settings->set_flashdata('success', "Rent successfully updated.");
            $this->settings->conn->query("UPDATE `unit_list` set `status` = '{$status}' where id = '{$unit_id}'");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_rent() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `rent_list` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Rent successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function delete_img() {
        extract($_POST);
        if (is_file($path)) {
            if (unlink($path)) {
                $resp['status'] = 'success';
            } else {
                $resp['status'] = 'failed';
                $resp['error'] = 'failed to delete ' . $path;
            }
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = 'Unkown ' . $path . ' path';
        }
        return json_encode($resp);
    }

    function renew_rent() {
        extract($_POST);
        $qry = $this->conn->query("SELECT * FROM `rent_list` where id ='{$id}'");
        $res = $qry->fetch_array();
        switch ($res['rent_type']) {
            case 1:
                $date_end = " `date_end`='" . date("Y-m-d", strtotime($res['date_end'] . ' +1 month')) . "' ";
                break;
            case 2:
                $date_end = " `date_end`='" . date("Y-m-d", strtotime($res['date_end'] . ' +3 month')) . "' ";
                break;
            case 3:
                $date_end = " `date_end`='" . date("Y-m-d", strtotime($res['date_end'] . ' +1 year')) . "' ";
                break;
            default:
                # code...
                break;
        }
        $update = $this->conn->query("UPDATE `rent_list` set {$date_end}, date_rented = date_end where id = '{$id}' ");
        if ($update) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', " Rent successfully renewed.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_event() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id'))) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        $check = $this->conn->query("SELECT * FROM `events` where `title` = '{$title}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "The Events already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($id)) {
            $sql = "INSERT INTO `events` set {$data} ";
            $save = $this->conn->query($sql);
        } else {
            $sql = "UPDATE `events` set {$data} where id = '{$id}' ";
            $save = $this->conn->query($sql);
        }
        if ($save) {
            $resp['status'] = 'success';
            if (empty($id))
                $this->settings->set_flashdata('success', "New Events successfully saved.");
            else
                $this->settings->set_flashdata('success', "Events successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_event() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `events` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Event successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_alert() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('alert_id'))) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        $check = $this->conn->query("SELECT * FROM `alert` where `alert_name` = '{$alert_name}' " . (!empty($alert_id) ? " and alert_id != {$alert_id} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "The Alert already exist.";
            return json_encode($resp);
            exit;
        }
        if (empty($alert_id)) {
            $sql = "INSERT INTO `alert` set {$data} ";
            $save = $this->conn->query($sql);
        } else {
            $sql = "UPDATE `alert` set {$data} where alert_id = '{$alert_id}' ";
            $save = $this->conn->query($sql);
        }
        if ($save) {
            $resp['status'] = 'success';
            if (empty($alert_id))
                $this->settings->set_flashdata('success', "New Alert successfully saved.");
            else
                $this->settings->set_flashdata('success', "Alert successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_alert() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `alert` where alert_id = '{$alert_id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Alert successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_budget() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('budget_no'))) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        $check = $this->conn->query("SELECT * FROM `budget_limit` where `staff_ID` = '{$staff_ID}' " . (!empty($budget_no) ? " and budget_no != {$budget_no} " : "") . " ")->num_rows;
        if ($this->capture_err())
            return $this->capture_err();
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "The budget limit already set by the staff.";
            return json_encode($resp);
            exit;
        }
        if (empty($budget_no)) {
            $sql = "INSERT INTO `budget_limit` set {$data} ";
            $save = $this->conn->query($sql);
        } else {
            $sql = "UPDATE `budget_limit` set {$data} where budget_no = '{$budget_no}' ";
            $save = $this->conn->query($sql);
        }
        if ($save) {
            $resp['status'] = 'success';
            if (empty($budget_no))
                $this->settings->set_flashdata('success', "New budget limit successfully saved.");
            else
                $this->settings->set_flashdata('success', "Budget limit successfully updated.");
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        return json_encode($resp);
    }

    function delete_budget() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `budget_limit` where budget_no = '{$budget_no}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Budget limit successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_pr() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (in_array($k, array('discount_amount', 'tax_amount')))
                $v = str_replace(',', '', $v);
            if (!in_array($k, array('id', 'pr_no')) && !is_array($_POST[$k])) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (!empty($pr_no)) {
            $check = $this->conn->query("SELECT * FROM `purchase_requisitions` where `pr_no` = '{$pr_no}' " . ($id > 0 ? " and id != '{$id}' " : ""))->num_rows;
            if ($this->capture_err())
                return $this->capture_err();
            if ($check > 0) {
                $resp['status'] = 'PR_failed';
                $resp['msg'] = "PR Number already exist.";
                return json_encode($resp);
                exit;
            }
        } else {
            $pr_no = "";
            while (true) {
                $pr_no = "20PR" . (sprintf("%'.011d", mt_rand(1, 99999999999)));
                $check = $this->conn->query("SELECT * FROM `purchase_requisitions` where `pr_no` = '{$pr_no}'")->num_rows;
                if ($check <= 0)
                    break;
            }
        }
        $data .= ",pr_no = '{$pr_no}' ";

        if (empty($id)) {
            $sql = "INSERT INTO `purchase_requisitions` set {$data} ";
        } else {
            $sql = "UPDATE `purchase_requisitions` set {$data} where id = '{$id}' ";
        }
        $save = $this->conn->query($sql);
        if ($save) {
            $resp['status'] = 'success';
            $pr_id = empty($id) ? $this->conn->insert_id : $id;
            $resp['id'] = $pr_id;
            $data = "";
            foreach ($item_id as $k => $v) {
                if (!empty($data))
                    $data .= ",";
                $data .= "('{$pr_id}','{$v}','{$unit_price[$k]}','{$qty[$k]}')";
            }
            if (!empty($data)) {
                $this->conn->query("DELETE FROM `purchase_requisitions_details` where pr_id= '{$pr_id}'");
                $save = $this->conn->query("INSERT INTO `purchase_requisitions_details` (`pr_id`,`item_id`,`unit_price`,`quantity`) VALUES {$data} ");
            }
            if (empty($id))
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
        $del = $this->conn->query("DELETE FROM `purchase_requisitions` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "PR successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_mr() {

        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (in_array($k, array('discount_amount', 'tax_amount')))
                $v = str_replace(',', '', $v);
            if (!in_array($k, array('id', 'mr_no')) && !is_array($_POST[$k])) {
                $v = addslashes(trim($v));
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (!empty($mr_no)) {
            $check = $this->conn->query("SELECT * FROM `materials_requisitions` where `mr_no` = '{$mr_no}' " . ($id > 0 ? " and id != '{$id}' " : ""))->num_rows;
            if ($this->capture_err())
                return $this->capture_err();
            if ($check > 0) {
                $resp['status'] = 'po_failed';
                $resp['msg'] = "MR Number already exist.";
                return json_encode($resp);
                exit;
            }
        } else {
            $mr_no = "";
            while (true) {
                $mr_no = "20MR" . (sprintf("%'.011d", mt_rand(1, 99999999999)));
                $check = $this->conn->query("SELECT * FROM `materials_requisitions` where `mr_no` = '{$mr_no}'")->num_rows;
                if ($check <= 0)
                    break;
            }
        }
        $data .= ", mr_no = '{$mr_no}' ";

        if (empty($id)) {
            $sql = "INSERT INTO `materials_requisitions` set {$data} ";
        } else {
            $sql = "UPDATE `materials_requisitions` set {$data} where id = '{$id}' ";
        }
        $save = $this->conn->query($sql);
        if ($save) {
            $resp['status'] = 'success';
            $mr_id = empty($id) ? $this->conn->insert_id : $id;
            $resp['id'] = $mr_id;
            $data = "";
            foreach ($item_id as $k => $v) {
                if (!empty($data))
                    $data .= ",";
                $data .= "('{$mr_id}','{$v}','{$unit_price[$k]}','{$qty[$k]}')";
            }
            if (!empty($data)) {
                $this->conn->query("DELETE FROM `materials_requisitions_details` where mr_id= '{$mr_id}'");
                $save = $this->conn->query("INSERT INTO `materials_requisitions_details` (`mr_id`,`item_id`,`unit_price`,`quantity`) VALUES {$data} ");
            }
            if (empty($id))
                $this->settings->set_flashdata('success', "MR successfully saved.");
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
        $del = $this->conn->query("DELETE FROM `materials_requisitions` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "MR successfully deleted.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
    case 'save_supplier':
        echo $Master->save_supplier();
        break;
    case 'delete_supplier':
        echo $Master->delete_supplier();
        break;
    case 'save_subcontractor':
        echo $Master->save_subcontractor();
        break;
    case 'delete_subcontractor':
        echo $Master->delete_subcontractor();
        break;
    case 'save_rfq':
        echo $Master->save_rfq();
        break;
    case 'save_con':
        echo $Master->save_con();
        break;
    case 'delete_rfq':
        echo $Master->delete_rfq();
        break;
    case 'delete_con':
        echo $Master->delete_con();
        break;
    case 'save_item':
        echo $Master->save_item();
        break;
    case 'delete_item':
        echo $Master->delete_item();
        break;
    case 'save_catalog':
        echo $Master->save_catalog();
        break;
    case 'delete_catalog':
        echo $Master->delete_catalog();
        break;
    case 'search_items':
        echo $Master->search_items();
        break;
    case 'search_pr':
        echo $Master->search_pr();
        break;
    case 'save_po':
        echo $Master->save_po();
        break;
    case 'delete_po':
        echo $Master->delete_po();
        break;
    case 'get_price':
        echo $Master->get_price();
        break;
    case 'save_rent':
        echo $Master->save_rent();
        break;
    case 'delete_rent':
        echo $Master->delete_rent();
        break;
    case 'renew_rent':
        echo $Master->renew_rent();
        break;
    case 'save_event':
        echo $Master->save_event();
        break;
    case 'delete_event':
        echo $Master->delete_event();
        break;
    case 'save_alert':
        echo $Master->save_alert();
        break;
    case 'delete_alert':
        echo $Master->delete_alert();
        break;
    case 'save_budget':
        echo $Master->save_budget();
        break;
    case 'delete_budget':
        echo $Master->delete_budget();
        break;
    case 'save_pr':
        echo $Master->save_pr();
        break;
    case 'delete_pr':
        echo $Master->delete_pr();
        break;
    case 'save_mr':
        echo $Master->save_mr();
        break;
    case 'delete_mr':
        echo $Master->delete_mr();
        break;
    case 'save_rating':
        echo $Master->save_rating();
        break;
    case 'search_rating':
        echo $Master->search_rating();
        break;
    default:
        // echo $sysset->index();
        break;
}

