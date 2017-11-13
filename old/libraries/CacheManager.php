<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class CacheManager {
    
    protected $CI;
  

        
    
    public function __construct()
    {

       
        $this->CI =& get_instance();
        $this->CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
       
        
    }


    public function check_cache($limit = '100'){

    		$likes = array();
    		
			if ( ! $this->CI->cache->get('likes')){ //nao existe cache
				
				$this->CI->load->model('Youtubelist_model');
				$likes = $this->CI->Youtubelist_model->get_main_table($limit);
				$this->CI->cache->save('likes', $likes, 80); //80 segundos de cache
				
			}

		



    }

    
   
    
}