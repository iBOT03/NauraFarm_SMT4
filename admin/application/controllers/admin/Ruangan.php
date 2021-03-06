<?php

class Ruangan extends CI_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Model_Ruangan');
		belumlogin();
	}

	public function index() {
		$data['ruangan'] = $this->Model_Ruangan->index();
        $this->load->view("admin/ruangan/ruangan" , $data);
	}
	public function edit($id){
		$data['ruangan'] = $this->Model_Ruangan->detail($id);
		$this->form_validation->set_rules('namaruangan' , 'Nama Ruangan' , 'required');
		$this->form_validation->set_rules('kapasitasruangan' , 'Kapasitas Ruangan' , 'required');
		$this->form_validation->set_rules('deskripsiruangan' , 'Deskripsi Ruangan' , 'required');

		
		if ($this->form_validation->run() == false) {
			$this->load->view("admin/ruangan/editruangan" , $data);
		}else{
			$update = $this->Model_Ruangan->ubahdata(array(
				'NAMA_RUANGAN' => $this->input->post("namaruangan"),
				'KAPASITAS' => $this->input->post("kapasitasruangan"),
				'DESKRIPSI' => $this->input->post("deskripsiruangan")
			
			), $id);

		if($update){
			$ubahfoto = $_FILES['foto']['name'];

			if ($ubahfoto) {
				$config['allowed_types'] = 'jpg|png|gif';
				$config['max_size'] = '2048';
				$config['upload_path'] = './uploads/ruangan/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$user = $this->db->get_where('ruangan', ['ID_RUANGAN'=>$id])->row_array();
					$fotolama = $user['FOTO_RUANGAN'];
					if ($fotolama) {
						unlink(FCPATH . '/uploads/ruangan/' . $fotolama);
					}
					$fotobaru = $this->upload->data('file_name');
					$this->db->set('FOTO_RUANGAN', $fotobaru);
					$this->db->where('ID_RUANGAN', $id);
					$this->db->update('ruangan');
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">'
					. $this->upload->display_errors() .
					'</div>');
					// redirect('user/editprofile');
					redirect('admin/ruangan');
				}
			}
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
			Berhasil Mengubah Data!
			</div>');
			redirect('admin/ruangan');
		}else{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
			Gagal Mengubah Data!
			</div>');
			redirect('admin/ruangan');
		}
		

		}	
	}
	
	public function hapus($id){
		$hapusku = $this->Model_Ruangan->hapusdata($id);
		if($hapusku){
			$this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
						Data Berhasil Dihapus
			</div>');
			redirect('admin/ruangan');
		} else {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">
						Data Gagal Dihapus
			</div>');
			redirect('admin/ruangan');
		}
	}
	public function tambah(){
		$this->form_validation->set_rules('namaruangan', 'Nama Ruangan', 'required');
		$this->form_validation->set_rules('kapasitasruangan', 'Kapasitas Ruangan', 'required');
		$this->form_validation->set_rules('deskripsiruangan' , 'Deskripsi Ruangan' , 'required');
		
		if ($this->form_validation->run() == false) {
			$this->load->view("admin/ruangan/tambahruangan");
		} else {
			$foto =  $_FILES['foto']['name'];

			$config['allowed_types'] = 'jpg|png|gif|jpeg';
			$config['max_size'] = '2048';
			$config['upload_path'] = './uploads/ruangan';
		
			$this->load->library('upload' , $config);

			if($this->upload->do_upload('foto')){
				$data = array(
					'FOTO_RUANGAN' => $foto ,
					'NAMA_RUANGAN' => $this->input->post('namaruangan'),
					'KAPASITAS' => $this->input->post('kapasitasruangan'),
					'DESKRIPSI' => $this->input->post("deskripsiruangan")
					
				);
				if ($this->Model_Ruangan->insertdata($data)) {
					$this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">
					Data Berhasil Ditambahkan
				  </div>');
				  redirect('admin/ruangan');
				}else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">GAGAL</div>');
				  	redirect('admin/ruangan');
				}	
			}else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">'
					. $this->upload->display_errors() .
				  '</div>');
				  redirect('admin/ruangan');
			}

		}
		
	}
}

?>