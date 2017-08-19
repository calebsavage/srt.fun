<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

//	public function _construct()
//    {
//        parent::_construct;
//
//        header("Access-Control-Allow-Origin: *");
//    }

    public function index()
	{

        if(isset($_GET['message'])){
            $data['message'] = $_GET['message'];
        }else{
            $data['message'] = '';
        }



        $this->load->view('header');
		$this->load->view('home',$data);
        $this->load->view('footer');
	}




	public function ingest(){


	    $this->load->database();
	    $url = $this->input->post('url');




	    $code = substr(md5(uniqid(rand(), true)),0,5);

	    $key = md5(uniqid(rand(), true));

	    $sql = "INSERT INTO `link`(link,code,admin_key) VALUES(?,?,?)";
//
	    $this->db->query($sql, array($url, $code, $key));

	    $short_link = base_url().$code;


	    $response = array('url'=>$short_link, 'admin_link' => base_url().$key);

	    die(json_encode($response));
    }
}
