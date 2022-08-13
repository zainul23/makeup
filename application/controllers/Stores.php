<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * This class for store owner only
 */
class Stores extends CI_Controller{

  function __construct(){
    parent::__construct();
      $params = array('server_key' => 'SB-Mid-server--tJLtZ_iEZ3G_oN_ixz3rtF3', 'production' => false);
      $this->load->library('midtrans');
      $this->midtrans->config($params);
    $this->load->helper('url');
    $this->load->model('Mstore', 'mstore');
    $this->load->model('Mhome', 'mhome');
  }

  public function confirmProduct($idStore, $idProd){
    if ($this->session->userdata('uType') == 3) {
      $condition = array(
        'id_product' => $idProd,
        'id_store'   => $this->session->userdata('idStore')
      );
      $accept = array(
        'new' => 0,
      );
      $this->mstore->updateData($condition, $accept, 'tr_product');
      redirect();
    } else {
      $this->load->view('include/header2');
      $this->load->view('un-authorise');
      $this->load->view('include/footer');
    }
  }

  public function storeProduct( $idProd = FALSE,$idStore = FALSE){
    if ($this->session->userdata('uType') == 3) {
      if ($idStore === FALSE && $idProd === FALSE) {

        $idStore = $this->mstore->getProducts(array('id_userlogin' =>
        $this->session->userdata('uId')), array('idField' => 'id'),
        'tm_store_owner', TRUE);
        $data['products'] = $this->mstore->productAcceptStore($idStore['id']);
        // print_r($this->db->last_query());exit();

        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('storeOwner/productStore', $data);
        $this->load->view('include/admin/footer');
      } else {
        $id = array('idStore' => $idStore, 'idProd' => $idProd);
        $data['id'] = $id;
        $data['product'] = $this->mstore->getProducts(array('id' => $idProd), NULL, 'tm_product', TRUE);
        $idBrand = $this->mstore->getProducts(array('id'=> $idProd), array('idBrand' => 'brand_id'), 'tm_product',
          TRUE);
        $idCat = $this->mstore->getProducts(array('id' => $idProd), array('idCat' => 'cat_id'), 'tm_product',
          TRUE);
        $idSize = $this->mstore->getProducts(array('prod_id' => $idProd), array('sizeId' => 'size_id'),
          'tr_product_size', TRUE);
        $idSpec = $this->mstore->getProducts(array('prod_id' => $idProd), array('specId' => 'spec_id'),
          'tr_product_spec', TRUE);
        $data['Qnt'] = $this->mstore->getProducts(array('id_product' => $idProd, 'id_store' => $idStore),
          array('quantityField' => 'quantity'), 'tr_product', TRUE);
        $data['brand'] = $this->mstore->getProducts(array('id' => $idBrand['brand_id']),
          array('nameBrand' => 'name'), 'tm_brands', TRUE);
        $data['cat'] = $this->mstore->getProducts(array('id' => $idCat['cat_id']),
          array('nameCat' => 'name'), 'tm_category', TRUE);
        $data['size'] = $this->mstore->getProducts(array('id' => $idSize['size_id']),
          array('nameField' => 'name', 'sizeField' => 'size'), 'tm_size', TRUE);
        $data['spec'] = $this->mstore->getProducts(array('id' => $idSpec['spec_id']),
          array('nameField' => 'name'), 'tm_spec', TRUE);

        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('storeOwner/detail_prodStore', $data);
        $this->load->view('include/admin/footer');
      }
    } else {
      $this->load->view('include/header2');
      $this->load->view('un-authorise');
      $this->load->view('include/footer');
    }
  }

