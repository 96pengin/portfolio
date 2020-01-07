<?php
    class Calender_model extends CI_Model{
        public function __construct()
        {
            parent::__construct();
            // 独自処理
        }

        public function collation($days,$plans){
            $data =array(
                'schedule'=>$plans,
                'days'=>$days
            );
            return $this->db->insert("calender",$data);
        }
    }

?>