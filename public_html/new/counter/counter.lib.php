<?
/* =====================================================

  ���������� : 
 ===================================================== */
 
	// ī���� �������
	$rg_counter_use=true;

	// �α׸� ������ (�α׸� �ȳ���ٸ� �α״� 1�ϱ����� �����ϰ� �������� ����)
	$rg_counter_log_on=true;
	
	// �Ϲ� �湮�ڵ� ���ȭ���� ���� �ִ��� true ���� �ִ�, false ���� ����
	$rg_counter_access_guest=false;

	// �˻����� ���
	$search_engines['naver.com']=array('���̹�','query');
	$search_engines['empas.com']=array('���Ľ�','q');
	$search_engines['daum.net']=array('����','q');
	$search_engines['nate.com']=array('����Ʈ','Query');
	$search_engines['dreamwiz.com']=array('�帲����','q');
	$search_engines['yahoo.com']=array('����','p');
	$search_engines['google.co.kr']=array('����','q');
	$search_engines['google.com']=array('����','q');
	$search_engines['paran.com']=array('�Ķ�','Query');
	$search_engines['korea.com']=array('�ڸ��ƴ���','keyword');
	$search_engines['msn.co.kr']=array('MSN','q');

	$weeks=array(0=>'��',1=>'��',2=>'ȭ',3=>'��',4=>'��',5=>'��',6=>'��');

	// �����ڵ� ���ڵ�
	function urlutfchr($text){
		return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'unitostring', $text));
	}	

	function unitostring($text){
		return iconv('UTF-16LE', 'UHC', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2))));
	}
	
	function check_conv_utf_kr($str) { // �����ڵ� Ȯ�� �Ͽ� ��ȯ�ϱ�
		if(iconv("EUC-KR","EUC-KR",$str)==$str) {
			return $str;
		} else {
			return iconv("UTF-8","EUC-KR",$str);
		}
	}
?>