  public function addQuantity($idStore, $idProd, $idProdSize){
    if ($this->session->userdata('uType') == 3) {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('ibound', 'Inbound', 'required');

      if ($this->form_validation->run() === FALSE) {
        $id = array('idStore' => $idStore, 'idProd' => $idProd, 'idProdSize' => $idProdSize);
        $data['id'] = $id;
        $data['product'] = $this->mstore->getProducts(array('id' => $idProd), NULL,
         'tm_product', TRUE);
        $data['quantity'] = $this->mstore->getProducts(array('id_store' => $idStore,
         'id_product' => $idProd, 'id_product_size' => $idProdSize),
         array('iBound' => 'inbound'),'tr_product', TRUE);
        // print_r($data);
        // exit();

        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('storeOwner/addQuantity', $data);
        $this->load->view('include/admin/footer');
      } else {
        $stAkhir = $this->mstore->getProducts(array('id_store' => $idStore, 'id_product' => $idProd,
         'id_product_size' => $idProdSize), array('skAkhir' => 'stock_akhir'), 'tr_product', TRUE);
        $ibound = $this->input->post('ibound');
        $update_stAkhir = $ibound + $stAkhir['stock_akhir'];
        $items = array(
          'inbound'     => $ibound,
          'stock_akhir' => $update_stAkhir
        );
        $condition = array(
          'id_store'        => $idStore,
          'id_product'      => $idProd,
          'id_product_size' => $idProdSize
        );
        $this->mstore->updateData($condition, $items, 'tr_product');

        $history_inbound = array(
          'id_prod_size'  => $idProdSize,
          'id_store'      => $idStore,
          'quantity'      => $ibound
        );
        $this->mstore->inputData('tr_stock', $history_inbound);
        redirect('stores/storeProduct');
      }
    } else {
      $this->load->view('include/header2');
      $this->load->view('un-authorise');
      $this->load->view('include/footer');
    }
  }

  public function addQuantity_SpecialPkg($idStore, $idProd){
    if ($this->session->userdata('uType') == 3) {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('quantity', 'Quantity', 'required');

      if ($this->form_validation->run() === FALSE) {
        $data['core'] = array('idStore' => $idStore, 'idProd' => $idProd);
        $data['qty'] = $this->mstore->qtySpecial_Pkg($idStore, $idProd);

        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('storeOwner/addQty_SpecialPkg', $data);
        $this->load->view('include/admin/footer');
      }else {
        $condition = array(
          'id_store'    =>  $idStore,
          'id_product'  =>  $idProd,
        );

        $addQuantity = array(
          'quantity'    =>  $this->input->post('quantity')
        );

        $this->mstore->updateData($condition, $addQuantity, 'tr_product');
        redirect('stores/storeProduct');
      }
    }else{
      $this->load->view('include/header2');
      $this->load->view('un-authorise');
      $this->load->view('include/footer');
    }
  }

  public function detailSpecialPackage($prod_id){
    if ($this->session->userdata('uType') == 3) {
      $data['detail_SpclPckg'] = $this->mstore->detailSpecialPackage($prod_id);
      $data['prod_SpclPckg'] = $this->mstore->prodSpecial_Pkg($prod_id);

      $this->load->view('include/admin/header');
      $this->load->view('include/admin/left-sidebar');
      $this->load->view('storeOwner/detail_specialPkg', $data);
      $this->load->view('include/admin/footer');
    }else {
      $this->load->view('include/header2');
      $this->load->view('un-authorise');
      $this->load->view('include/footer');
    }
  }

  public function updateTransactionStatus($idOrder, $idCustomer) {
      if ($this->session->userdata('uType') == 3) {
          $status = array('status_order' => $this->input->post('status'));
          $condition = array('id'=> $idOrder);
          $this->mstore->updateData($condition, $status, 'tm_order');
          if($this->input->post('status') == 3) {
              $this->orderCancellation($idOrder, $idCustomer);
          }
          redirect('stores/detailTransaction/'.$idOrder.'/'.$idCustomer);
      } else {
          $this->load->view('include/header2');
          $this->load->view('un-authorise');
          $this->load->view('include/footer');
      }
  }

