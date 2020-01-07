<?php
    class Name extends CI_Controller{
        public function index()
        {
            $this->load->model('Name_model');
            try {
                if ($this->input->method() === 'post') {
                    $name = $this->input->post('name');
                    $arr1 = str_split($name, 3);
                    $count = 0;
                    $daikichi = array(11,16,21,23,31,32);
                    $kichi    = array(3,5,6,8,13,15,18,24,25,29,33,37,39,44,45,47,48,51);
                    $chukichi = array(7,17,27,30,34,35,36,38,40,42,43,4953,57,58,61,63);
                    $kyo      = array(2,4,9,10,12,14,19,20,22,26,28,46,50,54,55,56,59,60);
                    if(preg_match( "/[一-龠]/u", $name) ){
                        //日本語文字列が含まれている
                        }else{
                        //日本語文字列が含まれていない
                        throw new Exception('入力できるのは漢字のみです');
                        exit;
                        }
                    foreach ($arr1 as $value):
                        //postされてきた文字（バイナリーデータ）をmb_convert_encording関数はUTF-8をUSC-４に変換する
                        //2進数→16進数->10進数->16進数に整形する
                        //10進数を挟む理由はdbに保存されているunicodeが0埋めされているから
                        //sprintf関数で4文字の文字列に直す
                        $uni = sprintf("U+%04X", hexdec(bin2hex(mb_convert_encoding($value, 'UCS-4', 'UTF-8'))));
                        $data = $this->Name_model->name_name($uni);
                        $result= intval($data[0]['uni_num']);
                        $count = $count + $result;
                    endforeach;
                    if (in_array($count, $daikichi)) {
                        echo 'あなたは大吉です';
                    }
                    if (in_array($count, $kichi)) {
                        echo 'あなたは吉です';
                    }
                    if (in_array($count, $chukichi)) {
                        echo 'あなたは中吉です';
                    }
                    if (in_array($count, $kyo)) {
                        echo 'あなたは凶です';
                    }
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
            $this->load->view("Name_view");
        }

    }
?>