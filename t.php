<?php
$b='http://127.0.0.1:8080';$j=sys_get_temp_dir().'/t.txt';
function r($u,$j,$post=null){$c=curl_init($u);curl_setopt($c,CURLOPT_RETURNTRANSFER,true);curl_setopt($c,CURLOPT_FOLLOWLOCATION,true);curl_setopt($c,CURLOPT_TIMEOUT,10);curl_setopt($c,CURLOPT_COOKIEJAR,$j);curl_setopt($c,CURLOPT_COOKIEFILE,$j);if($post){curl_setopt($c,CURLOPT_POST,true);curl_setopt($c,CURLOPT_POSTFIELDS,http_build_query($post));}$body=curl_exec($c);$code=curl_getinfo($c,CURLINFO_HTTP_CODE);curl_close($c);return['code'=>$code,'body'=>$body];}
function csrf($h){preg_match('/name="csrf-token"\s+content="([^"]+)"/i',$h,$m);if(!$m)preg_match('/name="_token"[^>]+value="([^"]+)"/i',$h,$m);return $m[1]??'';}
function chk($b,$j,$p,$l,$checks=[]){$r=r("$b$p",$j);$ok=$r['code']===200;echo($ok?'✅':'💥 '.$r['code'])."  $l\n";foreach($checks as $str=>$lbl){echo "   ".($ok&&str_contains($r['body'],$str)?'✓ ':'✗ ')."$lbl\n";}}

echo "\n=== PUBLIK ===\n";
chk($b,$j,'/','Home');
chk($b,$j,'/tentang','Tentang');
chk($b,$j,'/wisata','Wisata');
chk($b,$j,'/berita','Berita');
chk($b,$j,'/laporan','Laporan');
chk($b,$j,'/login','Login',['auth.google'=>'Tidak ada tombol Google']);
chk($b,$j,'/register','Register',['auth.google'=>'Tidak ada tombol Google']);
chk($b,$j,'/panduan','Panduan',['Google Play'=>'Tidak ada Google Play']);
chk($b,$j,'/lupa-password','Lupa Password');

@unlink($j);
$r1=r("$b/login",$j);$tok=csrf($r1['body']);
r("$b/login",$j,['_token'=>$tok,'email'=>'admin@laporin.id','password'=>'password']);
echo "\n=== ADMIN ===\n";
chk($b,$j,'/admin/dashboard','Dashboard Admin');

@unlink($j);
$r2=r("$b/login",$j);$tok2=csrf($r2['body']);
r("$b/login",$j,['_token'=>$tok2,'email'=>'ahmad@example.com','password'=>'password']);
echo "\n=== USER ===\n";
chk($b,$j,'/user/dashboard','Dashboard User');

echo "\n";@unlink($j);
