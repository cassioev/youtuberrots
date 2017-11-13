<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Main extends CI_Controller
{


    private $youTube;
    private $user_likes;
    private $cacheManager;

    function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
        parent::__construct();
        $this->load->library('Youtube');
        try{$this->load->library('LikeUser',array());}catch(Exception $e){} //vai pedir parametros, n precisa agora
        $this->load->library('CacheManager');
        $this->cacheManager = new CacheManager();
        $this->youTube = new Youtube();
        $this->youTube->set_access_token($this->session->userdata('access_token'));
    }


    public function index()
    {

        $this->cache->clean();
        
        try 
        {
            $this->user_likes = $this->youTube->get_user_videos_with_title(); // TO DOlista de obj
        } catch (Exception $e) {
            redirect('Login');
        }


        
        $this->persist_user_likes(); //salva no db*/
        $data['userInfos'] = $this->read_likes_main_table(TABLE_DEFAULT_LINES); //le o db, mostra no 5 por vez
        $this->load->view('main', $data);


    }

    
    private function persist_user_likes()
    {

        $this->load->model('Youtubelist_model');
              
        foreach ($this->user_likes as $video_url) 
        {
            try
            {
                $user_like_obj = new LikeUser($video_url);
                $this->Youtubelist_model->insert_likes_user_obj($user_like_obj);

            }catch(Exception $e)
            {
                //video ja existe, video sem url
            }
           

        }


    }

    public function read_likes_main_table($limit = TABLE_DEFAULT_LINES)
    { // le o cache e volta 5 videos

        $this->cacheManager->check_cache();
        $likes = $this->cache->get('likes');
        $main_table = array_slice($likes, 0, $limit);
        return $main_table;

    }

    public function send_new_like_to_client_ajax()
    {

        $first_date = strtotime($this->input->post('firstDate')); //usar lastdate pra pegar os outros
        $cont = 0;
        $new_likes = array();

        $this->cacheManager->check_cache();

        $like_User = $this->cache->get('likes');

        $key = array_search($first_date, array_column($this->cache->get('likes'), 'time_reg'));


        if ($key === false) {
            $data['userInfos'] = array_slice($like_User, -TABLE_DEFAULT_LINES);
        } elseif ($key > 0) {
            $key--;
            for ($key; $key >= 0; --$key) {
                array_unshift($new_likes, $like_User[$key]);
                $cont++;
                if ($cont >= TABLE_DEFAULT_LINES)
                    break;
            }

            $data['userInfos'] = $new_likes;


        } else {
            return FALSE;
        }

        echo $this->load->view('tableView', $data, TRUE);


    }


    public function send_old_like_to_client_ajax()
    { // tem q puxar os 5 anteriores aos q estao na tabela

        $this->cacheManager->check_cache();
        $last_date = strtotime($this->input->post('lastDate')); //usar lastdate pra pegar os outros
        $cont = 0;
        $like_User = $this->cache->get('likes');
        $old_likes = array();

        
        $key = array_search($last_date, array_column($this->cache->get('likes'), 'time_reg'));

        if (count($like_User) - $key == 1 || $key === false) {
            echo '<b>Acabou! :(</b>';
        } else {
            $key++;
            for ($key; $key < count($like_User); $key++) {
                array_push($old_likes, $like_User[$key]);
                $cont++;
                if ($cont >= TABLE_DEFAULT_LINES)
                    break;
            }

            $data['userInfos'] = $old_likes;
            echo $this->load->view('tableView', $data, TRUE);

        }


    }


}
