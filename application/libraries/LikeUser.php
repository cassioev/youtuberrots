<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LikeUser extends Exception
{

    //protected $CI;
    private $title_video;
    private $name_user;
    private $video_url;
    private $id_like_user_md5;
    private $user_photo;
    private $time_reg;

    /**
     * @return mixed
     */
    public function getTitleVideo()
    {
        return $this->title_video;
    }

    /**
     * @param mixed $title_video
     */
    public function setTitleVideo($title_video)
    {
        $this->title_video = $title_video;
    }

    /**
     * @return mixed
     */
    public function getNameUser()
    {
        return $this->name_user;
    }

    /**
     * @param mixed $name_user
     */
    public function setNameUser($name_user)
    {
        $this->name_user = $name_user;
    }

    /**
     * @return mixed
     */
    public function getVideoUrl()
    {
        return $this->video_url;
    }

    /**
     * @param mixed $video_url
     */
    public function setVideoUrl($video_url)
    {
        $this->video_url = $video_url;
    }

    /**
     * @return mixed
     */
    public function getIdLikeUserMd5()
    {
        return $this->id_like_user_md5;
    }

    /**
     * @param mixed $id_like_user_md5
     */
    public function setIdLikeUserMd5($id_like_user_md5)
    {
        $this->id_like_user_md5 = $id_like_user_md5;
    }

    /**
     * @return mixed
     */
    public function getUserPhoto()
    {
        return $this->user_photo;
    }

    /**
     * @param mixed $user_photo
     */
    public function setUserPhoto($user_photo)
    {
        $this->user_photo = $user_photo;
    }

    /**
     * @return mixed
     */
    public function getTimeReg()
    {
        return $this->time_reg;
    }

    /**
     * @param mixed $time_reg
     */
    public function setTimeReg($time_reg)
    {
        $this->time_reg = $time_reg;
    }

    public function to_array()
    {
        $like_user_array = array('id_like_user_md5' => $this->id_like_user_md5,
                                      'video_url'  => $this->video_url,
                                      'name_user'  => $this->name_user,
                                      'title_video'=> $this->title_video,
                                      'user_photo' => $this->user_photo, 
                                      'time_reg'   => $this->time_reg);

        return $like_user_array;
    }


    //so cria o obj se ele n existe e tem url

    public function __construct($data_user_like)
    {

        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->database();

        if (!isset($data_user_like['video_url']))
            throw new Exception('video sem url');

        $this->video_url = $data_user_like['video_url'];
        $this->title_video = $data_user_like['title'];
        $this->name_user =  $this->CI->session->userdata('user_name');
        $this->id_like_user_md5 = md5($this->video_url . $this->CI->session->userdata('user_name'));
        $this->user_photo = $this->CI->session->userdata('user_photo');
        $this->time_reg = strtotime(date("Y-m-d H:i:s")) + (14400) + (mt_rand(1, 99) * 2);
          

        $this->CI->db->where('id_like_user_md5', $this->id_like_user_md5);
        $this->CI->db->from('share_likes_users');                   

        if($this->CI->db->count_all_results() > 0)
        {
             throw new Exception('video ja existe');
        }  

        

        //$this->CI =& get_instance();
        //$this->CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

    }


}