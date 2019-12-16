
<?php
// echo mt_rand(1000, 9990);
# Post Spot
    $ch = curl_init('http://api-v2.internal.vcreative.net/app_test.php/lov');

    $header = array(
    'Content-type:text/json',
    'token: 15567415584993');

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $curl = curl_exec($ch);
    $vcreative = json_decode($curl, JSON_PRETTY_PRINT);
    // echo '<pre>';
    // print_r($vcreative);
    // echo '</pre>';

    curl_close($ch);

    $adtypes = $vcreative['adtypes'];
    $stationsarray = $vcreative['stations'];
    $persons = $vcreative['persons'];
    $statuscodes = $vcreative['statuscodes'];
    $soldflags = $vcreative['soldflags'];

    foreach($soldflags as $soldflag) {
        if($soldflag['solddesc'] == $soldspec) {
            $sold = $soldflag['soldflag'];
            break;
        }
    }

    foreach($statuscodes as $s) {
      if($s['statusdesc'] == $status) {
        $statuscode = $s['statuscode'];
        break;
      }
    }


    foreach ($persons as $person) {
        if($person['lastname'] == $lname && $person['firstname'] == $fname) {
            $personID = $person['personid'];
            break;
        }
    }

    foreach ($adtypes as $adtype) {
        if($adtype['adtypedesc'] == $type) {
            $typeofad = $adtype['adtypeid'];
            break;
        }
    }

 ?>
