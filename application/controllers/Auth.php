<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * this class for authentification user logging
 */
class Auth extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('Mauth', 'mauth');
    $this->load->model('Mhome', 'mhome');
  }

  public function login(){

    // if we are already get session to login
    if ($this->session->userdata('isLogin') === TRUE) {
      redirect();

    // this is block for condition that we aren't get session to login
    } else {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('email', 'Email', 'required|callback_checkingEmail|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'required|callback_checkingPassword');
      // this is block for if our form validation running unseccessly
      if ($this->form_validation->run() === FALSE) {
        $this->load->view('include/header2');
        $this->load->view('login');
        $this->load->view('include/footer');

        // this block for giving session login if all the requiry is complete
      } else {
        $userType = $this->mauth->getData(array('email' => $this->input->post('email')),
          array('userTypeField' => 'user_type'), TRUE);
        $type = $userType->user_type;

        $userId = $this->mauth->getData(array('email' => $this->input->post('email')),
          array('userIdField' => 'user_id'), TRUE);
        $id = $userId->user_id;

        $newerId = $this->mauth->getData(array('email' => $this->input->post('email')),
          array('newerField' => 'newer'), TRUE);
        $newer = $newerId->newer;

        $data = array(
          'uId'     => $id,
          'uType'   => $type,
          'uNew'    => $newer, // store owner and admin
          'isLogin' => TRUE
        );
        $this->session->set_userdata($data);
        $hasCart = $this->cart->contents();
        if ($hasCart != NULL && $this->session->userdata('uType') == 4) {
          redirect('home/shopCart');
        } else {
          redirect();
        }
      }
    }
  }

  // this function for unset sessio
  public function logout(){
    // $this->session->unset_userdata('UId');
    // $this->session->unset_userdata('uType');
    $this->session->sess_destroy();
    redirect('home', 'refresh');
  }

  // this function for checking email
  public function checkingEmail($email){
    $user = $this->mauth->getData(array('email' => $email),
      array('usernameField' => 'email'), TRUE);

    if (isset($user)) {
      return TRUE;
    } else {
      $this->session->set_flashdata('error', 'Wrong email!');
    }
  }
  // this function for checking password
  public function checkingPassword($password){
    if($this->checkingEmail($this->input->post('email'))){
      $user = $this->mauth->getData(array('email' => $this->input->post('email')),
        array('passwordField' => 'password'), TRUE);

      if (password_verify($password, $user->password)) {
        return TRUE;
      } else {
        $this->session->set_flashdata('error', 'Wrong password!');
        return FALSE;
      }
    } else {
      $this->session->set_flashdata('error', 'Wrong email!');
    }
  }

  // public function inputDummyUser(){
  //   $this->mauth->createDummyUser();
  // }

  public function regis(){
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('uname', 'Username', 'required|callback_checkingUnameReg');
    $this->form_validation->set_rules('email', 'Email', 'required|callback_checkingEmailReg|valid_email');

    if ($this->session->userdata('uType') == 1) {
      $this->form_validation->set_rules('phone', 'Phone', 'required');
      $this->form_validation->set_rules('adminType', 'Admin Authority', 'required');

      if ($this->form_validation->run() === FALSE) {
        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('admin/register');
        $this->load->view('include/admin/footer');
      } else{
        $this->mauth->regis();
        redirect();
      }
    } elseif ($this->session->userdata('uType') == NULL) {
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required|matches[password]');
      $this->form_validation->set_rules('fname', 'First name', 'required');
      $this->form_validation->set_rules('lname', 'Last name', 'required');
      $this->form_validation->set_rules('gender', 'Gender', 'required');
      $this->form_validation->set_rules('phone', 'phone', 'required');
      $this->form_validation->set_rules('add', 'Address', 'required');
      // $this->form_validation->set_rules('province', 'Province', 'required');
      // $this->form_validation->set_rules('city', 'City', 'required');
      // $this->form_validation->set_rules('sub_district', 'Sub District', 'required');
      // $this->form_validation->set_rules('postcode', 'Postcode', 'required');
      $this->form_validation->set_rules('checkbox', 'Checkbox', 'required');

      if ($this->form_validation->run() === FALSE) {
        // $data['provinces'] = $this->mauth->getProducts(NULL, NULL, 'provinsi', FALSE);

        $this->load->view('include/header2');
        $this->load->view('register');
        $this->load->view('include/footer');
      } else {
        $this->mauth->regis();
        $this->session->set_flashdata('successmsg', 'Your account was successfully created');
        redirect('auth/login');
      }
    }
  }

  public function checkingUnameReg($username){
    $user = $this->mauth->getData(array('username' => $username),
      array('unameRegField' => 'username'), TRUE);

    if(isset($user)){
      $this->session->set_flashdata('error','Username has already been taken');
      return FALSE;
    }else{
      return TRUE;
    }
  }

  public function checkingEmailReg($email){
    if ($this->checkingUnameReg($this->input->post('uname'))) {
      $user = $this->mauth->getData(array('email' => $email),
        array('emailRegField' => 'email'), TRUE);

      if(isset($user)){
        $this->session->set_flashdata('error', 'Email has already been taken');
        return FALSE;
      }else{
        return TRUE;
      }
    }else {
      $this->session->set_flashdata('error', 'Username has already been taken');
      return FALSE;
    }
  }

  public function regisSO(){
    if ($this->session->userdata('uType') == 1 || $this->session->userdata('uType') == 2) {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('uname', 'Username', 'required|callback_checkingUnameReg');
      $this->form_validation->set_rules('email', 'Email', 'required|callback_checkingEmailReg|valid_email');
      $this->form_validation->set_rules('company_name', 'Company name', 'required');
      $this->form_validation->set_rules('add', 'Address', 'required');
      // $this->form_validation->set_rules('add2', 'Address 2', 'required');
      $this->form_validation->set_rules('province', 'Province', 'required');
      $this->form_validation->set_rules('city', 'City', 'required');
      $this->form_validation->set_rules('sub_district', 'Sub district', 'required');
      $this->form_validation->set_rules('pCode', 'Postcode', 'required');

      if($this->form_validation->run() === FALSE){
          $data['provinces'] = $this->mhome->getProducts(NULL, array('id_provField' => 'id_prov', 'nameProv' => 'nama'),
      'provinsi', FALSE);
        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('admin/registerSO', $data);
        $this->load->view('include/admin/footer');
      } else{
        $this->mauth->regisSO();
        redirect('admin/stores');
      }
    } else {
      $this->load->view('include/header2');
      $this->load->view('un-authorise');
      $this->load->view('include/footer');
    }
  }

  public function reset_password_profile(){
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_checkingForgotPass');

    if ($this->form_validation->run() === FALSE) {
      $this->load->view('include/header2');
      $this->load->view('forgot_pass');
      $this->load->view('include/footer');
    } else {
      $email = $this->input->post('email');
      $id_userlogin = $this->mauth->getProducts(array('email' => $email),
        array('idField' => 'user_id'), 'user_login', TRUE);
      $uniqueID = uniqid(rand(), TRUE);

      $data = array (
        'id_userLogin' => $id_userlogin['user_id'],
        'uniqueCode'   => $uniqueID,
      );
      $this->mauth->inputData('tm_forgot_pass', $data);
      $idForgot = $this->mauth->getProducts($data, array('idField' => 'id'),
        'tm_forgot_pass', TRUE);

      // print_r($data);echo "</br></br>";

      $message = $id_userlogin['user_id'].'/'.$uniqueID;

      $mail = array(
        'mail_to'       =>  $email,
        'mail_subject'  =>  'Forgot Password',
        'message'       =>  $message,
          'template'    =>  'forgot_pass'
      );
      $this->mauth->inputData('mail_queue', $mail);
      // print_r($mail);echo "</br></br>";
      $this->load->view('include/header2');
      $this->load->view('finishForgotPass');
      $this->load->view('include/footer');
    }
  }

  public function checkingForgotPass($email){
    $hasEmail = $this->mhome->getProducts(array('email' => $email),
      array('emailField' => 'email'), 'user_login', TRUE);

      if (isset($hasEmail)) {
        return TRUE;
      }else {
        $this->session->set_flashdata('error', 'Email tidak ada atau email belum terdaftar');
        return FALSE;
      }
  }

  public function changeForgotPass($idForgot, $uniqID){
    $check_data = array(
      'id_userLogin' => $idForgot,
      'uniqueCode'   => $uniqID
    );
    $checkForgot = $this->mauth->getProducts($check_data, NULL, 'tm_forgot_pass', TRUE);
    if (isset($checkForgot)) {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('pass', 'New Password', 'required');
      $this->form_validation->set_rules('repass', 'Re-type Password', 'required|matches[pass]');

      if ($this->form_validation->run() === TRUE) {
        $newPass = $this->input->post('pass');
        $new_password = password_hash(($newPass), PASSWORD_DEFAULT);
        $dataPass = array(
          'password' => $new_password
        );
        $this->mauth->updateData(array('user_id' => $idForgot), 'user_login', $dataPass);
        $this->mauth->deleteData(array('id' => $checkForgot['id']), 'tm_forgot_pass');
        redirect('auth/login');
      }else {
        $data['ForgotPass'] = array(
          'uniqID'    => $uniqID,
          'idForgot'  => $idForgot
        );
        $this->load->view('include/header2');
        $this->load->view('changeForgotPass', $data);
        $this->load->view('include/footer');
      }
    }else {
      $this->load->view('include/header2');
      $this->load->view('un-authorise');
      $this->load->view('include/footer');
    }
  }

  public function completing_profile()
  {
    $this->load->helper('form');
    $this->load->library('form_validation');

    if ($this->session->userdata('uType') == 1 || $this->session->userdata('uType') == 2) {
      $this->form_validation->set_rules('first_name', 'First Name', 'required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'required');
      $this->form_validation->set_rules('phone', 'Phone', 'required');
      $this->form_validation->set_rules('new_pass', 'Password', 'required');

      if ($this->form_validation->run() == FALSE) {
        $data['user'] = $this->mauth->getUData(array('id_userlogin' => $this->session->userdata('uId')),
          NULL, 'tm_super_admin', TRUE);

        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('new_user', $data);
        $this->load->view('include/admin/footer');
      } else{
      $data_admin = array(
        'first_name'=>$this->input->post('first_name'),
        'last_name'=>$this->input->post('last_name'),
        'phone'=>$this->input->post('phone')
      );
      $newer = array(
        'password'=>password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT),
        'newer'=>'0'
      );
      $this->mauth->updateData(array('id_userlogin' => $this->session->userdata('uId')), 'tm_super_admin', $data_admin);
      $this->mauth->updateData(array('user_id' => $this->session->userdata('uId')), 'user_login', $newer);
      $this->session->set_userdata('uNew','0');
      redirect();
      }
    } elseif ($this->session->userdata('uType') == 3) {
      $this->form_validation->set_rules('company_name', 'Company Name', 'required');
      $this->form_validation->set_rules('address', 'Address', 'required');
      $this->form_validation->set_rules('phone1', 'Phone Number 1', 'required');
      $this->form_validation->set_rules('postcode', 'Post Code', 'required');
      $this->form_validation->set_rules('province', 'Province', 'required');
      $this->form_validation->set_rules('city', 'City', 'required');
      $this->form_validation->set_rules('new_pass', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
      $data['user'] = $this->mauth->getUData(array('id_userlogin' => $this->session->userdata('uId')),
        NULL, 'tm_store_owner', TRUE);
        $data['provinces'] = $this->mauth->getProducts(NULL, NULL, 'provinsi', FALSE);


        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('new_user', $data);
        $this->load->view('include/admin/footer');
    } else {
      $data_store = array(
        'id_userlogin'  =>$this->session->userdata('uId'),
        'company_name'  =>$this->input->post('company_name'),
        'address'       =>$this->input->post('address'),
        'address2'      =>$this->input->post('address2'),
        'sub_district'  =>$this->input->post('sub_district'),
        'city'          =>$this->input->post('city'),
        'province'      =>$this->input->post('province'),
        'postcode'      =>$this->input->post('postcode'),
        'phone1'        =>$this->input->post('phone1'),
        'fax'           =>$this->input->post('fax')
      );
      $newer = array(
        'password'=>password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT),
        'newer'=>'0'
      );
      $this->mauth->updateData(array('id_userlogin' => $this->session->userdata('uId')), 'tm_store_owner', $data_store);
      $this->mauth->updateData(array('user_id' => $this->session->userdata('uId')), 'user_login', $newer);
      $this->session->set_userdata('uNew','0');
      redirect();
    }
   }
 }
}
// public function checkingNewPass(){
//   if (condition) {
//     // code...
//   }
// }

// public function coba(){
//   $read = $this->mauth->getData(array('username' => 'superAdmin'), array('emailField' => 'email'), TRUE);
//   print_r($read);
// }
