<?php 

$host = 'www.uhakplace.co.kr';
$service_uri = '/board/view.php?&bbs_code=notice&bd_num=1630';


$fp = fsockopen ($host, 80, $errno, $errstr, 30);





if (!$fp) {
    echo "$errstr ($errno)<br>\n";
} else {
    fputs ($fp, "GET $service_uri HTTP/1.0\r\n\r\n");
    while (!feof($fp)) {
        $str .= fgets($fp, 128);
    }
    fclose ($fp);
}
echo $str;










for($i=0; $i<sizeof($the); $i++){ 
    $input = $the[$i]; 
    preg_match_all("<img [^<>]*>", $input, $output); 

    if($output[0]){ 

        for($j=0; $j<sizeof($output[0]); $j++){ 

            // 추출 : img src="http://img.yahoo.co.kr/home/2005/purplerose/b_tphchange.gif" align="absmiddle" 
            //print $output[0][$j]; 

            $tmp_str = $output[0][$j]; 
            eregi("[^= \"']*\.(gif|jpg|bmp)", $tmp_str, $regs1);  // images/xxx.gif 까지 추출 


            // 추출 : http://img.yahoo.co.kr/home/2005/purplerose/b_tphchange.gif 
            //print $regs1[0]; 

            $tmp1_str = $regs1[0]; 
            eregi("[^= '/]*\.(gif|jpg|bmp)", $tmp1_str, $regs2); // b_tphchange.gif 까지 추출 

            print $regs2[0]; 
            print '<br>'; 
        } 
        print '<hr>'; 
    } 

} 








?>