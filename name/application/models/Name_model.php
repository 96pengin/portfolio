<?php
    class Name_model extends CI_Model{
        public function __construct()
        {
            parent::__construct();
            // 独自処理
        }
        
        public function name_name($uni){
            $this->db->select('uni_num');
            $this->db->from('uniuni');
            $this->db->where('uniunicol',$uni);
            $query = $this->db->get()->result_array();
            return $query;
        }
    }

?>