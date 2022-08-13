<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * this is class for home page
 *
 */
class Home extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('Mhome', 'mhome');
  }

  public function index($link = FALSE){
    $this->load->library('form_validation');
    if ($this->session->userdata('uType') == 1) {
      if ($this->session->userdata('uNew') == 1) {
        redirect('auth/completing_profile');
      }else{
          $this->load->view('include/admin/header');
          $this->load->view('include/admin/left-sidebar');
          $this->load->view('admin/home');
          $this->load->view('include/admin/footer');
      }
    } elseif ($this->session->userdata('uType') == 4) {
        $data['slides'] = $this->mhome->getProducts(array('cover' => 1), null, 'tm_cover', FALSE);
        
        $this->load->view('include/header');
        $this->load->view('home', $data);
        $this->load->view('include/footer');

    } elseif ($this->session->userdata('uType') == NULL) {

      $data['slides'] = $this->mhome->getProducts(array('cover' => 1), null, 'tm_cover', FALSE);
      
      $this->load->view('include/header');
      $this->load->view('home', $data);
      $this->load->view('include/footer');
    }
  }

  public function editProfile(){
    if ($this->session->userdata('uType') == 3) {
      $id = $this->session->userdata('uId');
      $data['post'] = $this->mhome->dataStores($id);
        $brands['brands'] = $this->mhome->getProducts(array('id !=' => 0, 'deleted' => 0, 'status' => 1), NULL, 'tm_brands', FALSE);

        $this->load->view('include/header', $brands);
      $this->load->view('edit_profile', $data);
      $this->load->view('include/footer');
    }else {
        $brands['brands'] = $this->mhome->getProducts(array('id !=' => 0, 'deleted' => 0, 'status' => 1), NULL, 'tm_brands', FALSE);

        $this->load->view('include/header', $brands);
      $this->load->view('un-authorise');
      $this->load->view('include/footer');
    }
  }

  public function searchResult(){
      $brands['brands'] = $this->mhome->getProducts(array('id !=' => 0, 'deleted' => 0, 'status' => 1), NULL, 'tm_brands', FALSE);

      $this->load->view('include/header2', $brands);
    $this->load->view('search-result');
    $this->load->view('include/footer');
  }

  public function pageLogin(){
      $brands['brands'] = $this->mhome->getProducts(array('id !=' => 0, 'deleted' => 0, 'status' => 1), NULL, 'tm_brands', FALSE);

      $this->load->view('include/header2', $brands);
    $this->load->view('login');
    $this->load->view('include/footer');
  }

  public function historyPage(){
      if ($this->session->userdata('uType') == 4) {
          $idCustomer = $this->session->userdata('uId');

          $data['orderList'] = $this->mhome->getOrderHistory($idCustomer);

//      print_r($data);

          $brands['brands'] = $this->mhome->getProducts(array('id !=' => 0, 'deleted' => 0, 'status' => 1), NULL, 'tm_brands', FALSE);

          $this->load->view('include/header2', $brands);
          $this->load->view('history-page', $data);
          $this->load->view('include/footer');
      } else {
          redirect('auth/login');
      }
  }

  public function transactionPage(){
    if ($this->session->userdata('uType') == 4) {
      $idCustomer = $this->session->userdata('uId');

      $data['orderList'] = $this->mhome->getOrderList($idCustomer);
      // print_r($data['orderList']);exit();

        // $brands['brands'] = $this->mhome->getProducts(array('id !=' => 0, 'deleted' => 0, 'status' => 1), NULL, 'tm_brands', FALSE);

        $this->load->view('include/header2');
      $this->load->view('transaction-page', $data);
      $this->load->view('include/footer');
    } else {
      redirect('auth/login');
    }
  }

  public function detail_transaction($orderNum){
    if ($this->session->userdata('uType') == 4) {
      // $idCustomer = $this->session->userdata('uId');
      // $ordr = $this->mhome->getProducts(array('order_number' => $orderNum), array('idF' => 'order_id'), 'tm_order', TRUE);
      // $idOrder = $ordr['order_id'];
      // $data['detailOrder'] = $this->mhome->detailOrder($idOrder, $idCustomer);

      // $this->load->view('include/header2');
      // $this->load->view('detail-transaction-page', $data);
      // $this->load->view('include/footer');

      $this->load->helper('form');
      $this->load->library('form_validation');

      // $this->form_validation->set_rules('items', 'Catalog', 'required');
      // $this->form_validation->set_rules('description', 'Description', 'required');

      if ($this->form_validation->run() === FALSE) {
        $idCustomer = $this->session->userdata('uId');
        $ordr = $this->mhome->getProducts(array('order_number' => $orderNum), array('idF' => 'order_id'), 'tm_order', TRUE);
        $idOrder = $ordr['order_id'];
        $data['detailOrder'] = $this->mhome->detailOrder($idOrder, $idCustomer);
        
        $this->load->view('include/header2');
        $this->load->view('detail-transaction-page', $data);
        $this->load->view('include/footer');
      } else {
        // if ($_FILES['catalog-pics']['size'] != 0) {
        
      }
    } else {
      redirect('auth/login');
    }

  }

  public function profilePage(){
    if ($this->session->userdata('uType') == 4) {
      $id_userlogin = $this->session->userdata('uId');
      $data['profile'] = $this->mhome->detailProfileCustomer($id_userlogin);

        // $brands['brands'] = $this->mhome->getProducts(array('id !=' => 0, 'deleted' => 0, 'status' => 1), NULL, 'tm_brands', FALSE);

        $this->load->view('include/header2');
      $this->load->view('page-profile', $data);
      $this->load->view('include/footer');
    } else {
      redirect();
    }
  }

  public function profileSetting($pass = NULL){
    if ($this->session->userdata('uType') == 4) {
      $this->load->helper('form');
      $this->load->library('form_validation');

      if ($pass == NULL) {
        $this->form_validation->set_rules('firstname', 'First name', 'required');
        $this->form_validation->set_rules('lastname', 'Last name', 'required');
        $this->form_validation->set_rules('phone', 'Phone number', 'required');

        if ($this->form_validation->run() === TRUE) {
          $id_userlogin = $this->session->userdata('uId');
          $profile = $this->mhome->getProducts(array('id_userlogin' => $id_userlogin, 'default_address' => 1), NULL, 'tm_customer_detail'
          , TRUE);
          $id_customerDetail = $profile['id'];
          print_r($profile);echo "</br></br>";
          $updateProfile = array(
            'id_userlogin'    =>  $id_userlogin,
            'first_name'      =>  $this->input->post('firstname'),
            'last_name'       =>  $this->input->post('lastname'),
            'gender'          =>  $profile['gender'],
            'phone'           =>  $this->input->post('phone'),
            'address'         =>  $this->input->post('address'),
            'default_address' =>  1,
          );
          print_r($updateProfile);
          $this->mhome->updateData(array('id' => $id_customerDetail), $updateProfile, 'tm_customer_detail');
          redirect('home/profilePage');
        }else{
          $id_userlogin = $this->session->userdata('uId');
          $data['profile'] = $this->mhome->getProducts(array('id_userlogin' => $id_userlogin, 'default_address' => 1), NULL, 'tm_customer_detail', TRUE);

          $this->load->view('include/header2');
          $this->load->view('page-profile-settings', $data);
          $this->load->view('include/footer');
        }
      } else {
        $this->form_validation->set_rules('current_password', 'Current Password',
          'required|callback_checkingCurrentPass');
        $this->form_validation->set_rules('password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Re-type New Password',
          'required|matches[password]');

        if ($this->form_validation->run() === TRUE) {
          $new_password = $this->input->post('password');
          $id_userlogin = $this->session->userdata('uId');
          $new_pass = array(
            'password' => password_hash($new_password, PASSWORD_DEFAULT)
          );
          print_r($new_pass);echo "</br></br>";
          print_r($id_userlogin);

          $this->mhome->updateData(array('user_id' => $id_userlogin), $new_pass, 'user_login');
          redirect('home/profilePage');
        }else{
          $id_userlogin = $this->session->userdata('uId');
          $data['profile'] = $this->mhome->getProducts(array('id_userlogin' => $id_userlogin, 'default_address' => 1), NULL, 'tm_customer_detail', TRUE);
          // $data['provinces'] = $this->mhome->getProducts(NULL, NULL, 'provinsi', FALSE);
          // $this->session->set_flashdata('error', validation_errors());

            // $brands['brands'] = $this->mhome->getProducts(array('id !=' => 0, 'deleted' => 0, 'status' => 1), NULL, 'tm_brands', FALSE);

          $this->load->view('include/header2');
          $this->load->view('page-profile-settings', $data);
          $this->load->view('include/footer');
        }
      }
    } else {
      redirect();
    }
  }

  public function checkingCurrentPass($current_password){
    $id_userlogin = $this->session->userdata('uId');
    $currentPass = $this->mhome->getProducts(array('user_id' => $id_userlogin),
    array('passwordField' => 'password'), 'user_login', TRUE);

    if (password_verify($current_password, $currentPass['password'])) {
      return TRUE;
    }else{
      $this->session->set_flashdata('error', 'Wrong Password');
      return FALSE;
    }
  }
  
  function search_keyword($brand = NULL, $category = NULL)
  {
      $keyword = $this->input->post('keyword');
      $data['products'] = $this->mhome->search($keyword);
      // $data['products'] = $this->mhome->getShop_product($brand, $category);
      $data['brand'] = $this->mhome->getProducts(array('id' => $brand), array('idField' => 'id','nameField' => 'name'), 'tm_brands', TRUE);
      $data['category'] = $this->mhome->brand_categories($brand);
      $data['bestSellers'] = $this->mhome->topthree_bestSeller();
      // $data['image'] = $this->mhome->getProducts(array('id_prod'=>$data['products']['id']), NULL, 'tr_product_image', TRUE);
      // print_r($data);
      // print_r($this->db->last_query());
      $this->load->view('include/header2');
      $this->load->view('search_result', $data);
      $this->load->view('include/footer');
  }

  public function page_order(){
    $this->load->helper('form');
    $this->load->library('form_validation');
    if ($this->session->userdata('uType') == 4) {
      $id_userlogin = $this->session->userdata('uId');
      $this->form_validation->set_rules('date', 'Date', 'required');
      $this->form_validation->set_rules('nama', 'Nama', 'required');
      $this->form_validation->set_rules('type', 'Type', 'required');

      if ($this->form_validation->run() === FALSE) {
        // $data['provinces'] = $this->mauth->getProducts(NULL, NULL, 'provinsi', FALSE);
        $data['catalogs'] = $this->mhome->getProducts(array('deleted' => 0, 'status' => 1), NULL,'tm_catalogs', FALSE);
        
        $this->load->view('include/header2');
        $this->load->view('page-order', $data);
        $this->load->view('include/footer');
      } else {
        $items = array(
            'order_number'  => 'ORD'.rand(10, 1000),
            'order_date'  => $this->input->post('date'),
            'nama'        => $this->input->post('nama'),
            'alamat'      => $this->input->post('alamat'),
            'price'       => $this->input->post('price'),
            'user_id'     => $id_userlogin,
            'cat_id'      => $this->input->post('type'),
            'type'        => $this->input->post('category'),
            'status'      => 0,
            'note'        => $this->input->post('note')
        );
        $this->mhome->inputData('tm_order', $items);
        $this->session->set_flashdata('successmsg', 'Your account was successfully created');
        redirect('home/transactionPage');
      }
    } else {
      redirect('auth/login');
    }
  }

  public function upload_payment()
  {
    $this->load->helper('form');
    $this->load->library('form_validation');
    if ($this->session->userdata('uType') == 4) {
      $config['upload_path'] = './asset/upload/';
      $config['max_size'] = 2000;
      $config['allowed_types'] = 'jpg|jpeg|png';

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('file')) {
          $this->_handle_upload_slide_error('destkop');
      }else{
          $pName = $this->upload->data();
          $items = array(
              'slide' => $pName['file_name']
          );
          dump($items);
          exit;
          // $this->mhome->updateData('tm_order', $items);
          // redirect('admin/sa_slider');
          // upload slide for modile version
          // $config['max_width'] = 400;
          // $config['max_height'] = 600;
          // $this->upload->initialize($config);
          // if (!$this->upload->do_upload('sliderPict-mobile')) {
          //     // delete previously uploaded desktop image
          //     $file_path = 'asset/upload/'.$pName['file_name'];
          //     if (file_exists($file_path)) {
          //         unlink($file_path);
          //     }
          //     $this->_handle_upload_slide_error('mobile');
          // } else {
              // $pNameMobile = $this->upload->data();
              // $coverIdentifier = 1;
              
          // }
      }
    } else {

    }
  }

  public function _handle_upload_slide_error($verison = '')
  {
      $data['error'] = '<p><strong>' . ucfirst($verison) . ' version:</strong></p>'
                  . $this->upload->display_errors('', '');
      $this->load->view('include/header2');
      $this->load->view('detail-transaction-page', $data);
      $this->load->view('include/footer');
  }

  public function list_catalog($id = null)
  {
    if (is_null($id)) {
        $data = $this->mhome->getProducts(array('deleted' => 0, 'status' => 1), NULL,'tm_catalogs', FALSE);
    } else {
        $data = $this->mhome->getProducts(array('deleted' => 0, 'id' => $id), NULL,'tm_catalogs', FALSE);
    }
    $this->output->set_content_type('application/json')
                ->set_output(json_encode($data));
  }
}
