<?php

/**
 * 
 */
class Model_api extends CI_Model
{
	public function update_inventory($data,$id_inventory){
   		$this->db->update('inventory', $data, ['id_inventory'=> $id_inventory]);
   		return $this->db->affected_rows();
    } 
    public function add_inventory($data){
   		$this->db->insert('inventory', $data);
   		return $this->db->affected_rows();
    } 
    public function delete_inventory($id_inventory){
    	$this->db->delete('inventory', ['id_inventory'=>$id_inventory]);
    	return $this->db->affected_rows();
    }
    public function add_customer($data){
    	$this->db->insert('customer',$data);
    	return $this->db->affected_rows();
    }
    public function update_customer($data,$id_customer){
    	$this->db->update('customer', $data, ['id_customer' => $id_customer]);
    	return $this->db->affected_rows();
    }
    public function delete_customer($id_customer){
    	$this->db->delete('customer',  ['id_customer'=>$id_customer]);
    	return $this->db->affected_rows();
    }
}