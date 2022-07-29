<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Apps extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->db=$this->load->database('default',true);
		
    }
	public function index()
	{
		$data=array(
			
		);
		$this->load->view('templates/site_utama', array (
			'content' => 'apps_index',
			'url_aksi'=>base_url().'apps/login',
			'data'=>$this->db->from('tb_apps')->where(array('is_deleted'=>'1'))->Order_by('urutan','asc')->get()->result(),
			
		));
	}
	public function login(){
        $user=$this->input->post('nama',true);
        $pass=$this->input->post('password',true);

        if($user=="fmm_apps" && $pass=="App5_FMM_01"){
            $sess = array(
                'user'=>$user,
            );
            $this->session->set_userdata($sess);
            redirect(base_url().'admin');
        }
    }
}
