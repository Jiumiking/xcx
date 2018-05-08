<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 2016/8/15
 * Time: 10:51
 */
class Mdl_product extends MY_Model{
    /**
     * Mdl_goods constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->my_select_field = 'id,number,name,material,format,face,price,isOnline';
        $this->my_table = 'product';
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
                if( $key == 'number' || $key == 'name' || $key == 'material' || $key == 'format' || $key == 'face' ){
                    $return .= ' AND '.$key." LIKE '%$value%'";
                }else{
                    $return .= ' AND '.$key." = '$value'";
                }
            }
        }
        return $return;
    }
}