<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class user extends Controller {
	public function index(){
//---------------------------------------添加一条数据返回影响行数
// $afectrows=Db::name('user')->insert(array('user_name'=>'张三','user_pass'=>'123'));
//if($afectrows){
//return "添加成功";
// }else{
// return "添加失败";
//	 }
//--------------------------------------获得最后id
	  //$afectrows=Db::name('user')->insertGetId(array('user_name'=>'李四','user_pass'=>'123'));
      //return $afectrows;
//---------------------------------------添加多条数据
//$arrdata=[
//        ['user_name'=>'l1','user_pass'=>'111'],
//	    ['user_name'=>'l2','user_pass'=>'123'],
//	    ['user_name'=>'l3','user_pass'=>'123']
//];
//     $afectrows=Db::name('user')->insertAll($arrdata);
//	 return $afectrows;
//----------------------------------查询
//$arr=Db::table('oa_user')->select();
//$arr2=Db::name('user')->limit(3,3)->select();
//$arr3=Db::name('user')->order('RAND()')->limit(3)->select();
//$arr4=Db::name('user')->value('user_pass');
//$arr5=Db::name('user')->column('user_pass','user_id');
//$arr6=Db::name('user')->column('*');
//--------------------------修改  update
// $data=Db::table('oa_user')->where('user_id','1')->update(['user_name'=>'kangming','user_pass'=>'qqq']);
// $data2=Db::table('oa_user')->where('user_id','2')->setInc('user_score','10');//自增setDec为自减
 //$data3=Db::table('oa_user')->update(['user_id'=>3,'user_name'=>'xiaoer']);//自增setDec为自减
//------------------------删除
//Db::table('oa_user')->where('user_id','2')->delete();
//Db::table('oa_user')->delete([1,2]);
//------------聚合查询总数
//$coun=Db::table('oa_user')->count();


//$max=Db::table('oa_user')->max('user_score');


//Db::table('oa_user')->whereTime( `user_time`, 'BETWEEN ', ['2013-1-1','2017-1-1'])->select();
        $timequjian= Db::table('oa_user')->whereTime('user_time', 'between', ['1970-10-1', '2017-10-1'])->select();
        dump($timequjian) ;


return $this->fetch('hellow',['name'=>'thinkphp']);

	}
}