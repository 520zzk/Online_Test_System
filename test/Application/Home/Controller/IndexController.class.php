<?php
namespace Home\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class IndexController extends Controller {
    public function index(){
		if (!session('?kaohao')){		
		   $this->redirect('login');		
		}
		//程序能够向下，说明是合法登录
		$shiti = M('shiti');
		$kaosheng = M('kaosheng');
		$total = 10;                  //考试题目数
		$where['kaohao'] = session('kaohao');
		$a = $kaosheng->where($where)->find();
		/**判断有没有题目 */
		if (strlen($a['timu']) == 0 ){
		  $all = $shiti->order('id')->select();
		  $key = array_rand($all,$total);
		  $timu_str = serialize($key);
		 dump($key);
		 dump($timu_str);
		  $a['timu'] = $timu_str;
		  $kaosheng->save($a);		  
		}else{
		  $key = unserialize($a['timu']); 
		}	
		
		$no = I('get.no',1);
					/**上一页的存入数据可 */
			if(isset($_POST['Last'])){
				$daan = unserialize($a['daan']);
				$daan[$no+1] = implode('',$_POST['zzk']);
				$a['daan']= serialize($daan);
				$kaosheng->save($a);
			}
			/**下一页的存入数据可 */
			if(isset($_POST['Next'])){
			
				$daan = unserialize($a['daan']);
				$daan[$no-1] = implode('',$_POST['zzk']);
				$a['daan']= serialize($daan);
				$kaosheng->save($a);
			}
			/**交卷处理 */
			if(isset($_POST['give'])){
				$m['id']  = array('like',$key);
				$c=$shiti->where($m)->select();
				$daan = unserialize($a['daan']);
				$biaoda=array();
				for($i=0;$i<$total;$i++){
					array_push($biaoda,$c[$i]['biaoda']);
					if($c[$i]['biaoda']==$daan[$i]){
						$fenshu+=$c[$i]['fenzhi'];
					}
					
				}
				$a['fenshu']=$fenshu;
				$kaosheng->save($a);
				$len=count($biaoda);
				$this->assign('on',1);
				$this->assign('biaoda',$biaoda);
				$this->assign('len',$len);
				$this->assign('zida',$daan);
				$this->assign('fenshu',$fenshu);
				
			}
		/**防止超出 */
		if($no==$total){
			$no=$total-1;
		}
		//当前考题序号（一道题）
		$current = $shiti->find($key[$no]);   //考试题目
		$daan = $a['daan'];                      //考生的答案，字符串
		$daan = unserialize($daan);              //全部答案，数组  
		$dan_cu = $daan[$no];                  //当前题目的答案
		$tixing = strlen($current['biaoda']);
		session('no',$no);
		session('total',$total);
		$this->assign('stu_info',$a);
		$this->assign('no',$no);
		$this->assign('total',$total);		
		$this->assign('current',$current);	
		$this->assign('daan',$daan);	
		$this->assign('tixing',$tixing);
		$this->assign('dan_cu',$dan_cu);
		$this->show();
		// $this->redirect('Home/Index/index/no/'.$no);
    }
    public function login(){
       if (isset($_POST['bt1'])){
	      $kaosheng = M('kaosheng');
		  $count = $kaosheng->where($_POST)->count();
		  if ($count){
		     session('kaohao',$_POST['kaohao']);
			 $this->redirect('index');			 
		  }else{
		     $this->error('考号或者密码错误','login');
		  }		  
	   }else{ 
			 $this->show();  

		 }	   
	  
	}

	public function tuichu(){
		session(null);
		$this->error('退出成功请稍后。。。。。','login');
	 }	 
 
}