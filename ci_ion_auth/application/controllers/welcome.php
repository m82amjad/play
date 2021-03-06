<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {

        trigger_error( 'Whoops!', E_USER_NOTICE );
//        $this->load->database();
//        $this->db->where('business_code', 'AAA1787');
//        $query = $this->db->get('order_api_config');
//        $row = ($query->num_rows > 0 ? $query->row() : array());
        $this->config->set_item('default_controller', 'auth');
        echo $this->config->item('default_controller');
        $this->load->view('welcome');
    }


    // http://learning7.lc/ci_ion_auth/welcome/download_process
    public function download_process()
    {
        $this->load->helper('download');
        $data = 'Here is some text!';
        $name = 'mytext.txt';

        force_download($name, $data);
    }

    public function upload() {
        $this->load->view('upload');
    }


    public function upload_process() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|xls|csv';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = TRUE;
        $config['file_name'] = 'products.xls';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()){
//            die('File Upload Failed.');
            echo $this->upload->display_errors( );
        }
        else
            die('success');
    }


    /*
     * http://learning7.lc/ion_auth/index.php/welcome/order_api_config
     */
    public function order_api_config() {
        $this->load->database();
        $this->db->where('business_code', 'AAA1787');
        $query = $this->db->get('order_api_config');
        $row = ($query->num_rows > 0 ? $query->row() : array());

        header('Content-Type: application/json');
        echo json_encode($row);
    }

    /*
     * http://learning7.lc/ion_auth/index.php/welcome/creatDB
     */
    public function creatDB() {
        $this->load->library('migration');
//        echo $this->migration->current();

        if ( ! $this->migration->current())
        {
            show_error($this->migration->error_string());
        }
//        $this->load->model('trackerm');
//        $this->trackerm->creatDB();
    }


    /*
 * http://play.lc/ci_ion_auth/index.php/offers/welcome/1
 */
    public function prod($id=1) { //
//        $this->load->model('products');
        $this->load->model('products');
        $this->trackerm->creatDB();
    }




    // http://play.lc/ci_ion_auth/index.php/welcome/sms
    public function sms(){ // die('fds');
        $this->load->library('curl');
        $sms_status = $this->curl->simple_get('http://213.104.214.8:9090');
        echo $sms_status;

    }

    // http://play.lc/ci_ion_auth/index.php/welcome/distacne
    public function distacne(){
        $this->load->library('map');
        echo '<pre>';
        print_r($this->map->getDistanceByAddress('GU215ED','N90AY'));
        echo '========================================<br />';
        print_r($this->map->getLngLat('GU215ED'));
        echo '========================================<br />';
        print_r($this->map->getLngLat('N90DY'));
        echo '========================================<br />';
        echo 'GU215ED >> N90DY =====>> '. $this->map->getDistance(51.3262614, -0.5452457, 51.6206058, -0.0591767)->feet .'<br />' ;
        echo '========================================<br />';
        $from = $this->map->getLngLat('GU215ED');
        $to = $this->map->getLngLat('GU215AH');
        echo 'GU215ED >> GU215AH =====>> '. $this->map->getDistance($from->lat, $from->lng, $to->lat, $to->lng)->feet .'<br />' ;
        echo '========================================<br />';
        print_r($this->map->getDistanceByAddress('GU215ED','GU215AH'));


        echo '========================================<br />';
        echo '========================================<br />';
    }

    public function deleCharge($dis=5291){
        $this->load->database();
        $this->load->library('map');
        $this->db->select('*')->from('services_delivery_charge_view');
        $data  =  $this->db->get()->result() ;
        echo '<pre>'; print_r($data);

        echo '========================================<br />';
        echo $this->map->getDeliveryCharge($data, $dis);
    }

    public function setPostcode($postcode='GU215ED'){
        $this->load->database();
        $this->db->select('*')->from('services_delivery_charge_view');
        $data  =  $this->db->get()->result();


        $this->load->library('map');
        $this->load->library('session');
        $business   = $this->map->getLngLat('GU215ED'); // Business Lat and Lng
        // Add lat lng to business address add following fileds to orders..
        $to         = $this->map->getLngLat($postcode);
        $sessData = array(
            'postcode' => $postcode
            , 'address_lat' => $to->lat
            , 'address_lng' => $to->lng
        );
        $sessData['address_distance'] = $this->map->getDistance($business->lat, $business->lng, $to->lat, $to->lng)->feet;
        $sessData['delivery_charge'] = $this->map->getDeliveryCharge($data, $sessData['address_distance']);

        $this->session->set_userdata($sessData);

        echo '<pre>'; print_r($sessData);
    }

    public function usersExport(){
        $this->load->database();
        $this->load->library('csvreader');
        $report = $this->db->select('first_name as fname, last_name as lname, email, phone, username, user_code, title')->get('users');
        echo $new_report = $this->csvreader->csv_from_result($report, ',', "\n",'"');

        $this->load->helper('download');
        force_download("users.csv", $new_report);
    }

    public function upload_advance( ) {
        $this->data['page']= 'import/upload_advance';
        $this->load->view($this->_menuMainPage, $this->data);
    }

    public function usersImportProcess( ) {
        $this->config->set_item('csrf_protection', FALSE);
        $table = $this->input->post('table');
        $config['upload_path'] = './var/upload/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = TRUE;
        $config['file_name'] = "$table.csv";
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload())
            die( $this->upload->display_errors());
        else{
            $successArray = $this->upload->data();
            $success = "File Upload Succeeded ". implode('|',$successArray);
        }

        $result = $this->csvreader->parse_file($successArray['full_path']);

        $this->db->truncate($table);
        foreach ($result as $row) {
            $this->cm->insert_data($table, $row);
        }
        $this->data['result'] = $result;
        $this->data['page']= 'import/upload_result';
        $this->load->view($this->_menuMainPage, $this->data);
    }


    public function invoice($y=2015, $m=1){
        $this->load->database();
        $this->load->model('invoice');
        /*$res = $this->invoice->getData(2014, 12);
        echo '<pre>'; print_r($res);
        $res = $this->invoice->removeCancelled($res);*/

        $res= $this->invoice->getOrdersFromTo('2012-01-01 00:00:00', '2016-01-01 00:00:00');
        $res = $this->invoice->getTotals($res);
        echo '<pre>'; print_r($res);
    }



    /*
     *  [1] => stdClass Object
        (
            [id] => 00000000003
            [active] => 1
            [order_code] => AAA1787
            [order_id_temp] => AAA0001
            [user_code] => AAA1791
            [fname] =>
            [lname] =>
            [email] =>
            [phone] =>
            [postcode] =>
            [placed_at] =>
            [requested_at] =>
            [receiving] => delivery
            [pay_method] => cash
            [checkout_price] => 20.00
            [vip] => 0
            [customer_group] => A
            [status] => processing
        )
     */


    /* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */
}
