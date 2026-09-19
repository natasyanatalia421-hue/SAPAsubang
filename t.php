<?php
$j=sys_get_temp_dir().'/t.txt';
$c=curl_init('http://127.0.0.1:8080/wisata');
curl_setopt($c,CURLOPT_RETURNTRANSFER,true);curl_setopt($c,CURLOPT_FOLLOWLOCATION,true);curl_setopt($c,CURLOPT_TIMEOUT,10);curl_setopt($c,CURLOPT_COOKIEJAR,$j);
$body=curl_exec($c);$code=curl_getinfo($c,CURLINFO_HTTP_CODE);curl_close($c);
echo($code===200?'✅':'💥 '.$code)."  Halaman Wisata\n";
echo (str_contains($body,'geserFoto')?'✅':'❌')."  JS slideshow geser ada\n";
echo (str_contains($body,'mwSlides')?'✅':'❌')."  Container slides ada\n";
echo (str_contains($body,'mwPrev')?'✅':'❌')."  Tombol prev/next ada\n";
@unlink($j);
