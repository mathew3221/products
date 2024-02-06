<?php defined('BASEPATH') or exit('No direct script access allowed');

class Productscontroller extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model('productsmodel');
    }


    function index()
    {
        $data = array();
        // $data['product']=$this->productsmodel->get_details();
        $this->load->view('productsview/productsview', $data);
    }


    function save_details()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'quantity' => $this->input->post('quantity'),
            'status' => 1
        );

        $result = $this->productsmodel->save_details($data);

        echo json_encode(array('status' => 'success'));
    }


    function get_product_list()
    {
        $data = array();
        $data['product'] = $this->productsmodel->get_details();
        $this->load->view('productsview/productslist', $data);
    }


    function get_product_info()
    {
        $data = array();
        $id = $_POST['id'];
        $data['product'] = $this->productsmodel->get_product_info($id);
        $this->load->view('productsview/productsinfo', $data);
    }

    function get_product_edit()
    {
        $data = array();
        $id = $_POST['id'];
        $data['product'] = $this->productsmodel->get_product_info($id);
        $this->load->view('productsview/productsedit', $data);
    }


    function update_details()
    {
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'quantity' => $this->input->post('quantity'),
            'status' => 1
        );
    
        if (empty($data['name']) || !is_numeric($data['price']) || !is_numeric($data['quantity']) || $data['price'] <= 0 || $data['quantity'] < 0) {
            echo json_encode(array('status' => 'error'));
            return;
        }
    
        $this->productsmodel->update_details($data, $id);
    
        echo json_encode(array('status' => 'success'));
    }


    function delete_details()
    {
        $id = $_POST['id'];
        return $this->productsmodel->delete_details($id);
    }
}