  public function orderCancellation($idOrder, $idCustomer) {
      if ($this->session->userdata('uType') == 3) {
          $detailOrder = $this->mstore->getDetailOrder($idOrder, $idCustomer);
          $orderId = $detailOrder[0]->order_number;

          foreach ($detailOrder as $item) {
              $id = $item->id_tr_product;
              $qty = $item->quantity;
              $qtyStore = $this->mstore->getProducts(array('id' => $id), array('qty' => 'quantity'), 'tr_product', TRUE);
              $newQuanStore = $qtyStore['quantity'] + $qty;
              $quantity = array('quantity' => $newQuanStore);
              $this->mstore->updateData(array('id' => $id), $quantity, 'tr_product');
          }
          $this->midtrans->cancel($orderId);

      } else {
          $this->load->view('include/header2');
          $this->load->view('un-authorise');
          $this->load->view('include/footer');
      }
  }

  public function inbound() {
        $idStore = $this->mhome->getProducts(array('id_userlogin' => $this->session->userdata('uId')),
          array('idField' => 'id'), 'tm_store_owner', TRUE);
        $data['products'] = $this->mhome->joinStoreProd($idStore['id']);
        $id = array('idStore' => $idStore['id']);
        $this->session->set_userdata($id);

        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('storeOwner/myStore', $data);
        $this->load->view('include/admin/footer');
  }

  public function transaction(){
    if ($this->session->userdata('uType') == 3) {
      $idStore = $this->session->userdata('uId');
      $idStOwner = $this->mstore->getProducts(array('id_userlogin' => $idStore), array('idField' => 'id'), 'tm_store_owner', TRUE);
      $data['transactions'] = $this->mstore->order_list($idStOwner['id']);

      $this->load->view('include/admin/header');
      $this->load->view('include/admin/left-sidebar');
      $this->load->view('storeOwner/transaction', $data);
      $this->load->view('include/admin/footer');
    } else {
      $this->load->view('include/header2');
      $this->load->view('un-authorise');
      $this->load->view('include/footer');
    }

  }

    public function history(){
        if ($this->session->userdata('uType') == 3) {
            $idStore = $this->session->userdata('uId');
            $idStOwner = $this->mstore->getProducts(array('id_userlogin' => $idStore), array('idField' => 'id'), 'tm_store_owner', TRUE);
            $data['transactions'] = $this->mstore->order_list($idStOwner['id'], TRUE);

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('storeOwner/history-transaction', $data);
            $this->load->view('include/admin/footer');
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }

    }

  public function detailTransaction($idOrder, $idCustomer){
        $this->load->view('include/admin/header');
        $data['detailOrder'] = $this->mstore->getDetailOrder($idOrder, $idCustomer);
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('storeOwner/detail-transaction', $data);
        $this->load->view('include/admin/footer');
  }

    public function profile()
    {
        if ($this->session->userdata('uType') == 3) {
            $id = $this->session->userdata('uId');
            $data['detail_admin'] = $this->mstore->detail_admin($id);

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('storeOwner/profile', $data);
            $this->load->view('include/admin/footer');
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }
    public function changePassword()
    {
        if ($this->session->userdata('uType') == 3) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('current', 'Current password', 'required');
            $this->form_validation->set_rules('new', 'New password', 'required');
            $this->form_validation->set_rules('confirm', 'Confirm password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $this->load->model('Mauth', 'mauth');
                $id = $this->session->userdata('uId');
                $currentPassword = $this->input->post('current');
                $userData = $this->mauth->getData(array('user_id' => $id), array('password' => 'password'), TRUE);

                if (!password_verify($currentPassword, $userData->password)) {
                    $this->session->set_flashdata('error', 'Current password salah');
                    redirect('stores/changePassword');
                } else {
                    $newPassword = $this->input->post('new');
                    $confirmPassword = $this->input->post('confirm');
                    if ($confirmPassword === $newPassword) {
                        $data = array(
                            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
                        );
                        $this->mstore->updateData(array('user_id' => $id)    , $data, 'user_login');
//                        echo $this->db->last_query();
                        redirect('stores/profile');

                    } else {
                        $this->session->set_flashdata('error', 'Password yang diinput tidak sama');
                        redirect('stores/changePassword');
                    }
                }

            } else {
                $this->load->view('include/admin/header');
                $this->load->view('include/admin/left-sidebar');
                $this->load->view('storeOwner/changePassword');
                $this->load->view('include/admin/footer');
            }
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

}
