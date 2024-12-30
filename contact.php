<?php

session_start();
if (empty($_POST['honeybee'])) {
  
if(!$_POST) exit;

// Email address verification, do not edit.
function isEmail($mailto) {
  return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$mailto)); 
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
$mailName = $_POST['name'];
$mailto = $_POST['email'];
$mailNum = $_POST['phone'];
$mailSub = $_POST['subject'];
$mailMsg = $_POST['message'];
$mailSubject = "Contact Form | APS Electric Ltd";


$endpoint = 'https://api.brevo.com/v3/smtp/email';
 
$api_key = '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';


$message = "  <html> <body>

<table border='1' align='center'>

<tr>

  <td width='227' align='center'><b>Name : </b></td>

  <td width='447' align='center'> $mailName </td>

</tr>

<tr>

  <td align='center'><b>Phone :</b></td>

  <td align='center'>  $mailNum </td>

</tr>

<tr>

  <td align='center'><b>Email-ID  : </b></td>

  <td align='center'> $mailto  </td>

</tr>

<tr>

  <td align='center'><b>Subject :</b></td>

  <td align='center'>  $mailSub </td>

</tr>

<tr>

  <td align='center'><b>Message : </td>

  <td align='center'> $mailMsg </td>

</tr>

</table>  </body>

</html>";
 
    // Request payload
    $data = array(
 
        'sender' => array(
            'name' => $mailName,
            'email' => $mailto
        ),
 
        'to' => array(
 
            array(
    
                'email' => 'apselectric.info',
                'name' => $mailName
    
            )
 
        ),
 
        'subject' => $mailSubject,

        'htmlContent' => $message

    );
 
    //Set cURL options
    $options = array(

        CURLOPT_URL => $endpoint,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(

            'accept: application/json',
            'api-key: ' . $api_key,
            'content-type: application/json'
 
        )
 
    );
 
   
 
        $curl = curl_init();
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        //Close cURL session
        curl_close($curl);

        if ($response == true) {
          echo "success";
        } else {
          echo "error";
        }
    }
?>
