<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  ���������� : 
 ===================================================== */
 $_const['area1']			= array('1'=>'��Ŭ����','2'=>'ũ���̽�Ʈ��ġ','3'=>'������','4'=>'��Ÿ'); // ������������	
	$_const['area2']			= array('1'=>'�õ��','2'=>'�긮����','3'=>'�۽�','4'=>'���','5'=>'ȣ��Ʈ','6'=>'�ɾ���','7'=>'��Ÿ����' ,'8'=>'�ֵ鷹�̵�','9'=>'����ڽ�Ʈ'); // ȣ������
	$_const['area3']			= array('1'=>'Manila','2'=>'Cebu','3'=>'�ٱ��','4'=>'Iloilo','5'=>'Bacolod','6'=>'��Ÿ����','7'=>'Clark','8'=>'Davao','9'=>'Bagio','10'=>'Subic','11'=>'Tarlac','12'=>'Tagaytay'); // �ʸ�������	
	$_const['area4']			= array('1'=>'����','2'=>'�긮��Ʋ','3'=>'��������','4'=>'ķ�긴��','5'=>'���ӽ�','6'=>'��Ÿ����','7'=>'Eastbourne','8'=>'Manchester'); // ��������
	$_const['area5']			= array('1'=>'Calgary','2'=>'Halifax','3'=>'Montreal','4'=>'Ottawa','5'=>'Surrey','6'=>'Toronto','7'=>'Vancouver','8'=>'Victoria','9'=>'Whistler'); //ĳ����
 
$_const['area6'] = array('1'=>'Los Angeles','2'=>'San Diego','3'=>'San Francisco','4'=>'Chicago','5'=>'Boston','6'=>'New York City','7'=>'Seattle'); // �̱� ����

$_const['state'] = array('1'=>array('1'=>'����'
						           ,'2'=>'�ϼ�'												
                         )//��������
                        ,'2'=>array('1'=>'ACT'
					               ,'2'=>'NSW'
								   ,'3'=>'NT'
								   ,'4'=>'QLD'
								   ,'5'=>'SA'
								   ,'6'=>'TSA'
							       ,'7'=>'VIC'
								   ,'8'=>'WA'	
						)//ȣ��
                        ,'3'=>array()//�ʸ���
                        ,'4'=>array('1'=>'Bournemouth'
					               ,'2'=>'Brighton'
								   ,'3'=>'Cambridge'
								   ,'4'=>'Eastbourne'
								   ,'5'=>'London'
								   ,'6'=>'Manchester'
								   ,'7'=>'Oxford'
						)//����
                        ,'5'=>array('1'=>'Alberta'
						            ,'2'=>'British Columbia'
									,'3'=>'Manitoba'
									,'4'=>'New Brunswick'
									,'5'=>'Newfoundland'
									,'6'=>'Northwest Territories'
									,'7'=>'Nova Scotia'
									,'8'=>'Nunavut'
									,'9'=>'Ontario'
									,'10'=>'Prince Edward Island'
									,'11'=>'Quebec'
									,'12'=>'Saskatchewan'
									,'13'=>'Yukon Territory'
						)//ĳ����
                        ,'6'=>array('1'=>'Alrabama(AL)'
                                   ,'2'=>'Arizona(AZ)'
                        		          ,'3'=>'Arkansas(AR)'
                        		          ,'4'=>'California(CA)'
										  ,'5'=>'Colorado(CO)'
										  ,'6'=>'Connecticut(CO)'
										  ,'7'=>'Delaware(DE)'
										  ,'8'=>'District of Columbia(DC)'
										  ,'9'=>'Florida(FL)'
										  ,'10'=>'Georgia(GA)'
										  ,'11'=>'Hawaii(HI)'
										  ,'12'=>'Idaho(ID)'
                        		          ,'13'=>'Illinois(IL)'
									      ,'14'=>'Indiana(IN)'
										  ,'15'=>'Iowa(IA)'
										  ,'16'=>'Kansas(KS)'
										  ,'17'=>'Kentucky(KY)'
										  ,'18'=>'Louisiana(LA)'
										  ,'19'=>'Maine(ME)'
										  ,'20'=>'Maryland(MD)'
										  ,'21'=>'Massachusetts(MA)'
										  ,'22'=>'Michigan(MI)'
										  ,'23'=>'Minnesota(MN)'
										  ,'24'=>'Mississippi(MS)'
										  ,'25'=>'Missouri(MO)'
										  ,'26'=>'Montana(MT)'
										  ,'27'=>'Nebraska(NE)'
										  ,'28'=>'Nevada(NV)'
										  ,'29'=>'New Hampshire(NH)'
										  ,'30'=>'New Jersey(NJ)'
										  ,'31'=>'New Mexico(NM)'
										  ,'32'=>'New York(NY)'
										  ,'33'=>'North Carolina(NC)'
										  ,'34'=>'North Dakota(ND)'
										  ,'35'=>'Ohio(OH)'
										  ,'36'=>'Oklahoma(OK)'
										  ,'37'=>'Oregon(OR)'
										  ,'38'=>'Pennsylvania(PA)'
										  ,'39'=>'Rhode Island(RI)'
										  ,'40'=>'South Carolina(SC)'
										  ,'41'=>'South Dakota(SD)'
										  ,'42'=>'Tennessee(TN)'
										  ,'43'=>'Texas(TX)'
										  ,'44'=>'Utah(UT)'
										  ,'45'=>'Vermont(VT)'
										  ,'46'=>'Virginia(VI)'
										  ,'47'=>'Washington(WA)'
										  ,'48'=>'West Virginia(WV)'
										  ,'49'=>'WisconsinWI(WI)'
										  ,'50'=>'Wyoming(WY)'										 
                        		   )//�̱�
                        ); //  

