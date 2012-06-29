<?
	include_once("../include/lib.php");

$the = file('read.nhn.htm'); 

for($i=0; $i<sizeof($the); $i++){ 
    $input = $the[$i]; 
    preg_match_all("<img [^<>]*>", $input, $output); 

    if($output[0]){ 

        for($j=0; $j<1; $j++){ 

            // 추출 : img src="http://img.yahoo.co.kr/home/2005/purplerose/b_tphchange.gif" align="absmiddle" 
            //print $output[0][$j]; 

            $tmp_str = $output[0][$j]; 
            eregi("[^= \"']*\.(jpg)", $tmp_str, $regs1);  // images/xxx.gif 까지 추출 


            // 추출 : http://img.yahoo.co.kr/home/2005/purplerose/b_tphchange.gif 
            //print $regs1[0]; 

          //  $tmp1_str = $regs1[0]; 
          //  eregi("[^= '/]*\.(jpg)", $tmp1_str, $regs2); // b_tphchange.gif 까지 추출 


$url = "http://imgnews.naver.com/image/038/2011/03/19/jowi201103190827410.jpg" ;

       rg_href($url);
      

        //    print $regs1[0]; 
       //     print '<br>'; 
        } 
      //  print '<hr>'; 
    } 

} 
?>