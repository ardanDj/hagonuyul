<?php
// Putra Ganteng Banget
// Ganti Copyright = Emak U Perawan, U Anak Siapa?
function hago($id){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://149.129.192.134/ymicro/api?_service=net.ihago.activity.api.richtree&_method=RichTree.GetStatus');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"uid\":$id}");
	$headers = array();
	$headers[] = 'Host: i-863.ihago.net';
	$headers[] = 'Connection: close';
	$headers[] = 'Accept: application/json, text/plain, */*';
	$headers[] = 'Post-Time: 596';
	$headers[] = 'Content-Type: application/json;charset=utf-8';
	$headers[] = 'Accept-Language: en-us';
	$headers[] = 'X-Ymicro-Api-Method-Name: RichTree.GetStatus';
	$headers[] = 'Origin: https://www.ihago.net';
	$headers[] = 'X-Ymicro-Api-Service-Name: net.ihago.activity.api.richtree';
	$headers[] = 'X-Ostype: ios';
	$headers[] = 'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 13_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 APP/yym-hago-and3.11.2 Language/en_ID';
	$headers[] = 'Referer: https://www.ihago.net/a/money-tree/index.html?source=IMMessage&showWorker=1&inviteGuardianID=21fafa9e-1308-4603-8d34-4273a7617793';
	$headers[] = 'X-Lang: en';
	$headers[] = 'Cookie: '.@file_get_contents("cookie_hago.txt");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function steal($id, $idx){
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://149.129.192.134/ymicro/api?_service=net.ihago.activity.api.richtree&_method=RichTree.StealGoldCoin');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"uid\":$id,\"idx\":\"$idx\"}");

	$headers = array();
	$headers[] = 'Host: i-863.ihago.net';
	$headers[] = 'Connection: close';
	$headers[] = 'Accept: application/json, text/plain, */*';
	$headers[] = 'Post-Time: 112';
	$headers[] = 'Content-Type: application/json;charset=utf-8';
	$headers[] = 'Accept-Language: en-us';
	$headers[] = 'X-Ymicro-Api-Method-Name: RichTree.StealGoldCoin';
	$headers[] = 'Origin: https://www.ihago.net';
	$headers[] = 'X-Ymicro-Api-Service-Name: net.ihago.activity.api.richtree';
	$headers[] = 'X-Ostype: ios';
	$headers[] = 'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 13_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 APP/yym-hago-and3.11.2 Language/en_ID';
	$headers[] = 'Referer: https://www.ihago.net/a/money-tree/index.html?source=IMMessage&showWorker=1&inviteGuardianID=21fafa9e-1308-4603-8d34-4273a7617793';
	$headers[] = 'X-Lang: en';
	$headers[] = 'Cookie: '.@file_get_contents("cookie_hago.txt");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$result = curl_exec($ch);
	curl_close($ch);
	return @json_decode($result, true)['result']['errcode'];
}
echo "## OPIT GA OPIT, HAJAR AJA AJG\n";
$file = @file_exists("cookie_hago.txt");
if(!$file) die("Buat File cookie_hago.txt\nIsi file itu dengan cookie hago u!\n");
while(true){
	$b = rand(100000000,180899998);
	$cek = hago($b);
	$json = @json_decode($cek, true)['status'];
	$list = $json['glist'];
	$valid = count(@explode('"had_pick":true', $cek))-1;
	$valid2 = count(@explode('"can_pick":true', $cek))-1;
	$valid3 = count($list);
	if($valid3<1 OR $valid==count($json['glist']) OR $valid2==0):
		continue;
	endif;
	echo "\n##Steal From $b\n";
	for($a=0;$a<$valid3;$a++):
		$r = $list[$a];
		$idx = $r['idx'];
		$steal = steal($b, $idx);
		$gold = $r['gold']/1000;
		if($steal==0) echo "\tSuccess Steal! Get $gold Gold.\n";
	endfor;
}
