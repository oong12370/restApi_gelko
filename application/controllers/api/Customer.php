<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Customer extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_api');
  }


   function index_get() {

        $id_customer = $this->get('id_customer');
        if ($id_customer == '') {
            $customer = $this->db->get('customer')->result();
        } else {
            $this->db->where('id_customer', $id_customer);
            $customer = $this->db->get('customer')->result();
        }
        $this->response($customer, 200);
    }

    function index_post() {
      $password=$this->bcrypt->hash_password($this->input->post('password'));
       $data = [
                'id_customer'           => $this->post('id_customer'),
                'username'          => $this->post('username'),
                'name_customer'    => $this->post('name_customer'),
                'companycustomer'          => $this->post('companycustomer'),
                'addresscustomer'    => $this->post('addresscustomer'),
                'password'           => $password,
                'email'          => $this->post('email'),
                'telp'    => $this->post('telp'),
                'role'           => $this->post('role'),
                'aktivasi'          => $this->post('aktivasi')];

        if ($this->Model_api->add_customer($data) > 0){
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
        $password=$this->bcrypt->hash_password($this->put('password'));
        $id_customer = $this->put('id_customer');
        $data = [
                'username'          => $this->put('username'),
                'name_customer'    => $this->put('name_customer'),
                'companycustomer'          => $this->put('companycustomer'),
                'addresscustomer'    => $this->put('addresscustomer'),
                'password'           => $password,
                'email'          => $this->put('email'),
                'telp'    => $this->put('telp'),
                'role'           => $this->put('role'),
                'aktivasi'          => $this->put('aktivasi')];

       if ($this->Model_api->update_customer($data,$id_customer) > 0 ){
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
        $id_customer = $this->delete('id_customer');

        if ($id_customer === null){
          $this->response([
                  'status'=>false,
                  'massage'=> 'provide an id!'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
          if( $this->Model_api->delete_customer($id_customer) > 0){
            //ok
            $this->response([
            'status'=>true,
            'id_customer' => $id_customer,
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