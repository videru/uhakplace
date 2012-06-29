<?
	$new_time=24;
	$skin_new_icon = " <img src='{$skin_path}images/new.gif' border='0'>";
	$date_format = '%m-%d';
	//아래 작은 이미지
	$_skin_thumb_image_width=52;
	$_skin_thumb_image_height=38;
	//위 큰 이미지
	//$_skin_image_width=262;
	//$_skin_image_height=238;
	$_skin_image_width=($_skin_thumb_image_width+6)*$list;
	$_skin_image_height=$_skin_thumb_image_height*$list;


	switch($bbs_code) {
		case "notice":
			$bbs_name="공지사항";
			$bbs_text="공지사항을 정리해서 올려둡니다.<br>항상확인하세요~";
		break;
		case "free":
			$bbs_name="자유게시판";
			$bbs_text="어떤글이든 형식에 구애없이 자유롭게 글을 써주세요<br>단! 광고는 확인즉시 삭제!!! ㅋㅋ";
		break;
		case "talk":
			$bbs_name="나의생각";
			$bbs_text="주인장의 개인적인 생각과 일기글들을 작성합니다.<br>이글을 보려면 주인장이랑 개인적인 친분이 있어야 함!";
		break;
		case "rgboard":
			$bbs_name="알지보드팁";
			$bbs_text="알지보드를 기반으로 사이트를 만들면서<br>알게된 여러정보들을 정리해서 올려둡니다.";
		break;
		case "skin":
			$bbs_name="알지보드스킨";
			$bbs_text="알지보드 사용자에게 유용한 스킨들을<br>정리해서 공개합니다.";
		break;
		case "freesrc":
			$bbs_name="공개프로그램";
			$bbs_text="PHP를 이용한 공개프로그램을 제공합니다.<br>공개되는 프로그램의 유지보수는 하지않습니다. ^^";
		break;
		case "photo":
			$bbs_name="사진첩";
			$bbs_text="이쁘니 사진이나 멋찐 풍경사진을 모아보세~";
		break;
	}
?>