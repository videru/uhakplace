<?
	$new_time=24;
	$skin_new_icon = " <img src='{$skin_path}images/new.gif' border='0'>";
	$date_format = '%m-%d';
	//�Ʒ� ���� �̹���
	$_skin_thumb_image_width=70;
	$_skin_thumb_image_height=64;
	//�� ū �̹���
	//$_skin_image_width=262;
	//$_skin_image_height=238;
	$_skin_image_width=($_skin_thumb_image_width+6)*$list;
	$_skin_image_height=$_skin_thumb_image_height*$list;

/*
	switch($bbs_code) {
		case "notice":
			$bbs_name="��������";
			$bbs_text="���������� �����ؼ� �÷��Ӵϴ�.<br>�׻�Ȯ���ϼ���~";
		break;
		case "free":
			$bbs_name="�����Խ���";
			$bbs_text="����̵� ���Ŀ� ���־��� �����Ӱ� ���� ���ּ���<br>��! ����� Ȯ����� ����!!! ����";
		break;
		case "talk":
			$bbs_name="���ǻ���";
			$bbs_text="�������� �������� ������ �ϱ�۵��� �ۼ��մϴ�.<br>�̱��� ������ �������̶� �������� ģ���� �־�� ��!";
		break;
		case "rgboard":
			$bbs_name="����������";
			$bbs_text="�������带 ������� ����Ʈ�� ����鼭<br>�˰Ե� ������������ �����ؼ� �÷��Ӵϴ�.";
		break;
		case "skin":
			$bbs_name="�������彺Ų";
			$bbs_text="�������� ����ڿ��� ������ ��Ų����<br>�����ؼ� �����մϴ�.";
		break;
		case "freesrc":
			$bbs_name="�������α׷�";
			$bbs_text="PHP�� �̿��� �������α׷��� �����մϴ�.<br>�����Ǵ� ���α׷��� ���������� �����ʽ��ϴ�. ^^";
		break;
		case "photo":
			$bbs_name="����ø";
			$bbs_text="�̻ڴ� �����̳� ���� ǳ������� ��ƺ���~";
		break;
	}
	*/
?>