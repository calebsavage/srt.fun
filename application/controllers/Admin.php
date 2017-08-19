<?php

/**
 * Created by PhpStorm.
 * User: savagec
 * Date: 8/18/17
 * Time: 8:18 PM
 */
class Admin extends CI_Controller
{

    public function index(){
print_r($_GET[]);
        $this->db->where('key',$this->input->get('key'));
        $link = $this->db->get('link');
        print_r($link);


        if(!isset($link)){
            redirect(base_url().'message=Invalid%20 Key');
            die();
        }
        $this->db->where('link_id',$link->id);
        $data['hits'] = $this->db->get('tracking');

        print_r($data['hits']);




    }

}