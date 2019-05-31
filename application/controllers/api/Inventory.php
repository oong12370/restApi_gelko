<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Inventory extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_api');
	}

	
	 function index_get() {
        $id_inventory = $this->get('id_inventory');
        if ($id_inventory == '') {
            $inventory = $this->db->get('inventory')->result();
        } else {
            $this->db->where('id_inventory', $id_inventory);
            $inventory = $this->db->get('inventory')->result();
        }
        $this->response($inventory, 200);
    }

    function index_post() {
       $data = ['part_number'           => $this->post('part_number'),
                    'description'          => $this->post('description'),
                    'category'    => $this->post('category'),
                	'uom'           => $this->post('uom'),
                    'unit_cost'          => $this->post('unit_cost'),
                    'unit_price'    => $this->post('unit_price'),
                	'cndtion'           => $this->post('cndtion'),
                    'qty'          => $this->post('qty'),
                    'bacth'    => $this->post('bacth'),
                	'sn'           => $this->post('sn'),
                    'binloc'          => $this->post('binloc'),
                    'wh_code'    => $this->post('wh_code')];
        if ($this->Model_api->add_inventory($data) > 0){
        	$this->response([
       			'status'=>true,
       			'message'=> 'create success'
       			], REST_Controller::HTTP_CREATED);
        }else{
        	$this->response([
       			'status'=>false,
       			'message'=> 'create failed'
       			], REST_Controller::HTTP_CREATED);
        }
    }

    function index_put() {
        $id_inventory = $this->put('id_inventory');
        $data = ['part_number'           => $this->put('part_number'),
                    'description'          => $this->put('description'),
                    'category'    => $this->put('category'),
                	'uom'           => $this->put('uom'),
                    'unit_cost'          => $this->put('unit_cost'),
                    'unit_price'    => $this->put('unit_price'),
                	'cndtion'           => $this->put('cndtion'),
                    'qty'          => $this->put('qty'),
                    'bacth'    => $this->put('bacth'),
                	'sn'           => $this->put('sn'),
                    'binloc'          => $this->put('binloc'),
                    'wh_code'    => $this->put('wh_code')];
       if ($this->Model_api->update_inventory($data,$id_inventory) > 0 ){
       	$this->response([
       			'status'=>true,
       			'message'=> 'update success'
       			], REST_Controller::HTTP_CREATED);
       }else{
       	$this->response([
       			'status'=>false,
       			'message'=> 'update failed'
       			], REST_Controller::HTTP_BAD_REQUEST);
       }
    }

     function index_delete() {
        $id_inventory = $this->delete('id_inventory');

        if ($id_inventory === null){
        	$this->response([
        					'status'=>false,
        					'massage'=> 'provide an id!'
        				], REST_Controller::HTTP_BAD_REQUEST);
        }else{
        	if( $this->Model_api->delete_inventory($id_inventory) > 0){
        		//ok
        		$this->response([
       			'status'=>true,
       			'id_inventory' => $id_inventory,
       			'message'=> 'delete success'
       			], REST_Controller::HTTP_NO_CONTENT);
        	}else{
        		//not
        		$this->response([
        					'status'=>false,
        					'massage'=> 'delete failed!'
        				], REST_Controller::HTTP_BAD_REQUEST);
        	}
        }
      }
}