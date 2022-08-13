<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * This Model for Store owner only
 */
class Mstore extends CI_Model{

  function __construct(){
    parent::__construct();

    $this->load->database();
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

  public function updateData($id, $data, $table){
    $this->db->where($id);
    $this->db->set($data);
    $this->db->update($table);
  }

  public function deletePedia($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('tm_agmpedia');
  }

  public function inputData($table, $items){
    return $this->db->insert($table, $items);
  }

  public function productAcceptStore($store_id){
    $this->db->select('b.name as product_name, f.name as brand, g.name as category,
     d.name as size_name, d.size as size_product, a.stock_awal, a.stock_akhir,
     a.inbound, a.outbound, a.postpone, a.id_product, a.id_store, a.id_product_size');
    $this->db->select_max('a.periode');
    $this->db->from('tr_product a');
    $this->db->join('tm_product b', 'b.id = a.id_product', 'left');
    $this->db->join('tr_product_size c', 'c.id = a.id_product_size', 'left');
    $this->db->join('tm_size d', 'd.id = c.size_id', 'left');
    $this->db->join('tm_brands f', 'b.brand_id = f.id', 'left');
    $this->db->join('tm_category g', 'b.cat_id = g.id', 'left');
    $this->db->group_by('a.id_product_size');
    $this->db->group_by('a.id');
    $this->db->group_by('a.periode');
    $where = array(
      'a.id_store'  =>  $store_id,
      'a.new'       => 1
    );
    $this->db->where($where);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function qtySpecial_Pkg($store_id, $prod_id){
    $this->db->select('a.quantity, b.name');
    $this->db->from('tr_product a');
    $this->db->join('tm_product b', 'b.id = a.id_product', 'left');
    $where = array(
      'a.id_store'    =>  $store_id,
      'a.id_product'  =>  $prod_id
    );
    $this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    }else {
      return FALSE;
    }
  }

  public function detailSpecialPackage($prod_id){
    $this->db->select('a.name, a.image, a.description, b.price');
    $this->db->from('tm_product a');
    $this->db->join('tr_product_size b', 'b.prod_id = a.id', 'left');
    $this->db->where('a.id', $prod_id);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    }else {
      return FALSE;
    }
  }

  public function prodSpecial_Pkg($prod_id){
    $this->db->select('a.quantity, c.name as prod, a.priceSpcl, c.image, d.name as sizeName, d.size as sizeDetail');
    $this->db->from('tr_special_package a');
    $this->db->join('tr_product_size b', 'b.id = a.size_spclPkg', 'left');
    $this->db->join('tm_product c', 'c.id = b.prod_id', 'left');
    $this->db->join('tm_size d', 'd.id = size_id', 'left');
    $this->db->where('a.id_prod_spclPkg', $prod_id);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }

  public function detailProd($idStore, $idPxrod){
    $this->db->select('*');
    $this->db->from('tm_product a');
    $this->db->join('tr_product b', 'b.id_product = a.id', 'left');
    $where = array('b.id_product' => $idProd,'b.id_store'=>$idStore, 'b.new'=>0);
    $this->db->where($where);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function detailProdBrand($idProd){
    $this->db->select('a.name as brand_name, c.name as cat_name');
    $this->db->from('tm_brands a');
    $this->db->join('tm_product b', 'b.brand_id = a.id', 'left');
    $this->db->join('tm_category c', 'c.id = b.cat_id', 'left');
    $where = array('b.id' => $idProd);
    $this->db->where($where);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function detailProdSpec($idProd){
    $this->db->select('a.name as spec_name');
    $this->db->from('tm_spec as a');
    $this->db->join('tr_product_spec b', 'b.spec_id = a.id', 'left');
    $where = array('b.prod_id' => $idProd);
    $this->db->where($where);
    $query = $this->db->get();

    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function order_list($idStore, $history = FALSE){
    $this->db->select('a.id, a.order_number, a.order_date, a.total, a.status_order, a.id_userlogin, b.first_name, b.last_name');
    $this->db->from('tm_order as a');
      $this->db->join('tr_order_detail aa', 'aa.id_tm_order = a.id');
    $this->db->join('tm_customer_detail as b', 'b.id = a.address_detail', 'left');
    $this->db->join('tr_product as c', 'c.id_product_size = aa.id_tr_Product', 'left');
    $this->db->group_by('a.order_number');
    $where = array('c.id_store' => $idStore);
    $this->db->where($where);
    if ($history) {
        $this->db->where("a.status_order = 1 or a.status_order = 3");
    } else {
        $this->db->where("a.status_order != 1 and a.status_order != 3");
    }
    $query = $this->db->get();

    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }
    public function getDetailOrder($idOrder, $idCustomer){
        $this->db->select('a.id, a.order_number, aa.quantity, a.id_userlogin, a.total, a.order_date, a.status_order, aa.id_tr_product, aa.subtotal, c.name, c.image, d.class, d.status,
      f.first_name, f.last_name, f.phone, f.address, f.postcode, g.nama as provinsi, h.nama as kabupaten, i.nama as kecamatan,
      k.name as size_name, k.size');

        $this->db->from('tm_order a');
        $this->db->join('tr_order_detail aa', 'aa.id_tm_order = a.id');
        $this->db->join('tr_product b', 'b.id_product_size = aa.id_tr_Product', 'left');
        $this->db->join('tm_product c', 'c.id = b.id_product', 'inner');
        $this->db->join('tm_status_order d', 'd.id = a.status_order', 'left');
        $this->db->join('tm_customer_detail f', 'f.id = a.address_detail', 'left');
        $this->db->join('provinsi g', 'g.id_prov = f.province', 'left');
        $this->db->join('kabupaten h', 'h.id_kab = f.city', 'left');
        $this->db->join('kecamatan i', 'i.id_kec = f.sub_district', 'left');
        $this->db->join('tr_product_size j', 'j.id = b.id_product_size', 'left');
        $this->db->join('tm_size k', 'k.id = j.size_id', 'left');
        $where = array('a.id' => $idOrder, 'a.id_userLogin' => $idCustomer);
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    public function detail_admin($idAdmin){
        $this->db->select('b.user_id, a.company_name, a.phone1, b.username, b.email, b.user_type');
        $this->db->from('tm_store_owner a');
        $this->db->join('user_login b', 'b.user_id = a.id_userlogin', 'left');
        $this->db->where('a.id_userlogin', $idAdmin);
        $query = $this->db->get();
        if($query->num_rows() != 0){
            return $query->row_array();
        }else{
            return FALSE;
        }
    }

}
