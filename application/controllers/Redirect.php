<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/18/17
 * Time: 4:17 PM
 */
class Redirect extends CI_Controller
{

    public function index(){
        $code = $this->uri->segment(1);





        $this->db->where('code', $this->uri->segment(1));
        $row = $this->db->get('link')->row();



        if(!isset($row)) {
            //if it's not a valid link code, maybe it's a valid admin key



            $this->db->where('admin_key', $this->uri->segment(1));
            $row = $this->db->get('link')->row();
            if(isset($row)){
                $data = array();


                $sql = "SELECT COUNT(DISTINCT(ip)) AS count FROM tracking WHERE link_id = ?";
                $data['distinct'] = $this->db->query($sql, array($row->id))->row()->count;


                $this->db->where('link_id',$row->id);


                $data['hits'] = $this->db->get('tracking')->result();

                //redirect(base_url()."?key=$code");
                $this->load->view('header');
                $this->load->view('admin',$data);
                $this->load->view('footer');

                return false;
//                die();

            }else{
                redirect(base_url().'?message=Invalid%20Key');
            }
        }
        $url = $row->link;


        //get the region from an api
        $ip = $_REQUEST['REMOTE_ADDR']; // the IP address to query
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
        if($query && $query['status'] == 'success') {
            $region = $query['city'].', '.$query['country'];
        } else {
            echo 'Unable to get location';
        }

        if(isset($_SERVER['HTTP_REFERER'])){
            $refer = $_SERVER['HTTP_REFERER'];
        }else{
            $refer = 'Unknown';
        }

        $params = array();

        $params['region'] = $region;
        $params['link_id'] = $row->id;
        $params['ip']=$_SERVER['REMOTE_ADDR'];
        $params['referrer'] = $refer;

        $this->db->insert('tracking',$params);


        redirect($url);
    }

    public function flop(){

        $sql = "UPDATE table SET valid =  IF(valid=1, 0, 1) WHERE key = ?";
        $q = $this->db->query($sql, array($this->input->get('key')));
        print_r($q);
    }

//    public function admin(){
//
//
//
//        if(!isset($row)){
//            redirect(base_url().'message=Invalid%20 Key');
//            die();
//        }
//        $this->db->where('link_id',$row->id);
//        $data = array();
//        $data['test'] = 'bazooka';
//        $data['hits'] = $this->db->get('tracking')->result();
//
//        //$this->load->view('header');
//echo 'hi';
//        $this->load->view('home');
//        echo '2';
//
//        //$this->load->view('footer');
//
//    }

}