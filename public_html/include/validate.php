<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================

  최종수정일 : 
 ===================================================== */
if (!defined('VALIDATE_INC_INCLUDED')) 
{
	define('VALIDATE_INC_INCLUDED', 1);
// *-- VALIDATE_INC_INCLUDED START --*
	class validate
	{
		// 아이디체크
		function userid($str)
		{
			$pattern = "/^[\200-\377a-zA-Z0-9]{1}[\200-\377a-zA-Z0-9_-]{2,11}\$/";
			return preg_match($pattern,$str);
		}
		
		// 이메일 체크
		function email($email)
		{
			$pattern = "/^[_a-zA-Z0-9-\\.]+@[\\.a-zA-Z0-9-]+\\.[a-zA-Z]+\$/";
			return preg_match($pattern,$email);
		}
		
		// 닉네임체크
		function nickname($nick) {
		 	$pattern = "/^[\200-\377a-zA-Z0-9_-]{2,12}\$/";
			return preg_match($pattern,$nick);
		}
		
		// 한글포함여부
		function has_hangul($str) {
			$pattern = "/[\200-\377]/";
			return preg_match($pattern,$str);
		}
		
		// 영문자,숫자로만 되어 있는지
		function engnumber_only($str) {
		 	$pattern = "/^[a-zA-Z0-9]+\$/";
			return preg_match($pattern,$str);
		}
		
		// 영문자로만 되어 있는지
		function eng_only($str) {
		 	$pattern = "/^[a-zA-Z]+\$/";
			return preg_match($pattern,$str);
		}
		
		// 한글로만 되어 있는지
		function han_only($str) {
			$pattern = "/^[\200-\377]+\$/";
			return preg_match($pattern,$str);
		}
	
		// 숫자로만 되어 있는지
		function number_only($str) {
			$pattern = "/^[0-9]+\$/";
			return preg_match($pattern,$str);
		}
		
		// 공백 인지 확인
		function is_empty($str) {
			$str=trim($str);
			return ((strlen($str)===0)?true:false);
		}
		
		// 주민번호 체크
		function jumin($jumin,$jumin_rtn='')
		{
			$pattern = "/^([0-9]{6})-?([0-9]{7})\$/";
			if(!preg_match($pattern,$jumin,$tmp)) return false;
			if($jumin_rtn!='')
				$GLOBALS[$jumin_rtn]=$tmp[1].'-'.$tmp[2];
			$num=$tmp[1].$tmp[2];
	
			$sum = 0;
			$last = $num[12];
			$bases = "234567892345";
			for($i=0;$i<12;$i++) {
					$sum += ($num[$i]) * ($bases[$i]);
			}
			$mod = $sum % 11;
			return ((11 - $mod) % 10 == $last);
		}
		
		// 한글(특수문자) 고려한 글자수 세기
		function han_strlen($str) {
			$len = 0;
			for($j=0; $j<strlen($str) ; $j++) {
				$chr = ord($str[$j]);
				if($chr > 128) {
					$j++;
					$chr = ord($str[$j]);
					$len++;
					if($chr <= 128) {
						$len++;
					}
				} else {
					$len++;
				}
			}
			return $len;		
		}
		
		// 글자수 크기 체크
		function strlen_chk($str,$min=NULL,$max=NULL) {
			$str=trim($str);
			$len=strlen($str);
			if($min !== NULL)
				if($min > $len)
					return false;

			if($max !== NULL)
				if($max < $len)
					return false;
			
			return true;	
		}

	}
} // *-- MYSQL_INC_INCLUDED END --*
?>