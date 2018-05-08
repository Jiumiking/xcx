<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*********************************************************************
函数名称:encrypt
函数作用:加密解密字符串
使用方法:
加密     :encrypt('str','E','nowamagic');
解密     :encrypt('被加密过的字符串','D','nowamagic');
参数说明:
$string   :需要加密解密的字符串
$operation:判断是加密还是解密:E:加密   D:解密
$key      :加密的钥匙(密匙);
*********************************************************************/
function encrypt($string,$operation,$key=''){
    $key=md5($key);
    $key_length=strlen($key);
    $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
    $string_length=strlen($string);
    $rndkey=$box=array();
    $result='';
    for($i=0;$i<=255;$i++){
        $rndkey[$i]=ord($key[$i%$key_length]);
        $box[$i]=$i;
    }
    for($j=$i=0;$i<256;$i++){
        $j=($j+$box[$i]+$rndkey[$i])%256;
        $tmp=$box[$i];
        $box[$i]=$box[$j];
        $box[$j]=$tmp;
    }
    for($a=$j=$i=0;$i<$string_length;$i++){
        $a=($a+1)%256;
        $j=($j+$box[$a])%256;
        $tmp=$box[$a];
        $box[$a]=$box[$j];
        $box[$j]=$tmp;
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
    }
    if($operation=='D'){
        if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){
            return substr($result,8);
        }else{
            return'';
        }
    }else{
        return str_replace('=','',base64_encode($result));
    }
}
/**
 * 密码加密
 *
 * @access  public
 * @param   array
 * @return  boolen
 */
function password_encrypt($password){
    $key = 'asdi9ckjv9';
    $string = md5(substr(md5($key),0,10).md5($password));
    return $string;
}
/*********************************************************************
函数名称:dele_pic
函数作用:删除多余的文件
*********************************************************************/
function dele_file($path='',$except = array()){
    //删除旧的照片
    $dh=opendir($path);
    while ($file=readdir($dh)) {
        if($file!="." && $file!="..") {
            $fullpath=$path."/".$file;
            if( !is_dir($fullpath) && !in_array($file,$except) ) {
                unlink($fullpath);
            }
        }
    }
    closedir($dh);
}
function curl_get( $url){
    //初始化
    $ch = curl_init();
    //设置选项，包括url
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_HEADER, false );
    //执行并获取html内容
    $result = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);
    return $result;
}
function curl_post( $url, $params ){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$curl_params( $params ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    return $result;
}
function curl_params( $params ){
    $json = "";
    foreach( $params as $key => $value ){
            $json .= "$key=$value&";
    }
    $json = substr($json, 0,-1);
    return urldecode($json);
}
function gbk2utf8( $str ){
    return iconv( 'GB18030', 'UTF-8', $str);
}