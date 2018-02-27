<?php
namespace app\index\Model;
use think\Model;
class User extends Model{
    protected $auto=['userpass'];
    public function profile()
    {
        return $this->hasOne('Dep','dep_id','dep_id');
    }
    public function setUserpassAttr($value){
        return md5($value.KKK);
    }
}