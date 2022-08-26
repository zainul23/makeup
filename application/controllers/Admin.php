<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Super admin and admin controller
 */
class Admin extends CI_Controller {

    function __construct(){
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Madmin', 'madmin');
    }

    public function list_type(){
        if ($this->session->userdata('uType') == 1) {
            $data['sizes'] = $this->madmin->getProducts(array('deleted' => 0), NULL,'tm_size', FALSE);

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('admin/list-type', $data);
            $this->load->view('include/admin/footer');
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }

    }

    public function addSize(){
        if ($this->session->userdata('uType') == 1) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Size name', 'required|callback_checkingSizeName');
            $this->form_validation->set_rules('size', 'Size', 'required|callback_checkingSize');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('include/admin/header');
                $this->load->view('include/admin/left-sidebar');
                $this->load->view('admin/addSize');
                $this->load->view('include/admin/footer');
            }else{
                $items = array(
                    'name'       => $this->input->post('name'),
                    'size'       => $this->input->post('size'),
                    'created_at' => date('Ymd'),
                    'status'     => 1
                );
                $this->madmin->inputData('tm_size', $items);
                redirect('admin/sa_size');
            }
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function checkingSizeName($name){
        $sizeName = $this->madmin->getProducts(array('name' => $name), array('nameField' => 'name'), 'tm_size', TRUE);

        if (isset($sizeName)) {
            $this->form_validation->set_message('checkingSizeName', 'Size name has already been created');
            // $this->session->set_flashdata('error', 'Size name has already been created');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function checkingSize($size){
        if ($this->checkingSizeName($this->input->post('name'))) {
            $size = $this->madmin->getProducts(array('size' => $size), array('sizeField' => 'size'), 'tm_size', TRUE);
            if (isset($size)) {
                $this->form_validation->set_message('checkingSize', 'Size has already been created');
                // $this->session->set_flashdata('error', 'Size has already been created');
                return FALSE;
            }else{
                return TRUE;
            }
        }else{
            $this->form_validation->set_message('checkingSize', 'Size name has already been created');
            // $this->session->set_flashdata('error', 'Size name has already been created');
            return FALSE;
        }
    }

    public function deleteSize($sizeId){
        if ($this->session->userdata('uType') == 1) {
            $this->madmin->updateData(array('id' => $sizeId), 'tm_size', array('deleted' => 1));
            redirect('admin/sa_size');
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function infoSize($idSize){
        if ($this->session->userdata('uType') == 1) {
        $data['size'] = $this->madmin->getProducts(array('id' => $idSize), NULL, 'tm_size', TRUE);

        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('admin/detail_size', $data);
        $this->load->view('include/admin/footer');
        }else {
        $this->load->view('include/header2');
        $this->load->view('un-authorise');
        $this->load->view('include/footer');
        }
    }

    public function editSize($idSize){
        if ($this->session->userdata('uType') == 1) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('items', 'Size Name', 'required');
        $this->form_validation->set_rules('size', 'Size', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['size'] = $this->madmin->getProducts(array('id' => $idSize), NULL, 'tm_size', TRUE);

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('admin/editSize', $data);
            $this->load->view('include/admin/footer');
        }else {
            $items = array(
                'name'          => $this->input->post('items'),
                'size'   => $this->input->post('size'),
                'status' => 1,
            );
            $this->madmin->updateData(array('id' => $idSize), 'tm_size', $items);
            redirect('admin/sa_size', 'refresh');
        }
        }else {
        $this->load->view('include/header2');
        $this->load->view('un-authorise');
        $this->load->view('include/footer');
        }
    }

    public function list_catalog(){
        if ($this->session->userdata('uType') == 1) {
            $data['catalogs'] = $this->madmin->getProducts(array('id !=' => 0, 'deleted' => 0), NULL, 'tm_catalogs', FALSE);

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('admin/list-catalog', $data);
            $this->load->view('include/admin/footer');

        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function list_data_catalog(){
        if ($this->session->userdata('uType') == 1) {
            $data['catalogs'] = $this->madmin->getProducts(array('id !=' => 0), NULL, 'catalog_data', FALSE);

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('admin/list-data-catalog', $data);
            $this->load->view('include/admin/footer');

        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }


    public function info_catalog($slugs_catalog){
      if ($this->session->userdata('uType') == 1) {
        $data['catalog'] = $this->madmin->getProducts(array('slugs' => $slugs_catalog), NULL, 'tm_catalogs', TRUE);

        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('admin/detail-catalog', $data);
        $this->load->view('include/admin/footer');
      }else {
        $this->load->view('include/header2');
        $this->load->view('un-authorise');
        $this->load->view('include/footer');
      }
    }

    public function add_catalog(){
        if ($this->session->userdata('uType') == 1) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('items', 'Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() == TRUE) {
                $file_name = strtolower('catalog-logo-'.$this->input->post('items'));

                $config['upload_path'] = './asset/brands/';
                $config['allowed_types'] = 'jpg|jpeg|png|svg';
                $config['file_name']  = $file_name;

                $this->load->library('upload', $config);
                if (! $this->upload->do_upload('catalog-pics')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());

                    $this->load->view('include/admin/header');
                    $this->load->view('include/admin/left-sidebar');
                    $this->load->view('admin/add-catalog');
                    $this->load->view('include/admin/footer');
                }else{
                    $pName = $this->upload->data();
                    $slugs = str_replace(' ', '-', strtolower($this->input->post('items')));
                    $items = array(
                        'name'          => $this->input->post('items'),
                        'price'         => $this->input->post('price'),
                        'quota'         => $this->input->post('quota'),
                        'slugs'         => $slugs,
                        'logo'          => $pName['orig_name'],
                        'description'   => $this->input->post('description'),
                        'status' => 1,
                    );
                    $this->madmin->inputData('tm_catalogs', $items);
                    redirect('admin/list_catalog');
                }
            }else{
                $this->load->view('include/admin/header');
                $this->load->view('include/admin/left-sidebar');
                $this->load->view('admin/add-catalog');
                $this->load->view('include/admin/footer');
            }
        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function data_catalog(){
        if ($this->session->userdata('uType') == 1) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('items', 'Name', 'required');

            if ($this->form_validation->run() == TRUE) {
                $file_name = strtolower('catalog-logo-'.rand(10,100));

                $config['upload_path'] = './asset/brands/';
                $config['allowed_types'] = 'jpg|jpeg|png|svg';
                $config['file_name']  = $file_name;

                $this->load->library('upload', $config);
                if (! $this->upload->do_upload('catalog-pics')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());

                    $this->load->view('include/admin/header');
                    $this->load->view('include/admin/left-sidebar');
                    $this->load->view('admin/data-catalog');
                    $this->load->view('include/admin/footer');
                }else{
                    $pName = $this->upload->data();
                    $slugs = str_replace(' ', '-', strtolower($this->input->post('items')));
                    $items = array(
                        'title'          => $this->input->post('items'),
                        'price'         => $this->input->post('price'),
                        'cat_id'         => $this->input->post('cat_id'),
                        'type'         => $this->input->post('category'),
                        'picture'          => $pName['orig_name'],
                    );
                    $this->madmin->inputData('catalog_data', $items);
                    redirect('admin/list_data_catalog');
                }
            }else{
                $this->load->view('include/admin/header');
                $this->load->view('include/admin/left-sidebar');
                $this->load->view('admin/data-catalog');
                $this->load->view('include/admin/footer');
            }
        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function checkingCatalog($catalog){
        $has_catalog = $this->madmin->getProducts(array('name' => $catalog),
            array('nameField' => 'name'), 'tm_catalogs', TRUE);
        if(isset($has_catalog)){
            $this->form_validation->set_message('checkingCatalog', 'Brand has already been created');
            // $this->session->set_flashdata('error', 'Brand has already been created');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function active_catalog($catalogSlugs){
        if($this->session->userdata('uType') == 1){
            $stat = $this->madmin->getProducts(array('slugs' => $catalogSlugs), array('statField' => 'status'), 'tm_catalogs',TRUE);
            if($stat['status'] == 1){
                $items = array('status' => 0);
                $this->madmin->updateData(array('slugs' => $catalogSlugs), 'tm_catalogs', $items);
                redirect('admin/list_catalog', 'refresh');
            }else{
                $items = array('status' => 1);
                $this->madmin->updateData(array('slugs' => $catalogSlugs), 'tm_catalogs', $items);
                redirect('admin/list_catalog', 'refresh');
            }
        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function delete_catalog($catalogSlugs){
        if ($this->session->userdata('uType') == 1) {
            $this->madmin->updateData(array('slugs' => $catalogSlugs), 'tm_catalogs', array('deleted' => 1));
            redirect('admin/list_catalog', 'refresh');
        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function delete_data_catalog($id){
        if ($this->session->userdata('uType') == 1) {
            $this->madmin->deleteData(array('id' => $id), 'catalog_data');
            redirect('admin/list_data_catalog', 'refresh');
        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function edit_catalog($slugsCatalog){
        if ($this->session->userdata('uType') == 1) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('items', 'Catalog', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['catalog'] = $this->madmin->getProducts(array('slugs' => $slugsCatalog), NULL, 'tm_catalogs', TRUE);

                $this->load->view('include/admin/header');
                $this->load->view('include/admin/left-sidebar');
                $this->load->view('admin/edit-catalog', $data);
                $this->load->view('include/admin/footer');
            } else {
                if ($_FILES['catalog-pics']['size'] != 0) {
                    $file_name = strtolower('brand-logo-'.$this->input->post('items'));
                    $config['upload_path'] = './asset/brands/';
                    $config['allowed_types'] = 'jpg|jpeg|png|svg';
                    $config['file_name']  = $file_name;
                    $config['overwrite']        = true;

                    $this->load->library('upload', $config);
                    if (! $this->upload->do_upload('catalog-pics')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        $data['catalog'] = $this->madmin->getProducts(array('id' => $idCatalog), NULL, 'tm_catalogs', TRUE);
                        $this->load->view('include/admin/header');
                        $this->load->view('include/admin/left-sidebar');
                        $this->load->view('admin/edit-catalog', $data);
                        $this->load->view('include/admin/footer');
                    }else{
                        $pName = $this->upload->data();
                        $slugsEditCatalog = str_replace(' ', '-', strtolower($this->input->post('items')));
                        $items = array(
                            'name'          => $this->input->post('items'),
                            'price'         => $this->input->post('price'),
                            'quota'         => $this->input->post('quota'),
                            'slugs'         => $slugsEditCatalog,
                            'logo'          => $pName['orig_name'],
                            'description'   => $this->input->post('description'),
                            'status' => 1,
                        );
                        $this->madmin->updateData(array('slugs' => $slugsCatalog), 'tm_catalogs', $items);
                        redirect('admin/list_catalog','refresh');
                    }
                } else {
                    $slugsEditCatalog = str_replace(' ', '-', strtolower($this->input->post('items')));
                    $items = array(
                        'name'          => $this->input->post('items'),
                        'price'         => $this->input->post('price'),
                        'quota'         => $this->input->post('quota'),
                        'slugs'         => $slugsEditCatalog,
                        'description'   => $this->input->post('description'),
                        'status' => 1,
                    );
                    $this->madmin->updateData(array('slugs' => $slugsCatalog), 'tm_catalogs', $items);
                    redirect('admin/list_catalog','refresh');
                }
            }
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function checkingEditCatalog($editCatalogName){
      $idCatalog = $this->input->post('id');
      $hasEditCatalogName = $this->madmin->getProducts(array('id !=' => $idCatalog, 'name' => $editCatalogName), array('nameF' => 'name'), 'tm_catalogs', TRUE);
      if (isset($hasEditCatalogName)) {
        $this->form_validation->set_message('checkingEditCatalog', 'Brand has already been created');
        // $this->session->set_flashdata('error', 'Brand has already been created');
        return FALSE;
      }else {
        return TRUE;
      }
    }

    public function resetPassword($idUserlogin){
        if ($this->session->userdata('uType') == 1) {
            $resetPass = "admin_agm";
            $newPassword = array(
                'password' => password_hash(($resetPass), PASSWORD_DEFAULT),
                'newer'    => 1
            );
            $this->madmin->updateData(array('user_id' => $idUserlogin), 'user_login', $newPassword);
            redirect('admin/listAdmin/'.$idUserlogin);
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function profile()
    {
        if ($this->session->userdata('uType') == 1) {
            $id = $this->session->userdata('uId');
            $data['detail_admin'] = $this->madmin->detail_admin($id);

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('admin/detailAdmin', $data);
            $this->load->view('include/admin/footer');
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function changePassword()
    {
        if ($this->session->userdata('uType') == 1) {
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
                    redirect('admin/changePassword');
                } else {
                    $newPassword = $this->input->post('new');
                    $confirmPassword = $this->input->post('confirm');
                    if ($confirmPassword === $newPassword) {
                        $data = array(
                            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
                        );
                        $this->madmin->updateData(array('user_id' => $id), 'user_login', $data);
                        redirect('admin/profile');

                    } else {
                        $this->session->set_flashdata('error', 'Password yang diinput tidak sama');
                        redirect('admin/changePassword');
                    }
                }

            } else {
                $this->load->view('include/admin/header');
                $this->load->view('include/admin/left-sidebar');
                $this->load->view('admin/changePassword');
                $this->load->view('include/admin/footer');
            }
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function sa_slider(){
        if ($this->session->userdata('uType') == 1) {
            $data['slides'] = $this->madmin->getProducts(array('cover' => 1), NULL, 'tm_cover', FALSE);

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('admin/sa_slider', $data);
            $this->load->view('include/admin/footer');
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function addSlider(){
        if ($this->session->userdata('uType') == 1) {

            $config['upload_path'] = './asset/upload/';
            $config['max_size'] = 2000;
            $config['max_width'] = 1440;
            $config['max_height'] = 600;
            $config['allowed_types'] = 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('sliderPict')) {
                $this->_handle_upload_slide_error('destkop');
            }else{
                $pName = $this->upload->data();
                // upload slide for modile version
                $config['max_width'] = 400;
                $config['max_height'] = 600;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('sliderPict-mobile')) {
                    // delete previously uploaded desktop image
                    $file_path = 'asset/upload/'.$pName['file_name'];
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                    $this->_handle_upload_slide_error('mobile');
                } else {
                    $pNameMobile = $this->upload->data();
                    $coverIdentifier = 1;
                    $items = array(
                        'slide'       => $pName['file_name'],
                        'slide_mobile' => $pNameMobile['file_name'],
                        'created_at'  => date('Ymd'),
                        'cover'       =>  $coverIdentifier,
                        'bannerlink'  => $this->input->post('link')
                    );
                    $this->madmin->inputData('tm_cover', $items);
                    redirect('admin/sa_slider');
                }
            }
        } else {
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function _handle_upload_slide_error($verison = '')
    {
        $data['error'] = '<p><strong>' . ucfirst($verison) . ' version:</strong></p>'
                    . $this->upload->display_errors('', '');
        $this->load->view('include/admin/header');
        $this->load->view('include/admin/left-sidebar');
        $this->load->view('admin/addSlider', $data);
        $this->load->view('include/admin/footer');
    }

    public function deleteSlider($idSlider){
        if ($this->session->userdata('uType') == 1) {
            $file = $this->madmin->getProducts(array('id' => $idSlider), null, 'tm_cover', TRUE);
            if (!empty($file)) {
                $file_path = 'asset/upload/'.$file['slide'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                $file_path_mobile = 'asset/upload/'.$file['slide_mobile'];
                if (file_exists($file_path_mobile)) {
                    unlink($file_path_mobile);
                }
                $this->madmin->deleteData(array('id' => $idSlider), 'tm_cover');
            }
            redirect('admin/sa_slider');
        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function list_transaction(){
        if ($this->session->userdata('uType') == 1) {
            $data['transactions'] = $this->madmin->getOrderList();

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('admin/list-transaction', $data);
            $this->load->view('include/admin/footer');

        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function list_history_transaction(){
        if ($this->session->userdata('uType') == 1) {
            $data['transactions'] = $this->madmin->getOrderHistory();

            $this->load->view('include/admin/header');
            $this->load->view('include/admin/left-sidebar');
            $this->load->view('admin/list-history-transaction', $data);
            $this->load->view('include/admin/footer');

        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function delete_order($order_id){
        if ($this->session->userdata('uType') == 1) {
            $this->madmin->deleteData(array('order_id' => $order_id), 'tm_order');
            redirect('admin/list_transaction', 'refresh');
        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

    public function finish_order($order_id){
        if($this->session->userdata('uType') == 1){
            $stat = $this->madmin->getProducts(array('order_id' => $order_id), array('statField' => 'status'), 'tm_order',TRUE);
            // if($stat['status'] === 1){
            $items = array('status' => '2');
            $this->madmin->updateData(array('order_id' => $order_id), 'tm_order', $items);
            redirect('admin/list_transaction', 'refresh');
            // }
            // else{
            //     $items = array('status' => 1);
            //     $this->madmin->updateData(array('slugs' => $order_id), 'tm_order', $items);
            //     redirect('admin/list_catalog', 'refresh');
            // }
        }else{
            $this->load->view('include/header2');
            $this->load->view('un-authorise');
            $this->load->view('include/footer');
        }
    }

}