$_const['statecitynum'] = array('1'=>array('1'=>array()//����
											,'2'=>array(1)//�ϼ�

								)//��������
                        		,'2'=>array('1'=>array()//Canberra
								           ,'2'=>array()//��Ÿ����
										   ,'3'=>array(1)//Sydney	
								)//ȣ��
		                        ,'3'=>array('1'=>array('1','2','3','4','5','6'))//�ʸ���
		                        ,'4'=>array()//����
		                        ,'5'=>array()//ĳ����
		                        ,'6'=>array('1'=>array()//Alrabama(AL)
		                        		          ,'2'=>array()//Arizona(AZ)
		                        		          ,'3'=>array()//Arkansas(AR)
		                        		          ,'4'=>array('1','2','3')//California(CA)
												  ,'5'=>array()//Colorado(CO)
												  ,'6'=>array()//Connecticut(CO)
									  			  ,'7'=>array()//Delaware(DE)
												  ,'8'=>array()//District of Columbia(DC)
												  ,'9'=>array()//Florida(FL)
												  ,'10'=>array()//'Georgia(GA)
										 	   	  ,'11'=>array()//Hawaii(HI)
										 		  ,'12'=>array()//Idaho(ID)
		                        		          ,'13'=>array('4')//Illinois(IL)
												  ,'14'=>array()//Indiana(IN)
												  ,'15'=>array()//Iowa(IA)
												  ,'16'=>array()//Kansas(KS)
												  ,'17'=>array()//Kentucky(KY)
												  ,'18'=>array()//Louisiana(LA)
												  ,'19'=>array()//Maine(ME)
												  ,'20'=>array()//Maryland(MD)
												  ,'21'=>array('5')//Massachusetts(MA)
												  ,'22'=>array()//Michigan(MI)
												  ,'23'=>array()//Minnesota(MN)
												  ,'24'=>array()//Mississippi(MS)
												  ,'25'=>array()//Missouri(MO)
												  ,'26'=>array()//Montana(MT)
												  ,'27'=>array()//Nebraska(NE)
												  ,'28'=>array()//Nevada(NV)
												  ,'29'=>array()//New Hampshire(NH)
												  ,'30'=>array()//New Jersey(NJ)
												  ,'31'=>array()//New Mexico(NM)
												  ,'32'=>array('6')//New York(NY)
												  ,'33'=>array()//North Carolina(NC)
												  ,'34'=>array()//North Dakota(ND)
												  ,'35'=>array()//Ohio(OH)
												  ,'36'=>array()//Oklahoma(OK)
												  ,'37'=>array()//Oregon(OR)
												  ,'38'=>array()//Pennsylvania(PA)
												  ,'39'=>array()//Rhode Island(RI)
												  ,'40'=>array()//South Carolina(SC)
												  ,'41'=>array()//South Dakota(SD)
												  ,'42'=>array()//Tennessee(TN)
												  ,'43'=>array()//Texas(TX)
												  ,'44'=>array()//Utah(UT)
												  ,'45'=>array()//Vermont(VT)
												  ,'46'=>array()//Virginia(VI)
												  ,'47'=>array('7')//Washington(WA)
												  ,'48'=>array()//West Virginia(WV)
												  ,'49'=>array()//WisconsinWI(WI)
												  ,'50'=>array()//'Wyoming(WY)	
											    										   
		                        		          )//�̱�
                        ); // 


?>
