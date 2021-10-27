<?php
require_once('../config.php');
Class Users extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_con1(){
		extract($_POST);
		$data = '';
		$chk = $this->conn->query("SELECT * FROM `contract` where subcontract_ID ='{$subcontract_ID}' ".($id>0? " and id!= '{$id}' " : ""))->num_rows;
		if($chk > 0){
			return 3;
			exit;
		}
		foreach($_POST as $k => $v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if(isset($_FILES['file']) && $_FILES['file']['tmp_name'] != ''){
				$fname = 'uploads/'.strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['file']['tmp_name'],'../'. $fname);
				if($move){
					$data .=" , file = '{$fname}' ";
					if(isset($_SESSION['userdata']['file']) && is_file('../'.$_SESSION['userdata']['file']) && $_SESSION['userdata']['id'] == $id)
						unlink('../'.$_SESSION['userdata']['file']);
				}
		}
		if(empty($id)){
			$qry = $this->conn->query("INSERT INTO contract set {$data}");
			if($qry){
				$this->settings->set_flashdata('success','Contract successfully saved.');
				return 1;
			}else{
				return 2;
			}

		}else{
			$qry = $this->conn->query("UPDATE contract set $data where id = {$id}");
			if($qry){
				$this->settings->set_flashdata('success','Contract successfully updated.');
				foreach($_POST as $k => $v){
					if($k != 'id'){
						if(!empty($data)) $data .=" , ";
						$this->settings->set_userdata($k,$v);
					}
				}
				if(isset($id) && isset($move))
				$this->settings->set_userdata('file',$id);

				return 1;
			}else{
				return "UPDATE file set $data where id = {$id}";
			}
			
		}
	}
	public function delete_con(){
		extract($_POST);
		$avatar = $this->conn->query("SELECT file FROM contract where id = '{$id}'")->fetch_array()['file'];
		$qry = $this->conn->query("DELETE FROM contract where id = $id");
		if($qry){
			$this->settings->set_flashdata('success','Contract successfully deleted.');
			if(is_file(base_app.$avatar))
				unlink(base_app.$avatar);
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}
	public function save_con(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id'))){
				if(!empty($data)) $data .= ", ";
				$data .= " `{$k}` = '{$v}' ";
			}
		}
		
			if(isset($_FILES['file']) && $_FILES['file']['tmp_name'] != ''){
				$fname = 'uploads/'.strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['file']['tmp_name'],'../'. $fname);
				if($move){
					$data .=" , file = '{$id}' ";
					if(isset($_SESSION['userdata']['file']) && is_file('../'.$_SESSION['userdata']['file']))
						unlink('../'.$_SESSION['userdata']['file']);
				}
			}
			$sql = "UPDATE faculty set {$data} where id = $id";
			$save = $this->conn->query($sql);

			if($save){
			$this->settings->set_flashdata('success','Contract successfully updated.');
			foreach($_POST as $k => $v){
				if(!in_array($k,array('id'))){
					if(!empty($data)) $data .=" , ";
					$this->settings->set_userdata($k,$v);
				}
			}
			if(isset($id) && isset($move))
			$this->settings->set_userdata('file',$id);
			return 1;
			}else{
				$resp['error'] = $sql;
				return json_encode($resp);
			}

	} 

	public function save_con2(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id'))){
				if(!empty($data)) $data .= ", ";
				$data .= " `{$k}` = '{$v}' ";
			}
		}
		
			if(isset($_FILES['file']) && $_FILES['file']['tmp_name'] != ''){
				$fname = 'uploads/'.strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['file']['tmp_name'],'../'. $fname);
				if($move){
					$data .=" , file = '{$id}' ";
					if(isset($_SESSION['userdata']['file']) && is_file('../'.$_SESSION['userdata']['file']))
						unlink('../'.$_SESSION['userdata']['file']);
				}
			}
			$sql = "UPDATE faculty set {$data} where id = $id";
			$save = $this->conn->query($sql);

			if($save){
			$this->settings->set_flashdata('success','Contract successfully updated.');
			foreach($_POST as $k => $v){
				if(!in_array($k,array('id'))){
					if(!empty($data)) $data .=" , ";
					$this->settings->set_userdata($k,$v);
				}
			}
			if(isset($id) && isset($move))
			$this->settings->set_userdata('file',$id);
			return 1;
			}else{
				$resp['error'] = $sql;
				return json_encode($resp);
			}

	} 
}

$contract = new contract();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save_con':
		echo $contract->save_con();
	break;
	case 'save_con1':
		echo $contract->save_con1();
	break;
	case 'save_con2':
		echo $contract->save_con2();
	break;
	case 'delete':
		echo $contract->delete_con();
	break;
	default:
		// echo $sysset->index();
		break;
}