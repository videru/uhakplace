<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 
 ===================================================== */

$name = array('1'=>'Los Angeles','2'=>'San Diego','3'=>'San Francisco','4'=>'Chicago',); // 미국 지역

$_const['state'] = array('1'=>array()//뉴질랜드
                        ,'2'=>array()//호주
                        ,'3'=>array()//필리핀
                        ,'4'=>array()//영국
                        ,'5'=>array()//캐나다
                        ,'6'=>array('1'=>'Alrabama(AL)'
                                   ,'2'=>'Arizona(AZ)'
                        		          ,'3'=>'Arkansas(AR)'
                        		          ,'4'=>'California(CA)'
                        		        //  ,.....//5부터 12까지 쓰세욤...
                        		          ,'13'=>'Illinois(IL)'
                        		   )//미국
                        ); //  

$_const['statecitynum'] = array('1'=>array()//뉴질랜드
                        		,'2'=>array()//호주
		                        ,'3'=>array('1'=>array(1,2,3,4,5,6))//필리핀
		                        ,'4'=>array()//영국
		                        ,'5'=>array()//캐나다
		                        ,'6'=>array('1'=>array()//Alrabama(AL)
		                        		          ,'2'=>array()//Arizona(AZ)
		                        		          ,'3'=>array()//Arkansas(AR)
		                        		          ,'4'=>array('1','2','3')//California(CA).. 숫자는 위의 $_const['area6']즉 미국의 학원 숫자 순서임
		                        		  //        ,...//5부터 12까지 쓰세욤..
		                        		          ,'13'=>array('4') //Illinois(IL).. 숫자는 위의 $_const['area6']즉 미국의 학원 숫자 순서임
		                        		          )//미국
                        ); // 


?>
