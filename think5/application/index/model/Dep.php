<?php
namespace app\index\Model;
use think\Model;
class Dep extends Model{
    public function dep()
    {
        return $this->belongsTo('User');
    }

}