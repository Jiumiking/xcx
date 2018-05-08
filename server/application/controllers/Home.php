<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//use QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;

class Home extends B_Controller {
    public function index() {
        $number = empty($_GET['number'])?'':$_GET['number'];
        if( empty($number) ){
            $this->json([
                'code' => 0,
                'error' => '编号不能为空'
            ]);
            return;
        }
        $sql = "
            SELECT
                *
            FROM
                product
            WHERE
                number = '$number'
        ";
        $query = $this->db->query($sql);
        $data = $query->row_array();
        if( empty($data) ){
            $this->json([
                'code' => 0,
                'error' => '未找到数据'
            ]);
            return;
        }
        $this->json([
                'code' => 1,
                'data' => $data
            ]);
    }
}
