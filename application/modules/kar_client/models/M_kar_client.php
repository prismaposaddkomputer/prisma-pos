<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_client extends CI_Model {

	public function get_all()
	{
		return $this->db->get('kar_client')->row();
	}

  public function get_by_id($id)
  {
    return $this->db->where('client_id',$id)->get('kar_client')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('client_id','desc')->get('kar_client')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_client',$data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['client_id'];
    //
    if(!isset($data['client_keyboard_status'])){
      $data['client_keyboard_status'] = 0;
    }
    $data['updated_by'] = $this->session->userdata('user_realname');
    //
    // $customer_img = $_FILES['customer_img']['name'];
    // if ($customer_img != '') {
    //     $data_change['customer_img'] = $this->process_file('customer_img','customer',@$customer_id);
    // }
    //
    $data['client_logo'] = $this->compress_image('client_logo');
    //
    $this->db->where('client_id',$id)->update('kar_client',$data);
  }

  // public function update($id,$data)
  // {
  //   $this->db->where('client_id',$id)->update('kar_client',$data);
  // }

  public function delete($id)
  {
    $this->db->where('client_id',$id)->delete('kar_client');
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_client')->num_rows();
		}else{
			return $this->db->like('client_name',$search_term,'both')->get('kar_client')->num_rows();
		}
	}


  function compress_image($src_file_name = null) {
        // data tanggal
        $this->load->library('upload');
        $this->load->library('image_lib');

        $config['upload_path'] = 'img/'; //path folder
        $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
 
        $this->upload->initialize($config);
        if(!empty($_FILES[$src_file_name]['name'])){
            
            if ($this->upload->do_upload($src_file_name)){
                $gbr = array('upload_data' => $this->upload->data()); 
                // cek resolusi gambar
                $nama_gambar = 'img/'.$gbr['upload_data']['file_name'];
                $data = getimagesize($nama_gambar);
                $width_normal = $data[0];
                $height_normal = $data[1];
                // pembagian
                // $bagi_width = $width / 4;
                // $bagi_height = $height / 4;
                //
                $width_akhir = 300;
                // $height_akhir = ($width_akhir / $width_normal) * $height_normal;
                $height_akhir = 150;
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image'] = $gbr['upload_data']['full_path'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= $width_akhir;
                $config['height']= $height_akhir;
                $config['new_image']= 'img/'.$gbr['upload_data']['file_name'];
                $this->image_lib->initialize($config);
                // $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $this->image_lib->clear();
 
                $client_logo=$gbr['upload_data']['file_name'];
            }
            //
            return $client_logo;  
        }           
    }

}
