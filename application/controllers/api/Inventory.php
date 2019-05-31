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
        $data = array(
                    'part_number'           => $this->post('part_number'),
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
                    'wh_code'    => $this->post('wh_code'));
        $insert = $this->db->insert('inventory', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id_inventory = $this->put('id_inventory');
        $data = array('id_inventory'           => $this->post('id_inventory'),
                    'part_number'           => $this->post('part_number'),
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
                    'wh_code'    => $this->post('wh_code'));
        $this->db->where('id_inventory', $id_inventory);
        $update = $this->db->update('inventory', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

     function index_delete() {
        $id_inventory = $this->delete('id_inventory');
        $this->db->where('id_inventory', $id_inventory);
        $delete = $this->db->delete('inventory');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}