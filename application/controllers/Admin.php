<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->db=$this->load->database('default',true);
        if($this->session->userdata('user') == ''||$this->session->userdata('user') == NULL){
            echo '<script>alert("Tidak Dapat Diakses,Silahkan Login Dahulu");window.location.href = "'.base_url().'";</script>';
        }   
    }

    
	public function index()
	{
		$this->load->view('templates/site_tpl', array (
			'content' => 'admin_index',
            
			'data'=>$this->db->from('tb_apps')->where(array('is_deleted'=>'1'))->get()->result(),
		));
	}
    private function _form($aksi = 'tambah', $data = null)
	{
		if ($this->session->flashdata('data_form')) {
			$data = $this->session->flashdata('data_form');
		}
		
		$this->load->view('templates/site_tpl', array (
			'content' => 'admin_form',
			'url_aksi' => site_url("/admin/{$aksi}_data"),
			'data' => $data,
		));
	}
	public function tambah()
	{
		$this->_form();
	}

    public function ubah($id = '')
	{
		if ( ! $this->agent->referrer()) {
			show_404();
		}
		
		$src = $this->db
			->from('tb_apps')
			->where('is_deleted', '1')
			->get();
		
		if ($src->num_rows() == 0) {
			show_404();
		}
		
		$this->_form('ubah', $src->row());
	}

    private function _data_form()
	{
		$validasi = array (
			array (
				'field' => 'nama',
				'label' => 'Nama Aplikasi',
				'rules' => 'required',
			),
			array (
				'field' => 'alamat',
				'label' => 'Alamat URL',
				'rules' => 'required',
			),
			array (
				'field' => 'keterangan',
				'label' => 'Keterangan',
				'rules' => '',
			),
		);
		
		$this->form_validation->set_rules($validasi);
		
		if ($this->form_validation->run()) {
			
			$kunci_data = array (
				'nama',
				'alamat',
			);
			
			return data_post($kunci_data);
		}
		else {
			$this->session->set_flashdata('status_simpan', 'tidak_lengkap');
			$this->session->set_flashdata('validation_errors', validation_errors());
			$this->session->set_flashdata('data_form', (object) $this->input->post());
			return null;
		}
	}

    public function tambah_data(){
        $data = $this->_data_form();
        if ($data != null) {
            if(isset($_FILES['icon'])){

				$config['upload_path']          = './assets/img';
		        $config['allowed_types']        = 'jpg|png|PNG|JPG|jpeg|JPEG';
				$config['overwrite'] = TRUE;

		        $this->load->library('upload', $config);
				
		        $this->upload->initialize($config);

	        	$_FILES["file"]["name"] = $_FILES["icon"]["name"];
	        	$_FILES["file"]["type"] = $_FILES["icon"]["type"];
	        	$_FILES["file"]["tmp_name"] = $_FILES["icon"]["tmp_name"];
	        	$_FILES["file"]["error"] = $_FILES["icon"]["error"];
	        	$_FILES["file"]["size"] = $_FILES["icon"]["size"];

	        	if($this->upload->do_upload("file")){
	        		$upload_data = $this->upload->data();
                    $data['icon']=$upload_data['file_name'];
	        	}
                else{
                    $data['icon']="noimage.png";
                }
		    }
            $data['is_deleted']='1';
            $this->db->insert('tb_apps', $data);
			$this->session->set_flashdata('status_simpan', 'ok');
        }
        redirect(site_url('/admin/tambah'));
    }

    public function ubah_data(){
        $data = $this->_data_form();
        if ($data != null) {
            
            if(isset($_FILES['icon'])){

				$config['upload_path']          = './assets/img';
		        $config['allowed_types']        = 'jpg|png|PNG|JPG|jpeg|JPEG';
				$config['overwrite'] = TRUE;

		        $this->load->library('upload', $config);
				
		        $this->upload->initialize($config);

	        	$_FILES["file"]["name"] = $_FILES["icon"]["name"];
	        	$_FILES["file"]["type"] = $_FILES["icon"]["type"];
	        	$_FILES["file"]["tmp_name"] = $_FILES["icon"]["tmp_name"];
	        	$_FILES["file"]["error"] = $_FILES["icon"]["error"];
	        	$_FILES["file"]["size"] = $_FILES["icon"]["size"];

	        	if($this->upload->do_upload("file")){
	        		$upload_data = $this->upload->data();
                    $data['icon']=$upload_data['file_name'];
	        	}
                else{
                    $data['icon']="noimage.png";
                }
		    }
            $where = array('id' => $this->input->post('id'));
			$this->db->update('tb_apps', $data, $where);
            
			$this->session->set_flashdata('status_simpan', 'ok');
        }
        redirect(site_url('/admin'));
    }

    public function hapus($id){
        $where = array('id' => $id);
        $data=array(
            'is_deleted'=>'0'
        );
        $this->db->update('tb_apps', $data, $where);
        redirect(site_url('/admin'));
    }

    public function keluar(){
        $this->session->sess_destroy();
        echo'<script>window.location.href="'.base_url().'";</script>';
    }

    
}
