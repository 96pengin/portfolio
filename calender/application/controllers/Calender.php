<?php
    class Calender extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            
            // 独自処理
            $this->load->model('Calender_model');
        }
        public function index()
        {
            $this->load->helper('url');
            $prefs = array(
                'show_next_prev'  => true,
                'next_prev_url'   => ''
            );
            $prefs['template'] ='{table_open}<table border="0" cellpadding="0" cellspacing="0" class="table">{/table_open}

            {heading_row_start}<tr>{/heading_row_start}
    
            {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
    
            {heading_row_end}</tr>{/heading_row_end}
    
            {week_row_start}<tr>{/week_row_start}
            {week_day_cell}<td>{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}
    
            {cal_row_start}<tr>{/cal_row_start}
            {cal_cell_start}<td>{/cal_cell_start}
            {cal_cell_start_today}<td>{/cal_cell_start_today}
            {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}
    
            {cal_cell_content}<div class="element" data-day="{day}">{day}<br><div>{content}</div></div>{/cal_cell_content}
            {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
    
            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}
    
            {cal_cell_blank}&nbsp;{/cal_cell_blank}
    
            {cal_cell_other}{day}{/cal_cel_other}
    
            {cal_cell_end}</td>{/cal_cell_end}
            {cal_cell_end_today}</td>{/cal_cell_end_today}
            {cal_cell_end_other}</td>{/cal_cell_end_other}
            {cal_row_end}</tr>{/cal_row_end}
            {table_close}</table>{/table_close}' ;

            $this->load->library('calendar', $prefs);
            $array = $this->db->get("calender")->result_array();
            // var_dump($array);
            // exit;
            $info = null;
            foreach ($array as $row) {
                if (substr($row['days'], 0, -2) == $this->uri->segment(3).$this->uri->segment(4)) {
                    $info[intval(substr($row['days'], -2))] = $row['schedule'];
                }
            }
            $cal["calender"] = $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4), $info);
            $this->load->view("calender_view", $cal);
        }
        
        public function screen()
        {
            if ($this->input->method() === 'post') {
                $days=$this->input->post("day");
                $plans=$this->input->post("plans");
                exit($this->Calender_model->collation($days, $plans));
            }
        }
    }
