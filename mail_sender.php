<?php
for($x = 1; $x<6; $x++){
$file = file('/archives/mails.json');
foreach ($file as $line) {
  $data = json_decode($line);
  if(($data->date)<time()){
	  if(mail($data->name, $data->title, $data->msg, "From: saga@asmedia-24.pl", "-f saga@asmedia-24.pl")){
		  $fb = fopen("/archives/archive.json", "a");
		   mail('saga@asmedia-24.pl', 'Mail successfuly sent', 'Mail to the adress ' . $data->name . ' has been successfully sent to the SMTP and should arrive to the recipient.' , "From: saga@asmedia-24.pl", "-f saga@asmedia-24.pl");
		  //mail($data->phone . '@sms.priv.pl', '', "Mail has been successfully sent", "From: saga@asmedia-24.pl", "-f saga@asmedia-24.pl");
fwrite($fb, json_encode($data) . "\r\n");
	  }else{
		  $fb = fopen("/archives/mails1.json", "a");
		  fwrite($fb, json_encode($data) . "\r\n");
		  mail('saga@asmedia-24.pl', 'Scheduled mail error', 'There was an error sending mail to the adress ' . $data->name . '. This is a warning message, system will retry sending the e-mail until success.' , "From: saga@asmedia-24.pl", "-f saga@asmedia-24.pl");
		   //mail($data->phone . '@sms.priv.pl', '', "There was a problem sending your message, system will retry sending it", "From: saga@asmedia-24.pl", "-f saga@asmedia-24.pl");
		  }  
}else{
$fb = fopen("/archives/mails1.json", "a");
fwrite($fb, json_encode($data) . "\r\n");

}
}
unlink("/archives/mails.json");
rename("/archives/mails1.json","/archives/mails.json");
sleep(50);
}
?>