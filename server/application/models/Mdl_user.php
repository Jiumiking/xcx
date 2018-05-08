<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI后台model
 * @category    model
 * @author      ming.king
 * @date        2015/11/26
 */
class Mdl_user extends MY_Model{
    /**
     * 构造函数
     *
     * @return  void
     */
    public function __construct(){
        parent::__construct();
        $this->my_select_field = 'id,name,name_real,password,phone,email,role,date_add,password_times,status';
        $this->my_table = 'user';
    }
    /**
     * 详情
     * @access  public
     * @param   mixed
     * @return  mixed
     */
    public function my_select( $id = '' ){
        if( empty( $id ) ){
            return false;
        }
        $sql = "
            SELECT
                {$this->my_select_field}
            FROM
                {$this->db->dbprefix($this->my_table)}
            WHERE
                id = '$id' OR name = '$id'
        ";
        $query = $this->db->query($sql);
        $data = $query->row_array();
        return $data;
    }
    /**
     * 用户列表搜索条件处理
     *
     * @param   mixed
     * @return  object
     */
    protected function _list_filter( $filter=array() ){
        if(empty($filter)){
            return '';
        }
        $return = '';
        foreach($filter as $key=>$value){
            if(!empty($value)){
                $value = str_replace('.','\.',$value);
                $value = str_replace('%','\%',$value);
                if($key == 'user_name' || $key == 'nick_name' || $key == 'phone' || $key == 'email'){
                    $return .= ' AND u.'.$key." LIKE '%$value%'";
                }else{
                    $return .= ' AND u.'.$key." = '$value'";
                }
            }
        }
        return $return;
    }
    /**
     * 列表条件处理
     * @access  public
     * @param   mixed
     * @return  mixed
     */
    protected function my_where( $where=array() ){
        if(empty($where)){
            return '';
        }
        $return = '';
        foreach($where as $key=>$value){
            if( !empty($value) || $value == '0' ){
                $this->sql_value($value);
                if($key == 'name' || $key == 'name_real' || $key == 'phone' || $key == 'email'){
                    $return .= ' AND '.$key." LIKE '%$value%'";
                }else{
                    $return .= ' AND '.$key." = '$value'";
                }
            }
        }
        return $return;
    }
}