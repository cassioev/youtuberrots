<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Youtube extends Exception
{
    
    protected $CI;
    private $access_token;
    private $user_videos;
    //private $user_likes;

        
    
    public function __construct()
    {

        parent::__construct();
        $this->CI =& get_instance();
       
        
    }

    public function get_user_videos_with_title($date = "2010-01-01"){
        $this->user_likes_request($date);
        $this->set_title_videos();
        return $this->user_videos;
    }


    public function get_user_videos_without_title($date = "2010-01-01"){
        $this->user_likes_request($date);
        return $this->user_videos;
    }

     public function get_acess_token(){
        return $this->access_token;
    }




    public function set_access_token($access_token){
        $this->access_token = $access_token;
    }


    //Pega os likes do user retornando apenas o link de cada video.
    //Se o token expirou, lança um erro     
    private function user_likes_request($date = "2010-01-01")
    {

        $url_request_video_link = 'https://www.googleapis.com/youtube/v3/activities?part=contentDetails&mine=true&publishedAfter='.$date.'T00%3A00%3A00.0Z&fields=items&access_token=';
        $user_video_info;
        //$urlt = 'https://www.googleapis.com/youtube/v3/activities?part=contentDetails&mine=true&publishedAfter=2017-08-06T00%3A00%3A00.0Z&fields=items&access_token=';
//https://www.googleapis.com/youtube/v3/activities?part=contentDetails&mine=true&fields=items%2FcontentDetails%2Flike&key=
        $video_id_user = array();
        $cont = 0;
        
       echo $url_request_video_link.$this->access_token;
       exit();
        
        try {
         $user_video_info = json_decode(file_get_contents($url_request_video_link.$this->access_token), true);
        } catch (Exception $e) {
            echo 'oi';
        }

        if(empty($user_video_info))
            throw new Exception('Nada para retornar. Erro.');

        echo "string1";

        foreach ($user_video_info as $like) {
            
            foreach ($like as $video) {
                $this->user_videos[$cont]['video_url'] = $video['contentDetails']['like']['resourceId']['videoId'];
                $cont++;
            }
            
        }        

            
        
        if(!empty($this->user_videos)){
             $this->user_videos = array_unique($this->user_videos, SORT_REGULAR);
             
        }
        

        
        
    }



     private function set_title_videos(){
        if(empty($this->user_videos))
            return;

        $videosArray = array();
        $cont = 0;

        foreach ($this->user_videos as $key => $value) {
          $videosArray[] = $value['video_url'];

        }

        $comma_separated_ids = implode(",", $videosArray);

        $url_request_video_link = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$comma_separated_ids.'&fields=items%2Fsnippet%2Ftitle&access_token=';
        
        $user_video_info = json_decode(file_get_contents($url_request_video_link.$this->access_token), true);
        
        foreach ($user_video_info as $title) {
            
             foreach ($title as $subtitle) {
                 $this->user_videos[$cont]['title'] = $subtitle['snippet']['title'];
                 $cont++;
                
             }
         }

        

     }

    
   
    
}