<?php
class UserModel extends CI_Model {
    public function get(){
        $this->load->database();
    }

    public function hapus ($id){
        $this->load->database();
        $this->db->where('id', $id);
        return $this->db->delete('pegawai');
    }

    // public function ubah($data = array(), $id){
    //     $this->load->database();
    //     $this->db->where('id', $id); //where apabila id nya sesuai
    //     return $this->db->update('pegawai', $data); //update data
    // }

    // public function tambah($data) {
    //     $this->load->database();
    //     $this->db->insert('pegawai', $data); 
    // }

        // $this->load->database(); //memanggil database
        //     //select data
        //     $this->db->select("*");
        //     //short by descending
        //     $this->db->where("id",1);
        //     //ambil data tabel pegawai
        // $query = $this->db->get('pegawai');
        // return $query->result(); //menampilkan hasil

        // $this->load->database(); //memanggil database
        //     //select data
        //     $this->db->select("*");
        //     //short by descending
        //     $this->db->group_by("ALAMAT");
        //     //ambil data tabel pegawai
        // $query = $this->db->get('pegawai');
        // return $query->result(); //menampilkan hasil

        // $this->load->database(); //memanggil database
        //     //select data
        //     $this->db->select("*");
        //     //short by descending
        //     $this->db->limit(2,0);
        //     //ambil data tabel pegawai
        // $query = $this->db->get('pegawai');
        // return $query->result(); //menampilkan hasil

        // $this->load->database(); //memanggil database
        //     //select data
        //     $this->db->select("*");
        //     //short by descending
        //     $this->db->order_by("id","DESC");
        //     //ambil data tabel pegawai
        // $query = $this->db->get('pegawai');
        // return $query->result(); //menampilkan hasil

        // $this->load->database(); //memanggil database
        // //select data, menggunakan query
        // $query = $this->db->query('select*from pegawai');
        // return $query->result(); //untuk menampilkan hasil
    
}
?>