<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Youtubelist_model extends CI_Model {
	



	 public function __construct(){
                parent::__construct();
                $this->load->database();
        }

        //Verifica se não existe aquela chave user.video, dai inseri no tabela publica

      /*  public function insert_likes_user($user_likes){
                

                foreach ($user_likes as $video_url) {
                	
					$this->db->where('id_like_user_md5', $video_url['id_like_user_md5']);
					$this->db->from('share_likes_users');					

					if($this->db->count_all_results() == 0)
                    {
                	 $sql = $this->db->set($video_url)->get_compiled_insert('share_likes_users');
					 $this->db->query($sql);
					}


                }

          
        }*/

        public function insert_likes_user_obj($user_likes_obj){
            
              
            $sql = $this->db->set($user_likes_obj->to_array())->get_compiled_insert('share_likes_users');
            $this->db->query($sql);
                   
        }


         public function get_main_table($limit = '100'){

                $query = $this->db->query("select * from share_likes_users order by time_reg desc limit ".$limit);
                return $query->result_array();

        }

}