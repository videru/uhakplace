<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  ���������� : 
 ===================================================== */

	if(isset($_REQUEST['site_path']) || isset($_REQUEST['site_url'])) exit;
	if(!isset($site_path)) $site_path='../';
	if(!isset($site_url)) $site_url='../';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';	
	
	$_table									= array(); // ���̺�� �迭
	$_table['prefix']				= 'rg4_';	// ���̺�� ���ξ�
	$_table['member']				= $_table['prefix'].'member';	// ȸ��
	$_table['group']				= $_table['prefix'].'group';	//	�׷�
	$_table['gmember']			= $_table['prefix'].'gmember';	//	�׷�ȸ��
	$_table['bbs_cfg']			= $_table['prefix'].'bbs_cfg';	//	�Խ��Ǽ���
	$_table['bbs_body']			= $_table['prefix'].'bbs_body';	//	�Խ��� ����
	$_table['bbs_comment']	= $_table['prefix'].'bbs_comment';	//	�Խ��� �ڸ�Ʈ
	$_table['bbs_category']	= $_table['prefix'].'bbs_category';	//	�Խ��� ī�װ�
	$_table['setup']				= $_table['prefix'].'setup';	//	����Ʈ����
	$_table['point']				= $_table['prefix'].'point';	//	����Ʈ����
	$_table['note']					= $_table['prefix'].'note';	//	����
	$_table['zip']					= $_table['prefix'].'zip';	//	�����ȣ

	$_table['school']				= $_table['prefix'].'school';	//	�б�
	$_table['school_cost']				= $_table['prefix'].'school_cost';	//	�б�
	$_table['pre_regi']			    	= $_table['prefix'].'pre_regi';	//	��Ȥ��Ȳ
	$_table['regi']			    	= $_table['prefix'].'regi';	//	��Ȥ��Ȳ
	$_table['relaship']			   	= $_table['prefix'].'relaship';	//	���迬��
	$_table['online']			   	= $_table['prefix'].'online';	//	����û
    $_table['real_regi']          	= $_table['prefix'].'real_regi';	//	���ϼ�����Ȳ
    $_table['ger_sangdam']          	= $_table['prefix'].'ger_sangdam';	//	���ϻ����Ȳ
    $_table['consult']          	= $_table['prefix'].'consult';	//	���޹���
    $_table['cf']          	= $_table['prefix'].'cf';	//	������
    $_table['working']          	= $_table['prefix'].'working';	//	��������
    $_table['today_work']          	= $_table['prefix'].'today_work';	//	�ֿ�����
	$_table['camp_regi']					= $_table['prefix'].'camp_regi';	//	ķ�����
	$_table['exchange']					= $_table['prefix'].'exchange';	//	ȯ��
	$_table['account_kyejung']					= $_table['prefix'].'account_kyejung';	//	ȸ��	
	$_table['account']					= $_table['prefix'].'account';	//	ȸ��	
	$_table['st_account']					= $_table['prefix'].'st_account';	//	ȸ��	
	$_table['regi_account']					= $_table['prefix'].'regi_account';	//	����ȸ��		
	$_table['camp']					= $_table['prefix'].'camp';	//	ķ�����
	$_table['ju_school']					= $_table['prefix'].'ju_school';	//	ķ�����
 	$_table['young']					= $_table['prefix'].'young';	//	ķ�����
 	$_table['intern']					= $_table['prefix'].'intern';	//	ķ�����
 	$_table['hp_site']					= $_table['prefix'].'hp_site';	//	ķ�����
 	$_table['consult']					= $_table['prefix'].'consult';	//	ķ�����
 	$_table['cafe_member']					= $_table['prefix'].'cafe_member';	//	ķ�����
    $_table['ca_mem_comm']		= $_table['prefix'].'ca_mem_comm';	
	$_table['alim']					= $_table['prefix'].'alim';	//	�����ȣ	
 	$_table['cafe_online']					= $_table['prefix'].'cafe_online';	//	ķ�����
	$_table['sms']					= $_table['prefix'].'sms';	//	�����ȣ
	$_table['main_regi']					= $_table['prefix'].'main_regi';	//	�����ȣ


	$_path							= array(); // �������� ���
	$_path['site']			= $site_path;	// �⺻���
	// ����Ʈ PATH
	$_path['bbs']				= $_path['site'].'board/';	// �Խ���
	$_path['css']				= $_path['site'].'css/';	// ��Ÿ�Ͻ�Ʈ
	$_path['member']		= $_path['site'].'member/';	// ȸ��
	$_path['js']				= $_path['site'].'js/';	// ��ũ��Ʈ
	$_path['admin']			= $_path['site'].'admin/';	// ������
	$_path['counter']		= $_path['site'].'counter/';	// ī����
	$_path['inc']				= $_path['site'].'include/';	// ���̺귯����
	$_path['mail_form']	= $_path['site'].'mail/';	// �̸����ּҰ��
	$_path['skin']			= $_path['site'].'skin/';	// ��Ų���
	// ��Ų PATH
	$_path['bbs_skin']	= $_path['skin'].'board/';	// �Խ��� ��Ų
	$_path['login_skin']= $_path['skin'].'login/';	// �α��� ��Ų
	$_path['last_skin']	= $_path['skin'].'last/';	// �ֱٱ� ��Ų
	// ����Ÿ PATH
	$_path['data']			= $_path['site'].'data/';	// ����Ÿ����
	$_path['member_data']	= $_path['data'].'member/';	// ȸ�� ����Ÿ����
	$_path['bbs_data']	= $_path['data'].'board/';	// �Խ��� ÷������
	$_path['session']		= $_path['data'].'session/';	// ����

	$_url								= array(); // URL �����
	$_url['site']				= $site_url;	// �⺻���
	// ����Ʈ URL
	$_url['bbs']				= $_url['site'].'board/';	// �Խ���
	$_url['css']				= $_url['site'].'css/';	// ��Ÿ�Ͻ�Ʈ
	$_url['member']			= $_url['site'].'member/';	// ȸ��
	$_url['newmember']			= $_url['site'].'newmember/';	// ȸ��
	$_url['js']					= $_url['site'].'js/';	// ��ũ��Ʈ
	$_url['admin']			= $_url['site'].'admin/';	// ������
	$_url['counter']		= $_url['site'].'counter/';	// ī����
	$_url['mail_form']	= $_url['site'].'mail/';	// �̸����ּҰ��
	$_url['skin']				= $_url['site'].'skin/';	// ��Ų���
	// ��Ų URL
	$_url['bbs_skin']		= $_url['skin'].'board/';	// �Խ��� ��Ų
	$_url['login_skin']	= $_url['skin'].'login/';	// �α��� ��Ų
	$_url['last_skin']	= $_url['skin'].'last/';	// �ֱٱ� ��Ų

	// �������
	$_const = array();
	$_const['member_states']		= array(0=>'���',1=>'����',2=>'�̽���',3=>'Ż��'); // ȸ������
	$_const['group_states']			= array(0=>'���',1=>'����',2=>'�̽���',3=>'���');	// �׷����
	$_const['group_level_type']	= array(0=>'ȸ������',1=>'�׷췹��');	// �׷췹�� ������

	$_const['admin_level']			= 90;	// �ְ� ������ ����
	$_const['group_admin_level']= 50;	// �׷� ������ ����
	$_const['sex']							= array('M'=>'����','F'=>'����'); // ����

	$_const['member_form_state'] = array(0=>'������',1=>'����',2=>'�ʼ�');
	$_const['member_forms'] = array(
		'mb_name' => '�̸�',
		'mb_nick' => '�г���',
		'mb_email' => '�̸���',
		'mb_jumin' => '�ֹε�Ϲ�ȣ',
		'mb_tel1' => '��ȭ��ȣ',
		'mb_tel2' => '�ڵ�����ȣ',
		'mb_address' => '�ּ�',
		'mb_signature' => '����',
		'mb_introduce' => '�ڱ�Ұ�',
		'photo1' => '����',
		'icon1' => 'ȸ��������'
	);


	$_const['national']			= array('1'=>'��������','2'=>'ȣ��','3'=>'�ʸ���','4'=>'����','5'=>'ĳ����','6'=>'�̱�'); // ����
	$_const['national01']			= array('1'=>'��������','2'=>'ȣ��','3'=>'�ʸ���','4'=>'����','5'=>'ĳ����','6'=>'�̱�'); // ����
	$_const_uhak['national']	= array('6'=>'�̱�','2'=>'ȣ��','1'=>'��������','3'=>'�ʸ���','5'=>'ĳ����'); // ����

	$_const_main['national']	= array('1'=>'�ʸ���','2'=>'ȣ��','3'=>'ĳ����'); // ����

	$_camp_list['camp']	= array('1'=>'�ʸ��� ���� ����/���� ķ��','2'=>'�ʸ��� �Ϸ��Ϸ� ���� ���� ķ��'); // ķ��
	
	$_camp_s_list['camp']	= array('1'=>'����','2'=>'�Ϸ��Ϸ�'); // ķ��

	$_const['area1']			= array('1'=>'��Ŭ����','2'=>'ũ���̽�Ʈ��ġ','3'=>'������','4'=>'��Ÿ'); // ������������	
	$_const['area2']			= array('1'=>'�õ��','2'=>'�긮����','3'=>'�۽�','4'=>'���','5'=>'ȣ��Ʈ','6'=>'�ɾ���','7'=>'��Ÿ����'); // ȣ������
	$_const['area3']			= array('1'=>'���Ҷ�','2'=>'����','3'=>'�ٱ��','4'=>'�Ϸ��Ϸ�','5'=>'���ݷε�','6'=>'��Ÿ����'); // �ʸ�������	
	$_const['area4']			= array('1'=>'����','2'=>'�긮��Ʋ','3'=>'��������','4'=>'ķ�긴��','5'=>'���ӽ�','6'=>'��Ÿ����'); // ��������
	$_const['area5']			= array('1'=>'','2'=>'','3'=>'','4'=>'','5'=>'','6'=>'��Ÿ����'); // ĳ��������

     $_const['root']  = array('1'=>'���̹� ��������','2'=>'���̹� ȣ��','3'=>'���̹� ����','4'=>'���̹� ĳ����','5'=>'���̹� �ʸ���','6'=>'���� ȣ��&��������','7'=>'��ȭ','8'=>'�޽���','9'=>'Ȩ������','10'=>'��Ÿ'); // ���Ӱ��
	$_regi['rgi']			= array('1'=>'ī��','2'=>'Ȩ������'); // ����

	$_const['section']			= array('1'=>'���п���','2'=>'��������'); // ����

	$_regi['national']			= array('1'=>'�ʸ���','2'=>'ĳ����','3'=>'ȣ��','4'=>'����','5'=>'�ʸ���+ȣ��','6'=>'�ʸ���+ĳ����','7'=>'�ʸ���+ȣ��','8'=>'�ʸ���+����'); // ����
	$_regi['chain']			= array('1'=>'����','2'=>'�λ�'); // ����

	$_reserv['transaction']			= array('1'=>'������','2'=>'��ȭ���','3'=>'����Ϸ�','4'=>'���࿬��'); // �湮��㿹��

	$_reserv['sangdam']			= array('1'=>'ó�����','2'=>'�����','3'=>'���Ϸ�'); // �湮��㿹��

	$_reserv['sang']			= array('1'=>'�����','2'=>'���Ϸ�'); // �湮��㿹��

    
	$_reserv['regi_state']     = array('1'=>'���ӵ����','2'=>'���ӵ�ϿϷ�'); // ��Ͽ���

	$_process['process_state']     = array('1'=>'��ϴ��','2'=>'����/���� Ȯ��','3'=>'���б� �Ա�','4'=>'���б� ���','5'=>'�װ� ����','6'=>'�װ��� �ϳ�','7'=>'�װ��� �߱�','8'=>'�к��Ա�','9'=>'�к�۱�','10'=>'�ⱹ O/T','11'=>'�ⱹ'); // ��������Ȳ

	$_relaship['national']			= array('1'=>'�ʸ���+ȣ��','2'=>'�ʸ���+ĳ����','3'=>'�ʸ���+����'); // ���迬��

    $_const['section']        = array('1'=>'���кμ�','2'=>'�缳'); // �б�����
    
	$_const['section2']        = array('1'=>'���Դ���','3'=>'��.�߰�� ����','4'=>'��.�߰�� �缳',); // �б�����

    $_const['in_out_comm']        = array('1'=>'�Ա�','2'=>'���',); // �б�����

	$_const['money_type']			= array('1'=>'��������','2'=>'��������'); // ����
    $_const['money']	= array('1'=>'��','2'=>'���','3'=>'�޷�'); // ����

    $_const['sc_type']	= array('1'=>'���ĸ�Ÿ���п�','2'=>'�ü� ���� ���п�','3'=>'�ֺ�ȯ�� ¯ ���п�','4'=>'�������� �ִ� ���п�','5'=>'1��1����5�ð��̻� ���п�','6'=>'������ ���п�','7'=>'��,�ұԸ���п�','8'=>'��Ը���п�','9'=>'���������� ���� ���п�','10'=>'���кμ� ���п�','11'=>'�پ��� �ڽ�','12'=>'IELTS'); 

   $_const[year]       = array('2010'=>'2010','2011'=>'2011','2012'=>'2012','2013'=>'2013','2014'=>'2014'); 
   $_const[month]       = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12'); 


   $_const[no]       = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'); 


   $_const[rate]       = array('0'=>'0%','1'=>'10%','2'=>'30%','3'=>'50%','4'=>'70%','5'=>'90%'); 
  
   $_const[camp_type]       = array('1'=>'�ִϾ�ķ��','2'=>'����ķ��'); 


   $_const[camp_type2]     = array('1'=>'�ִϾ��','2'=>'��������'); 


    $_const['tel']	= array('1'=>'010','2'=>'011','3'=>'016','4'=>'019','5'=>'017','6'=>'018'); // ����


   $_cafe[class_type]       = array('1'=>'�ʸ��ɾ��п���','2'=>'�ʸ���+���迬��(ȣ��, ��������, ����, ĳ����)','3'=>'ȣ��, ��������, ����, ĳ���� ����'); 

   $_cafe[gigan]       = array('1'=>'3��������','2'=>'3����~6����','3'=>'6����~12����','4'=>'12�����̻�'); 

	
	// ��� ����
	$_const['db_type']					= array();
	$_const['db_type']['MYSQL']	= array('code'=>'MYSQL','name'=>'Mysql','hname'=>'Mysql','default_port'=>'3306');
	$_const['db_type']['CUBRID']= array('code'=>'CUBRID','name'=>'Cubrid','hname'=>'ť�긮��','default_port'=>'33000');
	$_const['db_type']['ORACLE']= array('code'=>'ORACLE','name'=>'Oracle','hname'=>'����Ŭ','default_port'=>'1521');

	// ����Ʈ����
	$_po_type_code		= array('etc'=>'0','bbs'=>'1','shop'=>'2','admin'=>'10');
	$_po_type_name		= array('0'=>'��Ÿ','1'=>'�Խ���','2'=>'���θ�','10'=>'������');
	
	$_auth=false;			// ���� �ʱ�ȭ
	$_bbs_auth=false;	// �Խ��� ���� �ʱ�ȭ
	$_mb=false;				// ȸ�������ʱ�ȭ
?>

<?if(file_exists($site_path.'include/config_new.php')) include_once($site_path.'include/config_new.php');?>