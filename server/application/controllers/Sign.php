<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sign extends B_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('mdl_user');
        $this->load->library('captcha');
    }
    /**
     * 默认入口
     *
     * @access  public
     * @return  void
     */	
    public function index(){
        if ($this->session->userdata('this_user')){
            redirect( site_url('product/index'));
        }else{
            $this->this_view_data['msg'] = $this->session->flashdata('msg');
            $this->load->view('sign',$this->this_view_data);
        }
    }
    /**
     * 退出
     *
     * @access  public
     * @return  void
     */	
    public function logout(){
        $this->session->sess_destroy();
        redirect( site_url('sign'));
    }
    /**
     * 用户登录验证
     *
     * @access  public
     * @return  void
     */	
    public function do_login(){
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        if ($username && $password){
            $this_user = $this->mdl_user->my_select($username);
            if ( $this_user ){
                if( $this_user['status'] == '1' ){
                    if( $this_user['password'] == password_encrypt($password) ){
                        $this->session->set_userdata('this_user',$this_user);
//                        $this->load->model('mdl_log');
//                        $this->mdl_log->add_log('登录成功');
                        if( $this_user['password_times'] != '0' ){
                            $this->db->where(array('id'=>$this_user['id']));
                            $this->db->set('password_times','0',FALSE);
                            $this->db->update('user');
                        }
                        redirect( site_url('product'));
                    }else{
                        $setting_times = empty($this->this_setting['user_error_times'])?5:$this->this_setting['user_error_times'];
                        $this->db->where(array('id'=>$this_user['id']));
                        $this->db->set('password_times','password_times + 1',FALSE);
                        if( $this_user['password_times'] + 1 >= $setting_times ){
                            $this->db->set('status','2');
                            $msg = '密码错误,该账号已锁定';
                        }else{
                            $msg = '密码错误,错误'.($setting_times-($this_user['password_times'] + 1)).'次后锁定';
                        }
                        $this->db->update('user');
                        $this->session->set_flashdata('msg', $msg);
                    }
                }else if( $this_user['status'] == '2' ){
                    $this->session->set_flashdata('msg', '该账号已锁定');
                }else if( $this_user['status'] == '3' ){
                    $this->session->set_flashdata('msg', '该账号已注销');
                }
            }else{
                $this->session->set_flashdata('msg', '账号不存在');
            }
        }else{
            $this->session->set_flashdata('msg', '用户名密码不能为空');
        }
        redirect( site_url('sign') );
    }
    /**
     * 生成验证码
     *
     * @access  protected
     * @return  void
     */
    public function get_captcha(){
        Captcha::$useImgBg = TRUE;  // 是否使用背景图片
        Captcha::$useNoise = FALSE; // 是否添加杂点 
        Captcha::$useCurve = FALSE; // 是否绘制干扰线 
        Captcha::$useZh    = FALSE; // 是否使用中文验证码 
        Captcha::$fontSize = 16;    // 验证码字体大小(像素) 
        Captcha::$length   = 4;     // 验证码字符数
        Captcha::entry();           // 输出图片
    }
    /**
     * ajax 验证验证码
     *
     * @access  protected
     * @return  void
     */
    public function check_captcha(){
        $mark = 0;
        if( !empty($_GET['code']) ){
            if( Captcha::check($_GET['code']) ){
                $mark = 1;
            }
        }
        echo $mark;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */