<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_item extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->select('res_item.*')
				->select('res_category.category_name')
				->select('res_unit.unit_code')
				->join('res_category','res_item.category_id = res_category.category_id', 'left')
				->join('res_unit','res_item.unit_id = res_unit.unit_id', 'left')
				->where('res_item.is_deleted','0')
				->get('res_item',$number,$offset)
				->result();
		}else{
			return $this->db
				->select('res_item.*')
				->select('res_category.category_name')
				->select('res_unit.unit_code')
				->like('item_name',$search_term,'both')
				->join('res_category','res_item.category_id = res_category.category_id','left')
				->join('res_unit','res_item.unit_id = res_unit.unit_id','left')
				->where('res_item.is_deleted','0')
				->get('res_item',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_item')->result();
	}

  public function get_by_id($id)
  {
		$data = $this->db->where('item_id',$id)->get('res_item')->row();
		$data->package = $this->get_package($id);
    return $data;
  }

	public function get_package($item_id)
	{
		return $this->db->where('item_id',$item_id)->get('res_item_package')->result();
	}

  public function get_last()
  {
    return $this->db->order_by('item_id','desc')->get('res_item')->row();
  }

  public function delete($id)
  {
    $this->db->where('item_id',$id)->update('res_item',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_item')->num_rows();
		}else{
			return $this->db->like('item_name',$search_term,'both')->get('res_item')->num_rows();
		}
	}

	public function clear_package($item_id)
	{
		$this->db
			->where('item_id',$item_id)
			->delete('res_item_package');
	}

	public function insert_package($data)
	{
		$this->db
			->insert('res_item_package', $data);
	}

	// public function insert($data)
	// {
	// 	$this->db->insert('res_item',$data);
	// }

	// public function update($id,$data)
	// {
	// 	$this->db->where('item_id',$id)->update('res_item',$data);
	// }

	public function update()
	{
		$data = $_POST;
	    $item_id = $data['item_id'];
	    $client = $this->m_res_client->get_all();
	    $tax = $this->m_res_tax->get_by_id($data['tax_id']);

	    $data['updated_by'] = $this->session->userdata('user_realname');
	    if(!isset($data['is_active'])){
	      $data['is_active'] = 0;
	    }
	    
	    $item_price = price_to_num($data['item_price']);
	    if ($client->client_is_taxed == 0) {
	      $data['item_price_before_tax'] = $item_price;
	      $data['item_tax'] = ($tax->tax_ratio/100)*$item_price;
	      $data['item_price_after_tax'] = $data['item_price_before_tax']+$data['item_price_after_tax'];
	    }else{
	      $data['item_price_after_tax'] = $item_price;
	      $data['item_tax'] = ($tax->tax_ratio/(100+$tax->tax_ratio))*$data['item_price_after_tax'];
	      $data['item_price_before_tax'] = $data['item_price_after_tax']-$data['item_tax'];
	    }
	    // $data['tax_name'] = $tax->tax_name;
	    // $data['tax_ratio'] = $tax->tax_ratio;

	    $item_logo = $this->compress_image('item_logo');

	    if ($data['item_logo_input'] !='') {
	      if ($item_logo !='') {
	        $data['item_logo'] = $item_logo;
	      }else{
	        $data['item_logo'] = $data['item_logo_input'];
	      }
	    }elseif ($item_logo !='') {
	      $data['item_logo'] = $item_logo;
	    }

	    unset($data['item_price'], $data['item_logo_input']);
	    // clear package
	    $this->m_res_item->clear_package($item_id);
	    // insert package
	    if(isset($data['item_detail_id'])){
	      foreach ($data['item_detail_id'] as $key => $val) {
	        $data_package = null;
	        $data_package = array(
	          "item_id" => $item_id,
	          "item_detail_id" => $val,
	          "item_detail_price" => $data['item_detail_price'][$key]
	        );
	        $this->m_res_item->insert_package($data_package);
	      }
	    }

	    unset($data['item_detail_id'],$data['item_detail_price']);

		$this->db->where('item_id',$item_id)->update('res_item',$data);
	}

	public function insert()
	{
		$data = $_POST;
	    $client = $this->m_res_client->get_all();
	    $tax = $this->m_res_tax->get_by_id($data['tax_id']);

	    $last_id = $this->get_last();
	    if ($last_id == null) {
	      $item_id = 1;
	    }else{
	      $item_id = $last_id->item_id+1;
	    };

	    $data['created_by'] = $this->session->userdata('user_realname');
	    if(!isset($data['is_active'])){
	      $data['is_active'] = 0;
	    }

	    $item_price = price_to_num($data['item_price']);
	    if ($client->client_is_taxed == 0) {
	      $data['item_price_before_tax'] = $item_price;
	      $data['item_tax'] = ($tax->tax_ratio/100)*$item_price;
	      $data['item_price_after_tax'] = $data['item_price_before_tax']+$data['item_tax'];
	    }else{
	      $data['item_price_after_tax'] = $item_price;
	      $data['item_tax'] = ($tax->tax_ratio/(100+$tax->tax_ratio))*$data['item_price_after_tax'];
	      $data['item_price_before_tax'] = $data['item_price_after_tax']-$data['item_tax'];
	    }
	    // $data['tax_name'] = $tax->tax_name;
	    // $data['tax_ratio'] = $tax->tax_ratio;

	    $item_logo = $this->compress_image('item_logo');

	    if ($data['item_logo_input'] !='') {
	      if ($item_logo !='') {
	        $data['item_logo'] = $item_logo;
	      }else{
	        $data['item_logo'] = $data['item_logo_input'];
	      }
	    }elseif ($item_logo !='') {
	      $data['item_logo'] = $item_logo;
	    }

	    unset($data['item_price'], $data['item_logo_input']);

	    // clear package
	    $this->clear_package($item_id);
	    // insert package
	    if(isset($data['item_detail_id'])){
	      foreach ($data['item_detail_id'] as $key => $val) {
	        $data_package = null;
	        $data_package = array(
	          "item_id" => $item_id,
	          "item_detail_id" => $val,
	          "item_detail_price" => $data['item_detail_price'][$key]
	        );
	        $this->insert_package($data_package);
	      }
	    }

	    unset($data['item_detail_id'],$data['item_detail_price']);

		$this->db->insert('res_item',$data);
	}

	public function compress_image($src_file_name = null) {
	    // data tanggal
	    $this->load->library('upload');
	    $this->load->library('image_lib');

	    $config['upload_path'] = 'img/res_item/'; //path folder
	    $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan

	    $this->upload->initialize($config);
	    if(!empty($_FILES[$src_file_name]['name'])){
	        
	        if ($this->upload->do_upload($src_file_name)){
	            $gbr = array('upload_data' => $this->upload->data()); 
	            // cek resolusi gambar
	            $nama_gambar = 'img/res_item/'.$gbr['upload_data']['file_name'];
	            $data = getimagesize($nama_gambar);
	            $width_normal = $data[0];
	            $height_normal = $data[1];
	            // pembagian
	            // $bagi_width = $width / 4;
	            // $bagi_height = $height / 4;
	            //
	            $width_akhir = 100;
	            // $height_akhir = ($width_akhir / $width_normal) * $height_normal;
	            $height_akhir = 100;
	            //Compress Image
	            $config['image_library']='gd2';
	            $config['source_image'] = $gbr['upload_data']['full_path'];
	            $config['create_thumb']= FALSE;
	            $config['maintain_ratio']= FALSE;
	            $config['quality']= '100%';
	            $config['width']= $width_akhir;
	            $config['height']= $height_akhir;
	            $config['new_image']= 'img/res_item/'.$gbr['upload_data']['file_name'];
	            $this->image_lib->initialize($config);
	            // $this->load->library('image_lib', $config);
	            $this->image_lib->resize();
	            $this->image_lib->clear();

	            $item_logo=$gbr['upload_data']['file_name'];
	        }
	        //
	        return $item_logo;  
	    }           
	}

}
