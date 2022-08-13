<?php defined('BASEPATH') or Exit('No direct script access allowed');
/**
 * this is class for authinfication
 */
class Mauth extends CI_Model{

  function __construct(){
    $this->load->database();
  }

  // public function createDummyUser(){
  //   $data = array(
  //     'username'      => 'admin',
  //     'password'      => password_hash('admin', PASSWORD_DEFAULT),
  //     'email'         => 'admin@keraton.com',
  //     'user_type'          => '2'
  //   );
  //   $this->db->insert('user_login',$data);
  // }

  public function getDataIndex($id = FALSE){
    if($this->session->userdata('uType') == 1){
      if($id === FALSE){
        $query = $this->db->get('tm_super_admin');
        return $query->result_array();
      }else{
        $query = $this->db->get_where('tm_super_admin', array('id' => $id));
        return $query->row_array();
      }
    } elseif ($this->session->userdata('uType') == 2) {
      if($id === FALSE){
        $query = $this->db->get('tm_store_owner');
        return $query->result_array();
      }else{
        $query = $this->db->get_where('tm_store_owner', array('id' => $id));
        return $query->row_array();
      }
    }
  }

  public function regisSO(){
    $uType = 3;
    $newOwner = 1;
    $pass = 'store_owner_agm';
    $created = $this->session->userdata('uId');
    $dataUserLogin = array(
      'username'      => $this->input->post('uname'),
      'password'      => password_hash(($pass), PASSWORD_DEFAULT),
      'email'         => $this->input->post('email'),
      'user_type'     => $uType,
      'newer'         => $newOwner,
      'created'       => $created
    );
    $queryULoging = $this->db->insert('user_login', $dataUserLogin);

    $userId = $this->getData(array('username' => $this->input->post('uname')),
      array('userIdField' => 'user_id'), TRUE);
    $id = $userId->user_id;

    $dataStoreOwner = array(
      'id_userLogin'    => $id,
      'company_name'    => $this->input->post('company_name'),
      'address'         => $this->input->post('add'),
      'address2'        => $this->input->post('add2'),
      'sub_district'    => $this->input->post('sub_district'),
      'city'            => $this->input->post('city'),
      'province'        => $this->input->post('province'),
      'latitude'        => $this->input->post('lat'),
      'longitude'      => $this->input->post('lng'),
      'postcode'        => $this->input->post('pCode'),
      'phone1'          => $this->input->post('phone1'),
      'fax'             => $this->input->post('fax'),
      'id_super_admin'  => $this->session->userdata('uId')
    );
    $queryStoreOwner = $this->db->insert('tm_store_owner', $dataStoreOwner);
    return array(
      'queryULoging'    => $queryULoging,
      'queryStoreOwner' => $queryStoreOwner
    );
  }

  public function getData($condition=NULL, $selection=NULL, $singleRowResult = FALSE){

    // if we are selecting some condition
    if ($condition != NULL) {
      foreach($condition as $key => $value){
        $this->db->where($key, $value);
      }
    }

    // if we are selection some fields
    if ($selection != NULL) {
      foreach ($selection as $key => $value) {
        $this->db->select($value);
      }
    }

    $query = $this->db->get('user_login');

    if ($singleRowResult === TRUE) {
      return $query->row();
    } else {
      return $query->result();
    }
  }

