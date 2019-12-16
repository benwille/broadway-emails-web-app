<?php

$start = microtime(true);

require_once('API/JotForm.php');

date_default_timezone_set('America/Denver');

// if (!$_REQUEST['submissionID']) {
//    echo 'No request';
//    return;
// }

//Get unique submissionID - nothing to change here
// $id = $_REQUEST['submissionID'];

// $id = $_POST['submissionID']; //Get submission ID

// $data = json_encode( $_REQUEST, JSON_PRETTY_PRINT );
// file_put_contents('submissionsLog.txt', $data , FILE_APPEND | LOCK_EX);

//JotForm Submission API Call
$jotformAPI = new JotForm("14addac62cdc00d018e42ee7fef528bd");
$submission = $jotformAPI->getSubmission('4381682152187672054');

   $fname = $submission['answers'][3]['answer']['first'];
   $lname = $submission['answers'][3]['answer']['last'];
   $client = $submission['answers'][4]['answer'];
   $title = $submission['answers'][5]['answer'];
   $isci = $submission['answers'][18]['answer'];
   $duedate = $submission['answers'][6]['answer']['year'] . "-" . $submission['answers'][6]['answer']['month'] . "-" . $submission['answers'][6]['answer']['day'];
   $startdate = $submission['answers'][7]['answer']['year'] . "-" . $submission['answers'][7]['answer']['month'] . "-" . $submission['answers'][7]['answer']['day'];
   $enddate = $submission['answers'][8]['answer']['year'] . "-" . $submission['answers'][8]['answer']['month'] . "-" . $submission['answers'][8]['answer']['day'];
   $rotation = $submission['answers'][9]['answer'];
   $length = $submission['answers'][14]['answer'];
   $type = $submission['answers'][10]['answer'];
   $status = $submission['answers'][19]['answer'];
   $soldspec = $submission['answers'][20]['answer'];
   $stations = $submission['answers'][11]['answer'];
   $script = $submission['answers'][12]['answer'];
   $notes = $submission['answers'][13]['answer'];
   $cartid = "API" . mt_rand(1000,9999);

include 'lov.php';
$sarray = [];

   foreach($stations as $station) {
      foreach($stationsarray as $s) {
         if($s['callletters'] == $station) {
            $sarray[] = $s['stationid'];
         }
      }
   }
$stations = [];
   foreach($sarray as $station) {
      $stations[] = '{
         "stationid" : "' . $station . '",
         "cartid" : "' . $cartid . '",
         "scheduledflag" : "0"
      }';
   }

   $stationJSON = implode(", ", $stations);

   $postfields = '{
   "clientname": "' . $client . '",
   "crtitle": "' . $title . '",
   "iscicode": "' . $isci . '",
   "duedate": "' . $duedate . '",
   "runstartdate": "' . $startdate . '",
   "runenddate": "' . $enddate . '",
   "crlength": "' . $length . '",
   "rotationpercent": "' . $rotation . '",
   "crstatus": "' . $statuscode . '",
   "adtypeid": "' . $typeofad . '",
   "crscript" : "' . $script . '",
   "prodnotes" : "' . $notes . '",
   "cartid" : "' . $cartid . '",
   "soldflag": "' . $sold . '",
   "Station": [' . $stationJSON . '
   ],
   "POC": [
  {
        "personid": "' . $personID . '",
        "howid": "0"
    },
  {
        "personid": "' . $personID . '",
        "howid": "8"
    }
   ]
   }';

   echo $postfields;
   $end = microtime(true) - $start;
   echo '(' . number_format($end, 2) . ' seconds)';
   die;

# Post Spot
    $ch = curl_init('http://api-v2.internal.vcreative.net/app_test.php/spot_update/0');

    $header = array(
    'Content-type:text/json',
    'token: 15567415584993');

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

    $curl = curl_exec($ch);
    $vcreative = json_decode($curl, JSON_PRETTY_PRINT);
    var_dump($vcreative);

    curl_close($ch);
//

$end = microtime(true) - $start;
echo '(' . number_format($end, 2) . ' seconds)';
 ?>
