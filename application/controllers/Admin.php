<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	var $d;
	public function __construct(){
			parent::__construct();
			$this->d=array('page'=>'admin.php','title'=>'login');
            $this->load->model("Login_model");
            $this->load->model('Admins');

		}

	public function index(){
		$d=$this->d;
		$d['detail1']=$this->get_officer('general_officer');
		$d['detail2']=$this->get_officer('reporting_officer');
		$d['detail3']=$this->get_officer('reviewing_officer');
		$this->load->view('template1',$d);
		// //echo "hello";
		// echo json_encode($d['detail1']);
		// echo json_encode($d['detail2']);
	}
	public function get_officer($type){
		return $this->Admins->getprofile($type);
	}
	public function del(){
		$q=$this->Admins->del($_POST);
		
		
		
	}
	public function off_del(){
		$this->Admins->off_del($_POST);
	}
	public function rff_del(){
		$this->Admins->rff_del($_POST);
	}

	public function insert_gen(){
		$_POST['officer_type']='general_officer';
		$this->Admins->insert_officer($_POST);
	}
	public function insert_rep(){
		$_POST['officer_type']='reporting_officer';
		$this->Admins->insert_officer($_POST);
	}
	public function insert_rev(){
		$_POST['officer_type']='reviewing_officer';
		$this->Admins->insert_officer($_POST);
	}
	public function del2(){
		$q=$this->Admins->del2($_POST);
		// $this->session->set_flashdata('message','<p>'.$_POST['officer_id'] . ' has been deleted from the system' .$status.'</p>');
		
	}
	public function del3(){
		$q=$this->Admins->del3($_POST);
		
	}

	public function manage(){
		$d=$this->d;
		$d['page']='manage.php';
		$this->load->view('template1',$d);
	}

	public function add(){
		//
	}

	public function show(){
		//get only things from viewing page 'id' 
		//$q=array();
		$p=$this->Admins->show('reporting_officer','reporting-officer-id',$_POST['id']);
		for ($i=0;$i<count($p);$i++){
			$q[$i]=$p[$i]["id"];
		}
		echo json_encode($q);
		
	}
	public function show2(){
		//get only things from viewing page 'id' 
		//$q=array();
		//echo $_POST['id'];
		$p=$this->Admins->show('reviewing_officer','review_officer-id',$_POST['id']);
		for ($i=0;$i<count($p);$i++){
			$q[$i]=$p[$i]["reporting-officer-id"];
		}
		//var_dump($q);
		echo json_encode($q);
		
	}
	public function add_off(){
		$d['id']=$_POST['oid'];
		$d['reporting-officer-id']=$_POST['id'];
		$this->Admins->add_off($d);
	}
	public function add_rff(){
		$d['review_officer-id']=$_POST['id'];
		$d['reporting-officer-id']=$_POST['oid'];
		$this->Admins->add_rff($d);
	}
}


?>