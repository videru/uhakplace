<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  ���������� : 
 ===================================================== */

$name = array('1'=>'Los Angeles','2'=>'San Diego','3'=>'San Francisco','4'=>'Chicago',); // �̱� ����

$_const['state'] = array('1'=>array()//��������
                        ,'2'=>array()//ȣ��
                        ,'3'=>array()//�ʸ���
                        ,'4'=>array()//����
                        ,'5'=>array()//ĳ����
                        ,'6'=>array('1'=>'Alrabama(AL)'
                                   ,'2'=>'Arizona(AZ)'
                        		          ,'3'=>'Arkansas(AR)'
                        		          ,'4'=>'California(CA)'
                        		        //  ,.....//5���� 12���� ������...
                        		          ,'13'=>'Illinois(IL)'
                        		   )//�̱�
                        ); //  

$_const['statecitynum'] = array('1'=>array()//��������
                        		,'2'=>array()//ȣ��
		                        ,'3'=>array('1'=>array(1,2,3,4,5,6))//�ʸ���
		                        ,'4'=>array()//����
		                        ,'5'=>array()//ĳ����
		                        ,'6'=>array('1'=>array()//Alrabama(AL)
		                        		          ,'2'=>array()//Arizona(AZ)
		                        		          ,'3'=>array()//Arkansas(AR)
		                        		          ,'4'=>array('1','2','3')//California(CA).. ���ڴ� ���� $_const['area6']�� �̱��� �п� ���� ������
		                        		  //        ,...//5���� 12���� ������..
		                        		          ,'13'=>array('4') //Illinois(IL).. ���ڴ� ���� $_const['area6']�� �̱��� �п� ���� ������
		                        		          )//�̱�
                        ); // 


?>
