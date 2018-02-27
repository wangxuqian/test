<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

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
//$arr3=Db::name('user')->order('RAND()')->limit(3)->select();//随机取出三条
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
        //同理  Max  avg   min    sum


//Db::table('oa_user')->whereTime( `user_time`, 'BETWEEN ', ['2013-1-1','2017-1-1'])->select();
        $timequjian= Db::table('oa_user')->whereTime('user_time', 'between', ['1970-10-1', '2017-10-1'])->select();
        dump($timequjian) ;


return $this->fetch('hellow',['name'=>'thinkphp']);

	}
	public function show(){
	    //分页显示
        $list = Db::table('oa_user')->alias('u')->join('oa_dep d','u.dep_id=d.dep_id')->paginate(3);
        //翻页条
        $page = $list->render();
        //分配数据
        $this->assign('data', $list);
        $this->assign('page', $page);
	     return $this->fetch();
    }
    public function delete(Request $request){
	    $id=$request->param('id');
        try{
            $res=Db::table('oa_user')->delete($id);
        }catch(\Exception $e){
            $this->error($e.'删除失败','show');
         }
          $this->success('删除成功!','show');

      }
      public function edit(){
	    if(empty($_POST)){
	        $id=Request::instance()->param('id');
	        $data=Db::table('oa_user')->find($id);
	        $this->assign('data',$data);
	        return  $this->fetch();
	        }else{
            $res=Db::table('oa_user')->update($_POST);
            if($res>0){
                $this->success('更新成功','show');
            }else{
                $this->error('更新失败','show');
            }
            }
      }
      public function login(Request $request){
	    if(empty($_POST)){
	       return $this->fetch();
        }else {
            $count=Db::table('oa_user')->where($_POST)->count();
          if($count==1){
              $id=Db::table('oa_user')->field('userid')->where($_POST)->find();
              Session::set('id',$id['userid']);
              Session::set('username',$request->post('username'));
              $this->success('登陆成功','show');
          }else{
               $this->error('该账户不存在');
          }
            }
      }
    public function uploadd(){
	       return $this->fetch();
	}
	public function phoadd(){
	    $id=Request::instance()->param('id');
	    $this->assign('id',$id);
        return $this->fetch();
    }
    public function phoadddo(){

                $file = Request::instance()->file('pho');
                $arr['id']=Request::instance()->post('id');
            if($file){
            $info = $file->move(ROOT_PATH .'public/uploads');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                echo $info->getExtension();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }
//	public function uploaddo(){
//        $file = Request::instance()->file('pho');
//        if($file){
//            $info = $file->move(ROOT_PATH .'public/uploads');
//            if($info){
//                // 成功上传后 获取上传信息
//                // 输出 jpg
//                echo $info->getExtension();
//            }else{
//                // 上传失败获取错误信息
//                echo $file->getError();
//            }
//        }
//    }
public function uploaddo(){
        $files = Request::instance()->file('image');
	    foreach ($files as $key=>$file){

        // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['size'=>200000,'ext'=>'jpg,png,gif'])->move(ROOT_PATH .'public/uploads');
        if($info){
            $afectrows=Db::name('oa_user')->update(array('user_name'=>'张三','user_pass'=>'123'));
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo 1;

        }else{
            // 上传失败获取错误信息
           $this->error( $file->getError());
        }
    }
}
public function add(){
    if(empty($_POST)){
        return  $this->fetch();
    }else{
        $user=new \app\index\Model\User();
        $res=$user->save(Request::instance()->post());
        if($res>0){
            $this->success('添加成功','show');
        }else{
            $this->error('添加失败','show');
        }
    }
}
}