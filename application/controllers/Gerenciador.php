<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Gerenciador extends CI_Controller
{
        
    
    function __construct()
    {
        parent::__construct();
        $ac_token = $this->session->userdata('access_token');
        $googleInformation = array();
        $userInformation   = array();
        $code = false;
        $token = false;



        if (isset($_GET['code'])) 
             $code = true;

        if (isset($ac_token)) 
            $token = true;

        if($code)
        {
                $googleInformation = get_oauth2_token($_GET['code']); //pega o acesss e o refresh
        
                $userInformation = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=' . $googleInformation['access_token']), true);
                
                $googleInformation['nameUser'] = $userInformation['name'];
                $googleInformation['picture']  = $userInformation['picture'];
                
                $this->session->set_userdata('access_token', $googleInformation['access_token']);
                //$this->session->set_userdata('refresh_token', $googleInformation['refresh_token']);
                $this->session->set_userdata('user_name', $googleInformation['nameUser']);
                $this->session->set_userdata('user_photo', $googleInformation['picture']);
                $this->session->set_userdata('is_logged', true);
                $this->session->mark_as_temp('is_logged', 30);
                
                redirect('Main');
        }    
        elseif ($token)
        {
            redirect('Main');  
        }
        else
        {
            redirect('Login');
        }







        // if (!isset($_GET['code'])) {
        //     $ac_token = $this->session->userdata('access_token');
            
        //     if (isset($ac_token)) {
        //         redirect('Main');
        //     }
            
        //     redirect('Login');
            
        // }
             
        
        // $googleInformation = get_oauth2_token($_GET['code']); //pega o acesss e o refresh
        
        // $userInformation = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=' . $googleInformation['access_token']), true);
        
        // $googleInformation['nameUser'] = $userInformation['name'];
        // $googleInformation['picture']  = $userInformation['picture'];
        
        // $this->session->set_userdata('access_token', $googleInformation['access_token']);
        // //$this->session->set_userdata('refresh_token', $googleInformation['refresh_token']);
        // $this->session->set_userdata('user_name', $googleInformation['nameUser']);
        // $this->session->set_userdata('user_photo', $googleInformation['picture']);
        // $this->session->set_userdata('is_logged', true);
        
        // redirect('Main');
        
    }
    
    
    
    
    public function index()
    {
        
        
    }
    
    
    
    
    
    
    
    
    
    
}