  public function regis(){
    if ($this->session->userdata('uType') == NULL) {
      $uType = 4;
      $newCS = 0;
      $dataUserLogin = array(
        'username'  => $this->input->post('uname'),
        'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'email'     => $this->input->post('email'),
        'user_type' => $uType,
        'newer'     => $newCS
      );

      $queryULoging = $this->db->insert('user_login', $dataUserLogin);

      $userId = $this->getData(array('username' => $this->input->post('uname'), 'email' => $this->input->post('email')),
        array('userIdField' => 'user_id'), TRUE);
      $id = $userId->user_id;
      $default_address = 1; // 1 = TRUE ; 0 = FALSE

      $dataCustomer_detail = array(
        'id_userLogin'    => $id,
        'first_name'      => $this->input->post('fname'),
        'last_name'       => $this->input->post('lname'),
        'gender'          => $this->input->post('gender'),
        'email'           => $this->input->post('email'),
        'phone'           => $this->input->post('phone'),
        'address'         => $this->input->post('add'),
        // 'province'        => $this->input->post('province'),
        // 'city'            => $this->input->post('city'),
        // 'sub_district'    => $this->input->post('sub_district'),
        // 'postcode'        => $this->input->post('postcode'),
        'default_address' => $default_address
      );

      $queryCustomer_detail = $this->db->insert('tm_customer_detail', $dataCustomer_detail);

      $dataCustomer = array(
          'id_userlogin'    => $id,
          'first_name'      => $this->input->post('fname'),
          'last_name'       => $this->input->post('lname'),
          'gender'          => $this->input->post('gender'),
          'phone'           => $this->input->post('phone'),
          'dateofbirth'     => $this->input->post('birthday')
      );

      $queryCustomer = $this->db->insert('tm_customer', $dataCustomer);

      return array(
        'queryULoging'  => $queryULoging,
        'queryCustomer' => $queryCustomer
      );
    } elseif($this->session->userdata('uType') == 2) {
        $uType = 3;
        $newOwner = 1;
        $pass = 'store_owner_agm';
        $created = $this->session->userdata('uId');
        $dataUserLogin = array(
          'username'      => $this->input->post('uname'),
          'password'      => password_hash(($pass), PASSWORD_DEFAULT),
          'email'         => $this->input->post('email'),
          'user_type'     => $uType,
          'newer'         => $newOwner,
          'created'       => $created
        );
        $queryULoging = $this->db->insert('user_login', $dataUserLogin);

        $userId = $this->getData(array('username' => $this->input->post('uname')),
          array('userIdField' => 'user_id'), TRUE);
        $id = $userId->user_id;

        $dataStoreOwner = array(
          'id_userLogin'    => $id,
          'company_name'    => $this->input->post('company_name'),
          'address'         => $this->input->post('add'),
          'sub_district'    => $this->input->post('sub_district'),
          'city'            => $this->input->post('sub_district'),
          'province'        => $this->input->post('province'),
          'postcode'        => $this->input->post('pCode'),
          'phone1'          => $this->input->post('phone1'),
          'phone2'          => $this->input->post('phone2'),
          'owner_name'      => $this->input->post('owner'),
          'id_super_admin'  => $this->session->userdata('uId')
        );
        $queryStoreOwner = $this->db->insert('tm_store_owner', $dataStoreOwner);
        return array(
          'queryULoging'    => $queryULoging,
          'queryStoreOwner' => $queryStoreOwner
        );
    } elseif($this->session->userdata('uType') == 1){
      $uType = $this->input->post('adminType');
      $newAdmin = 1;
      $pass = "admin_agm";
      $created = $this->session->userdata('uId');
      $dataUserLogin = array(
        'username'  => $this->input->post('uname'),
        'password'  => password_hash($pass, PASSWORD_DEFAULT),
        'email'     => $this->input->post('email'),
        'user_type' => $uType,
        'newer'     => $newAdmin,
        'created'   => $created
      );
      // print_r($pass);
      // echo "</br></br>";
      // print_r(password_hash($pass, PASSWORD_DEFAULT));
      // echo "</br></br>";
      // print_r($dataUserLogin);
      // exit();
      $queryULoging = $this->db->insert('user_login', $dataUserLogin);
      $userId = $this->getData(array('username' => $this->input->post('uname')),
        array('userIdField' => 'user_id'), TRUE);
      $id = $userId->user_id;

      $dataAdmin = array(
        'id_userLogin' => $id,
        'first_name'   => $this->input->post('fname'),
        'last_name'    => $this->input->post('lname'),
        'phone'        => $this->input->post('phone')
      );
      $queryAdmin = $this->db->insert('tm_super_admin', $dataAdmin);
      return array(
        'queryULoging' => $queryULoging,
        'queryAdmin'   => $queryAdmin
      );
    }
  }

  function forgotPass($email = NULL, $username = NULL){
    $dataUdatePassword = array(
      'password' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
    );

    if($email != NULL){
      foreach ($email as $key => $value) {
        $this->db->where($key, $value);
      }
    }

    if ($username != NULL) {
      foreach ($username as $key => $value) {
        $this->db->where($key, $value);
      }
    }

    return $this->db->update('user_login', $dataUdatePassword);
  }

  public function getUData($condition = NULL, $selection = NULL, $table, $singleRowResult =  FALSE){
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }

    if ($selection != NULL) {
      foreach ($selection as $key => $value) {
        $this->db->select($value);
      }
    }

    $query =  $this->db->get($table);

    if ($singleRowResult === TRUE) {
      return $query->row_array();
    }else {
      return $query->result_array();
    }
  }

  public function updateData($condition = NULL, $table, $items) {
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }
    return $this->db->update($table, $items);
  }

  public function getProducts($condition = NULL, $selection = NULL, $table, $singleRowResult =  FALSE){
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }

    if ($selection != NULL) {
      foreach ($selection as $key => $value) {
        $this->db->select($value);
      }
    }

    $query =  $this->db->get($table);

    if ($singleRowResult === TRUE) {
      return $query->row_array();
    }else {
      return $query->result_array();
    }
  }

  public function inputData($table, $items){
    return $this->db->insert($table, $items);
  }

  public function deleteData($condition = NULL, $table){
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }
    return $this->db->delete($table);
  }
}
