<?php
require_once('../config.php');
Class MR extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	
	function add_mr(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('mr_ID','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}
		$check = $this->conn->query("SELECT * FROM `materials_requisition` where `type` = '{$type}' ".(!empty($id) ? " and mr_ID != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "The MR type already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `materials_requisition` set {$data} ";
		}else{
			$sql = "UPDATE `materials_requisition` set {$data} where mr_ID = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New MR successfully saved.");
			else
				$this->settings->set_flashdata('success',"MR successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_mr(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `materials_requisition` where mr_ID = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"MR successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function search_mr(){
		extract($_POST);
		$qry = $this->conn->query("SELECT * FROM materials_requisition where `type` LIKE '%{$q}%'");
		$data = array();
		while($row = $qry->fetch_assoc()){
			$data[] = array("label"=>$row['type'],"mr_ID"=>$row['mr_ID'],"description"=>$row['description']);
		}
		return json_encode($data);
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
	default:
		// echo $sysset->index();
		break;
}
