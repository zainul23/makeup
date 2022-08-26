<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Super admin and admin controller
 */
class Madmin extends CI_Model {

  function __construct() {
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

  public function listProduct($filters = NULL){
    $this->db->select('a.id, a.slugs, c.name as brand_name, d.name as cat_name, a.name as product, a.stars, a.position');
    $this->db->from('tm_product a');
    $this->db->join('tr_product_size b', 'b.prod_id = a.id', 'left');
    $this->db->join('tm_brands c', 'c.id = a.brand_id', 'inner');
    $this->db->join('tm_category d', 'd.id = a.cat_id', 'inner');
    $this->db->where('a.brand_id !=', 0);
    $this->db->where('a.cat_id !=', 0);
      $this->db->where('a.deleted =', 0);
    $this->db->group_by('a.id');
    $this->db->order_by('a.id', 'desc');
      if ($filters != NULL) {
          foreach ($filters as $key => $value) {
              $this->db->where($key, $value);
          }
      }
    $query = $this->db->get();
    if($query->num_rows() != 0){
//        $this->db->flush_cache();
      return $query->result_array();
    }else{
//        $this->db->flush_cache();
      return FALSE;
    }
  }

    public function getDetailProduct($productId){
        $this->db->select('a.id, a.slugs, a.stars, a.position, c.id as brand_id, c.name as brand_name, d.id as cat_id, d.name as cat_name,
                            a.name as prod_name, a.description, b.id as item_id, b.price, b.sub_price, b.size_id, e.name as size_name, e.size');
        $this->db->from('tm_product a');
        $this->db->join('tr_product_size b', 'b.prod_id = a.id', 'left');
        $this->db->join('tm_brands c', 'c.id = a.brand_id', 'inner');
        $this->db->join('tm_category d', 'd.id = a.cat_id', 'inner');
        $this->db->join('tm_size e', 'e.id = b.size_id', 'inner');
        $this->db->order_by('a.id', 'desc');
        $this->db->where('a.id', $productId);
        $query = $this->db->get();
        if($query->num_rows() != 0){
//        $this->db->flush_cache();
            return $query->result();
        }else{
//        $this->db->flush_cache();
            return FALSE;
        }
    }

    public function getMainProd_SP(){
      $this->db->select('a.id_product as id, b.name');
      $this->db->from('tr_product a');
      $this->db->join('tm_product b', 'b.id =  a.id_product', 'left');
      $this->db->order_by('b.name', 'asc');
      $this->db->group_by('a.id_product');
      $query = $this->db->get();
      if ($query->num_rows() != 0) {
        return $query->result_array();
      }else {
        return FALSE;
      }
    }

    public function prodSP($idMainProd){
      $this->db->select('a.id_product as id, b.name');
      $this->db->from('tr_product a');
      $this->db->join('tm_product b', 'b.id = a.id_product', 'left');
      $this->db->order_by('b.name', 'asc');
      $this->db->group_by('a.id_product');
      $this->db->where('a.id_product !=', $idMainProd);
      $query = $this->db->get();
      if ($query->num_rows() != 0) {
        return $query->result_array();
      }else {
        return FALSE;
      }
    }

    public function getProductItem($itemId){
        $this->db->select('a.prod_id, a.size_id, a.price, a.sub_price, b.size, b.name');
        $this->db->from('tr_product_size a');
        $this->db->join('tm_size b', 'b.id = a.size_id', 'inner');
        $this->db->order_by('a.id', 'desc');
        $this->db->where('a.id', $itemId);
        $query = $this->db->get();
        if($query->num_rows() != 0){
//        $this->db->flush_cache();
            return $query->row_array();
        }else{
//        $this->db->flush_cache();
            return FALSE;
        }
    }

    public function getOrderList() {
      $query = $this->db->query("
        SELECT a.order_id, a.nama, a.alamat, a.note, a.picture, a.order_number, a.type, a.price, a.order_date, a.status 
        FROM tm_order a
          WHERE status IN ('0','1')
          GROUP BY a.order_id
          ORDER BY a.order_date DESC
		  ");
		  return $query->result_array();
    }

    public function getOrderHistory() {
      $query = $this->db->query("
        SELECT a.order_id, a.nama, a.alamat, a.note, a.picture, a.order_number, a.type, a.price, a.order_date, a.status 
        FROM tm_order a
          WHERE status NOT IN ('0','1')
          GROUP BY a.order_id
          ORDER BY a.order_date DESC
		  ");
		  return $query->result_array();
    }
  public function allProducts($condition = NULL, $selection = NULL, $table, $singleRowResult =  FALSE){
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

    $this->db->order_by("id", "desc");
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

  public function updateData($condition = NULL, $table, $items){
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }

    return $this->db->update($table, $items);
  }

  public function deleteData($condition = NULL, $table){
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }
    return $this->db->delete($table);
  }

  public function createItems($table){
    $id_creator = $this->session->userdata('uId');
    $items = array(
      'name'            => $this->input->post('items'),
      'id_super_admin'  => $id_creator
    );
    return $this->db->insert($table, $items);
  }

  public function getDataIndex($id = FALSE){
    if($id === FALSE){
      $query = $this->db->get('tm_store_owner');
      return $query->result_array();
    }else{
      $query = $this->db->get_where('tm_store_owner', array('id' => $id));
      return $query->row_array();
    }
  }

  public function dataPrime($id = NULL){
    $this->db->select(array('emailField' => 'email'));
    $query = $this->db->get_where('user_login', array('user_id' =>$id));
    return $query->row_array();
  }

  public function emailStore($idStore){
      $this->db->select('a.email');
      $this->db->from('user_login a');
      $this->db->join('tm_store_owner b', 'b.id_userlogin = a.user_id', 'left');
      $this->db->where('b.id', $idStore);
      $query = $this->db->get();
      if($query->num_rows() != 0){
      return $query->result_array();
      }else{
      return FALSE;
    }
  }

  public function joinStoreProd($store_id){
    $this->db->select('a.id, b.name as product_name, d.name as size_name, d.size
    , a.stock_awal, a.stock_akhir, a.inbound, a.outbound, a.postpone');
    $this->db->select_max('a.periode');
    $this->db->from('tr_product a');
    $this->db->join('tm_product b', 'b.id = a.id_product', 'left');
    $this->db->join('tr_product_size c', 'c.id = a.id_product_size', 'left');
    $this->db->join('tm_size d', 'd.id = c.size_id', 'left');
    $this->db->group_by('a.id');
    $this->db->where('a.id_store', $store_id);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function joinSizeProduct($prod_id){
      $this->db->select('b.id, a.name, a.size, b.price');
      $this->db->from('tm_size a');
      $this->db->join('tr_product_size b', 'b.size_id = a.id', 'left');
      $this->db->where('b.prod_id', $prod_id);
      $query = $this->db->get();
      if($query->num_rows() != 0){
          return $query->result_array();
      }else{
          return FALSE;
      }
  }

  public function joinStoreProv($store_id){
    $this->db->select('a.nama as province');
    $this->db->from('provinsi a');
    $this->db->join('tm_store_owner b', 'b.province = a.id_prov', 'left');
    $this->db->where('b.id', $store_id);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function jointStoreKab($store_id){
    $this->db->select('a.nama as city');
    $this->db->from('kabupaten a');
    $this->db->join('tm_store_owner b', 'b.city = a.id_kab', 'left');
    $this->db->where('b.id', $store_id);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function jointStoreKec($store_id){
    $this->db->select('a.nama as sub_district');
    $this->db->from('kecamatan a');
    $this->db->join('tm_store_owner b', 'b.sub_district = a.id_kec', 'left');
    $this->db->where('b.id', $store_id);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function joinDetailStore(){
      $this->db->select('b.company_name, a.username, a.email');
      $this->db->from('user_login a');
      $this->db->join('tm_store_owner b', 'b.id_userlogin = a.user_id', 'left');
      $this->db->where('a.user_type', 3);
      $query = $this->db->get();
      if($query->num_rows() != 0){
        return $query->result_array();
      }else{
        return FALSE;
    }
  }

  public function getSizeName($idSize){
      $this->db->select('a.name');
      $this->db->from('tm_size a');
      $this->db->join('tr_product_size b', 'b.size_id = a.id', 'left');
      $this->db->where('b.id', $idSize);
      $query = $this->db->get();
      if($query->num_rows() != 0){
        return $query->result_array();
      }else{
        return FALSE;
    }
  }

  public function getSizeNameProduct($idSize){
      $this->db->select('name, size');
      $this->db->where('id', $idSize);
      $query = $this->db->get('tm_size');
      return $query->row_array();
  }

  public function getProduct_orderBy($condition = NULL, $selection = NULL, $table, $orderby, $singleRowResult=FALSE){
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

    $this->db->group_by($orderby);
    $query =  $this->db->get($table);

    if ($singleRowResult === TRUE) {
      return $query->row_array();
    }else {
      return $query->result_array();
    }
  }

  public function detail_voucher($idVoucher){
    $this->db->select('b.name, b.image');
    $this->db->from('tr_bonus_voucher a');
    $this->db->join('tm_product b', 'b.id = a.bonus', 'left');
    $this->db->where('a.id_voucher', $idVoucher);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function detail_admin($idAdmin){
    $this->db->select('b.user_id, a.first_name, a.last_name, a.phone, b.username, b.email, b.user_type');
    $this->db->from('tm_super_admin a');
    $this->db->join('user_login b', 'b.user_id = a.id_userlogin', 'left');
    $this->db->where('a.id_userlogin', $idAdmin);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->row_array();
    }else{
      return FALSE;
    }
  }

  public function detailAddress_store($idStore){
    $this->db->select('a.city, a.province, b.nama as city_name, c.nama as prov_name');
    $this->db->from('tm_store_owner a');
    $this->db->join('kabupaten b', 'b.id_kab = a.city', 'left');
    $this->db->join('provinsi c', 'b.id_prov = a.province', 'left');
    $this->db->where('a.id', $idStore);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->row_array();
    }else{
      return FALSE;
    }
  }

  public function detailCluster($idStore){
    $this->db->select('a.id_store, a.sub_district, b.nama as prov_name, c.nama as city_name, d.nama as sub_name');
    $this->db->from('tr_store_owner_cluster a');
    $this->db->join('provinsi b', 'b.id_prov = a.province', 'left');
    $this->db->join('kabupaten c', 'c.id_kab = a.city', 'left');
    $this->db->join('kecamatan d', 'd.id_kec = a.sub_district', 'left');
    $this->db->where('a.id_store', $idStore);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function product_bed_linen(){
    $this->db->select('a.id, b.name, a.position');
    $this->db->from('tr_product_bed_linen a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->order_by('a.position', 'asc');
	  $this->db->where("b.deleted !=", 1);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function product_list(){
    $this->db->select('id, name');
    $this->db->from('tm_product');
    $this->db->order_by('name', 'asc');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }

  public function detail_prod_bed_linen($idBedLinen){
    $this->db->select('a.id, b.name, b.image, a.position');
    $this->db->from('tr_product_bed_linen a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->where('a.id', $idBedLinen);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
  }

  public function beddingAcc(){
    $this->db->select('a.id, b.name, a.position');
    $this->db->from('tr_product_bedding_acc a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->order_by('a.position', 'asc');
	  $this->db->where("b.deleted !=", 1);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function detail_prod_bedding_acc($idBeddingACC){
    $this->db->select('a.id, b.name, b.image, a.position');
    $this->db->from('tr_product_bedding_acc a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->where('a.id', $idBeddingACC);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
  }

  public function best_seller(){
    $this->db->select('a.id, b.name, a.position');
    $this->db->from('tr_product_best_seller a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->order_by('a.position', 'asc');
    $this->db->where("b.deleted !=", 1);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function detail_prod_best_seller($idBestSeller){
    $this->db->select('a.id, b.name, b.image, b.stars, a.position');
    $this->db->from('tr_product_best_seller a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->where('a.id', $idBestSeller);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
  }

  public function listReview(){
    $this->db->select('a.id, a.name as username, a.email, b.name, b.image, a.comment, a.date_attempt, a.stars, a.display');
    $this->db->from('tm_review a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->where('a.deleted', '0');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function specific_review($link){
    $this->db->select('a.id, a.name as username, a.email, b.name, c.image_1 as image, a.comment, a.date_attempt, a.stars, a.display');
    $this->db->from('tm_review a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->join('tr_product_image c', 'b.id = c.id_prod', 'left');
    $this->db->where('a.id', $link);
    $this->db->where('a.deleted', '0');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
  }

  public function listSubscriber(){
      return $this->db->get('tm_newsletter')->result_array();
  }


  public function product_size($idProduct){
    $this->db->select('a.id, b.name as sizeName, b.size as sizeDetail');
    $this->db->from('tr_product_size a');
    $this->db->join('tm_size b', 'b.id = a.size_id', 'left');
    $this->db->where('a.prod_id', $idProduct);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }

  public function checkprod_size($idProdSize){
    $this->db->select('b.name as prodName, c.name as sizeName, c.size as sizeDetail');
    $this->db->from('tr_product_size a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->join('tm_size c', 'c.id = a.size_id', 'left');
    $this->db->where('a.id', $idProdSize);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    }else {
      return FALSE;
    }
  }

  public function detail_specialPackage($idSpecialPckg){
    $this->db->select('a.id, a.id_prod_package, b.prod_id, a.quantity, a.subtotal, d.name as prod, c.name as sizeName, c.size as sizeDetail, d.image');
    $this->db->from('tr_special_package a');
    $this->db->join('tr_product_size b', 'b.id = a.id_prod_package', 'left');
    $this->db->join('tm_size c', 'c.id = b.size_id', 'left');
    $this->db->join('tm_product d', 'd.id = b.prod_id', 'left');
    $this->db->where('a.id_specialPkg', $idSpecialPckg);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }

  public function current_bonus($condition){
    $this->db->select('b.prod_id');
    $this->db->from('tr_special_package a');
    $this->db->join('tr_product_size b', 'b.id = a.id_prod_package', 'left');
    $this->db->where('a.id_specialPkg', $condition);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function add_bonus($where){
    $this->db->select('a.id_product, b.name');
    $this->db->from('tr_product a');
    $this->db->join('tm_product b', 'b.id = a.id_product', 'left');
    $this->db->group_by('a.id_product');
    foreach ($where as $key => $value) {
      $this->db->where('a.id_product !=', $value['prod_id']);
    }
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }

  public function prime_specialPKG($idSpecialPckg){
    $this->db->select('a.id, a.name, a.description, a.image, a.total, b.sku');
    $this->db->from('tm_special_package a');
    $this->db->join('tr_product_size b', 'b.special = a.id', 'left');
    $this->db->where('a.id', $idSpecialPckg);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    }else {
      return FALSE;
    }
  }

  public function maxPosition_BedLinen(){
    $this->db->select('MAX(position) as position');
    $this->db->from('tr_product_bed_linen');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    }else {
      return FALSE;
    }
  }

    public function maxPosition_BeddingAcc(){
      $this->db->select('MAX(position) as position');
      $this->db->from('tr_product_bedding_acc');
      $query = $this->db->get();
      if ($query->num_rows() != 0) {
        return $query->row_array();
      }else {
        return FALSE;
      }
    }

    public function maxPosition_BestSeller(){
      $this->db->select('MAX(position) as position');
      $this->db->from('tr_product_best_seller');
      $query = $this->db->get();
      if ($query->num_rows() != 0) {
        return $query->row_array();
      }else {
        return FALSE;
      }
    }

    public function sortingProduct_AscName(){
      $this->db->select('a.id, a.name');
      $this->db->from('tm_product a');
      $this->db->order_by('a.name', 'asc');
      $query = $this->db->get();
      if ($query->num_rows() != 0) {
        return $query->result_array();
      }else{
        return FALSE;
      }
    }

    public function listSpecialPackage(){
      $this->db->select('a.id, a.name, a.active');
      $this->db->select_min('b.price');
      $this->db->from('tm_special_package a');
      $this->db->join('tr_product_size b', 'b.prod_id = a.main_product', 'left');
      $this->db->order_by('a.id', 'desc');
      $this->db->group_by('a.main_product');
      $this->db->where('a.deleted', 0);
      $query = $this->db->get();
      if ($query->num_rows() != 0) {
        return $query->result_array();
      }else {
        return FALSE;
      }
    }


    public function order_list(){
        $this->db->select('a.id, a.order_number, a.total, a.order_date, a.status_order, d.company_name, c.id as id_trProd');
        $this->db->from('tm_order a');
        $this->db->join('tr_order_detail b', 'b.id_tm_order = a.id', 'left');
        $this->db->join('tr_product c', 'c.id = b.id_tr_Prod', 'left');
        $this->db->join('tm_store_owner d', 'd.id = c.id_store', 'left');
        $this->db->group_by('a.id');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
          return $query->result_array();
        }else {
          return FALSE;
        }
    }

    public function getDetailOrder($idOrder){
        $this->db->select('a.id, a.order_number, aa.quantity, a.id_userlogin, a.total, a.order_date, a.status_order, b.id as id_tr_product, aa.subtotal, c.name, c.image, d.class, d.status,
      f.first_name, f.last_name, f.phone, f.address, f.postcode, g.nama as provinsi, h.nama as kabupaten, i.nama as kecamatan,
      k.name as size_name, k.size, l.first_name, l.last_name');

        $this->db->from('tm_order a');
        $this->db->join('tr_order_detail aa', 'aa.id_tm_order = a.id');
        $this->db->join('tr_product b', 'b.id_product = aa.id_product and b.id_product_size = aa.id_tr_prod_size', 'left');
        $this->db->join('tm_product c', 'c.id = b.id_product', 'inner');
        $this->db->join('tm_status_order d', 'd.id = a.status_order', 'left');
        $this->db->join('tm_customer_detail f', 'f.id = a.address_detail', 'left');
        $this->db->join('provinsi g', 'g.id_prov = f.province', 'left');
        $this->db->join('kabupaten h', 'h.id_kab = f.city', 'left');
        $this->db->join('kecamatan i', 'i.id_kec = f.sub_district', 'left');
        $this->db->join('tr_product_size j', 'j.id = b.id_product_size', 'left');
        $this->db->join('tm_size k', 'k.id = j.size_id', 'left');
        $this->db->join('tm_customer l', 'l.id_userlogin = a.id_userlogin');
        $where = array('a.id' => $idOrder);
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function getProductImage($idProduct) {
        $this->db->select('a.image_1, a.image_2, a.image_3');
        $this->db->from('tr_product_image a');
        $this->db->join('tm_product b', 'a.id_prod = b.id', 'inner');
        $this->db->where('b.id', $idProduct);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function size_mainProd($id_mainProd){
      $this->db->select('b.id, c.name as sizeName, c.size as sizeDetail, b.price');
      $this->db->from('tm_product a');
      $this->db->join('tr_product_size b', 'b.prod_id = a.id', 'left');
      $this->db->join('tm_size c', 'c.id = b.size_id', 'left');
      $this->db->where('a.id', $id_mainProd);
      $query = $this->db->get();
      if ($query->num_rows() != 0) {
        return $query->result_array();
      }else {
        return FALSE;
      }
    }

    public function detailPromotion($slug){
      $this->db->select('a.id, a.name, a.slugs, a.description, a.image, a.start_date, a.end_date, a.status, b.kode_voucher, b.discount, b.jumlah');
      $this->db->from('tm_promotion a');
      $this->db->join('tm_voucher b', 'b.id_promotion = a.id', 'left');
      $this->db->where('a.slugs', $slug);
      $query = $this->db->get();
      if ($query->num_rows() != 0) {
        return $query->row_array();
      }else{
        return FALSE;
      }
    }
}
