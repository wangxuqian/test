<?php
namespace app\index\Controller;
use app\index\model\User;
use app\index\model\Dep;
use think\Controller;
use think\Db;
use think\Request;

class Message extends Controller {
     public function index(){
        return $this->fetch();
     }
     public function indexdo(){
         $arr=Request::instance()->post();
         $file=Request::instance()->file('image');
         if($arr){
               $testuser=new User();
               $res= $testuser->data($arr)->save();
               $id=$testuser->userid;

         if($file&&$res==1){
             $info = $file->validate(['size'=>200000,'ext'=>'jpg,png,gif'])->move(ROOT_PATH .'public/uploads');
             if($info){
                 $rootpho=$info->getSaveName();
                 $filearr=['userid'=>$id,'user_photo'=>$rootpho];
                 $res=Db::table('oa_user')->update($filearr);
                 if($res){
                     $this->success('上传成功','User/show');
                 }
              }else{
                 $this->error($info->getError());
             }

           }
         }
     }
     public function update(){
         //-------------------
//        $date= User::get('17');
//        $date->username='ii';
//        $date->save();
        //查找并更新
//  在取出数据后，更改字段内容后更新数据。
//
//$user = User::get(1);
//$user->name     = 'thinkphp';
//$user->email    = 'thinkphp@qq.com';
//$user->save();
         //-----------------------------
//         $user = new User;
//         // save方法第二个参数为更新条件
//         $user->save([
//             'username'  => 'thinkphp',
//             'userpass' => 'thinkphp@qq.com'
//         ],['userid' => 18]);
//-------------------------------------------
//         $user = new User;
//         $user->save(['name' => 'thinkphp'],function($query){
//             // 更新status值为1 并且id大于10的数据
//             $query->where('status', 1)->where('id', '>', 10);
//         });
//         $user=new User();
//         $user->save(['username'=>'2222222222'],function($query0){
//
//             $query0->where('username','liu')->where('userpass','222');
//         });
//         $user = new User;
//// 显式指定更新数据操作
//         $user->isUpdate(true)
//             ->save(['userid' => 17, 'username' => 'thinkphp']);
//         $user = new User;
//// save方法第二个参数为更新条件  没有主键和条件即为添加数据
//         $user->save([
//             'username'  => 'thinkphp',
//             'userpass' => 'thinkphp@qq.com'
//         ]);
//         $user = new User;
//         $list = [
//             [ 'userid'=>17,'username'=>'thinkphp', 'userpass'=>'thinkphp@qq.com'],
//             [ 'userid'=>18,'username'=>'onethink', 'userpass'=>'onethink@qq.com']
//         ];
//         $user->saveAll($list);
         //删除
//         $user = User::get('17');
//         $user->delete();


//         User::destroy(function($query){
//
//             $query->where('userid','<',27)->whereor('userid','>',25);
//         });
//         $user = User::get('77,78,79');
//         $user2 = User::all('77,78,79');
//         $user2 = User::all([1,2,3]);
//         $user = new User();
//// 查询单个数据
//         $user->where('username', 'thinkphp')
//             ->find();
//         $user->where('username', 'thinkphp')
//             ->select();
//         $list = User::all(['userid'=>1]);
         //echo $user->username;
//         $list = User::all(function($query){
//             $query->where('status', 1)->limit(3)->order('id', 'asc');
//         });
//         foreach($list as $key=>$user){
//             echo $user->name;
//         }
//         $list = User::all(function($query){
//             $query->where('userid','<', 77)->limit(3)->order('userid', 'asc');
//         });
//         foreach ($list as $v){
//             echo $v->userid.'---------';
//         }
//           $k= User::where('userid',12)->field('userid,username')->select() ;
//           dump($k->username);
//         $data= User::where('userid',12)->field('userid,username')->find();
//          dump($data->username);
//         $user = User::get(12);
//         echo $user->username;
//         dump($user->toArray()['username']);
        // $user = User::get(12);
       //  dump(User::get(12)->profile->dep_name);
         $user=new User();
         $data = $user->find()->toArray();
         dump($user);
     }

}
