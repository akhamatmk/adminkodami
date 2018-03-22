<?php

namespace App\Http\Controllers;

class TeleController extends Controller
{
	function index()
	{
		// $token_bot="512991148:AAFhL4bEoQG7c37jsXPDWmJo07RhwnVV_WI";
		// $data['chat_id']='402175584';	

		// //$data['chat_id']='@dompetpulsa_bot';	
		// //dompet pulsa : 283733172
		// //$data['chat_id'] = '283733172';
		
		// $data['text']="TEST SALDO"; 
		
		// function kirimperintah($perintah,$token_bot,array $keterangan=null) 
		// { 
		// 	$url="https://api.telegram.org/bot".$token_bot."/"; 
		// 	$url.=$perintah."?"; 
		// 	$ch=curl_init(); 
		// 	curl_setopt($ch,CURLOPT_URL,$url); 
		// 	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1); 
		// 	curl_setopt($ch,CURLOPT_POSTFIELDS,$keterangan); 
		// 	$output = curl_exec($ch); 
		// 	curl_close($ch); 
			
		// 	return $output; 
		// } 

		// return kirimperintah("sendMessage",$token_bot,$data);

		$url = 'https://portalpulsa.com/api/connect/';

		$data = array( 
			'inquiry' => 'D', // konstan
			'bank' => 'bca', // bank tersedia: bca, bni, mandiri, bri, muamalat
			'nominal' => 100000, // jumlah request
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);

		echo $result; // ini berupa data json

	}
}