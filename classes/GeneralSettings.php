<?php
if(!class_exists('DBConnection')){
	require_once('../config.php');
	require_once('DBConnection.php');
}
class GeneralSettings extends DBConnection{
	public function __construct(){
		parent::__construct();
	}
	function check_connection(){
		return($this->conn);
	}
	function load_general_setting(){
		// if(!isset($_SESSION['general_setting'])){
			$sql = "SELECT * FROM general_setting";
			$qry = $this->conn->query($sql);
				while($row = $qry->fetch_assoc()){
					$_SESSION['general_setting'][$row['meta_field']] = $row['meta_value'];
				}
		// }
	}
	function update_general_setting(){
		$sql = "SELECT * FROM general_setting";
		$qry = $this->conn->query($sql);
			while($row = $qry->fetch_assoc()){
				if(isset($_SESSION['general_setting'][$row['meta_field']]))unset($_SESSION['general_setting'][$row['meta_field']]);
				$_SESSION['general_setting'][$row['meta_field']] = $row['meta_value'];
			}
		return true;
	}
	function update_settings_info(){
            
            $data = "";
            foreach ($_POST as $key => $value) {
                    if(isset($_SESSION['general_setting'][$key])){
                            $value = str_replace("'", "&apos;", $value);
                            $qry = $this->conn->query("UPDATE general_setting set meta_value = '{$value}' where meta_field = '{$key}' ");
                    }else{
                            $qry = $this->conn->query("INSERT into general_setting set meta_value = '{$value}', meta_field = '{$key}' ");
                    }
            }
//	die();
            $update = $this->update_general_setting();
            $flash = $this->set_flashdata('success','General Setting Successfully Updated.');
//            if($update && $flash){
//                    // var_dump($_SESSION);
//                    return true;
//            }
	}
	function set_userdata($field='',$value=''){
		if(!empty($field) && !empty($value)){
			$_SESSION['userdata'][$field]= $value;
		}
	}
	function userdata($field = ''){
		if(!empty($field)){
			if(isset($_SESSION['userdata'][$field]))
				return $_SESSION['userdata'][$field];
			else
				return null;
		}else{
			return false;
		}
	}
	function set_flashdata($flash='',$value=''){
		if(!empty($flash) && !empty($value)){
			$_SESSION['flashdata'][$flash]= $value;
		return true;
		}
	}
	function chk_flashdata($flash = ''){
		if(isset($_SESSION['flashdata'][$flash])){
			return true;
		}else{
			return false;
		}
	}
	function flashdata($flash = ''){
		if(!empty($flash)){
			$_tmp = $_SESSION['flashdata'][$flash];
			unset($_SESSION['flashdata']);
			return $_tmp;
		}else{
			return false;
		}
	}
	function sess_des(){
		if(isset($_SESSION['userdata'])){
				unset($_SESSION['userdata']);
			return true;
		}
			return true;
	}
	function info($field=''){
		if(!empty($field)){
			if(isset($_SESSION['general_setting'][$field]))
				return $_SESSION['general_setting'][$field];
			else
				return false;
		}else{
			return false;
		}
	}
	function set_info($field='',$value=''){
		if(!empty($field) && !empty($value)){
			$_SESSION['general_setting'][$field] = $value;
		}
	}
}
$_settings = new GeneralSettings();
$_settings->load_general_setting();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new GeneralSettings();
switch ($action) {
	case 'update_settings':
		echo $sysset->update_settings_info();
		break;
	default:
		// echo $sysset->index();
		break;
}
?>