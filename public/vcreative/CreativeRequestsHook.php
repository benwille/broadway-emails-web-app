<?php
	//Real Media Requests
  require_once('API/JotForm.php');

  date_default_timezone_set('America/Denver');

  if (!$_REQUEST['submissionID']) {
    echo 'No request';
    return;
  } elseif ($_REQUEST['username'] !== 'bwille') {
    exit;
  }

  //Get unique submissionID - nothing to change here
  $id = $_REQUEST['submissionID'];

  $data = json_encode( $_REQUEST, JSON_PRETTY_PRINT );
  file_put_contents('submissionsLog.txt', $data , FILE_APPEND | LOCK_EX);

  //JotForm Submission API Call
    $jotformAPI = new JotForm("14addac62cdc00d018e42ee7fef528bd");
    $submission = $jotformAPI->getSubmission("$id");

    $fname = $submission['answers'][3]['answer']['first'];
    $lname = $submission['answers'][3]['answer']['last'];
    $client = $submission['answers'][4]['answer'];
    $title = $submission['answers'][5]['answer'];
    $duedate = $submission['answers'][6]['answer']['year'] . "-" . $submission['answers'][6]['answer']['month'] . "-" . $submission['answers'][6]['answer']['day'];
    $startdate = $submission['answers'][7]['answer']['year'] . "-" . $submission['answers'][7]['answer']['month'] . "-" . $submission['answers'][7]['answer']['day'];
    $enddate = $submission['answers'][8]['answer']['year'] . "-" . $submission['answers'][8]['answer']['month'] . "-" . $submission['answers'][8]['answer']['day'];
    $rotation = $submission['answers'][9]['answer'];
    $length = $submission['answers'][14]['answer'];
    $adtype = $submission['answers'][10]['answer'];
    $stations = $submission['answers'][11]['answer'];
    $script = $submission['answers'][12]['answer'];
    $notes = $submission['answers'][13]['answer'];

  // Find the task that matches the submission
  do {
    # SEARCH ASANA FOR MOST RECENT TASK

    $ch = curl_init('https://app.asana.com/api/1.0/workspaces/186855804048868/tasks/search?completed=false&projects.any=850113058002663&opt_fields=name,due_on,assignee.name,custom_fields&sort_by=created_at&opt_pretty');
    $audienceID = '850353403074362';
    $header = array(
      'Accept: application/json',
      'Content-type:text/json;charset=utf-8',
      'Authorization: Bearer 0/58b1dadca0ab586755e08967847d3c7e');
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      header('Content-type:text/json;charset=utf-8');
      $curl = curl_exec($ch);
      // var_dump($curl);
      $asana = json_decode($curl, JSON_PRETTY_PRINT)['data'][0];
      $asanaID = $asana['id'] ?? NULL;
      $asanaName = $asana['name'] ?? NULL;
      curl_close($ch);

  } while ($jotformName !== $asanaName); // Find task that matches submission

  // Add URL to comment
	    $ch = curl_init('https://app.asana.com/api/1.0/tasks/' . $asanaID . '/stories?');
	    $header = array(
	    'Accept: application/json',
	    'Content-type:text/json;charset=utf-8',
	    'Authorization: Bearer 0/58b1dadca0ab586755e08967847d3c7e');
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	    curl_setopt($ch, CURLOPT_POSTFIELDS, '{
	      "data": {
	        "text": "' . $url . '"
	      }
	    }');

	    $curl = curl_exec($ch);
      if (!$curl) {
        $error = 'Error: ' . curl_error($ch) . ' (#' . $id . ')';
        file_put_contents('submissionsLog.txt', $error , FILE_APPEND | LOCK_EX);
      }
	    curl_close($ch); // URL to comment


   	// Set Jotform Custom Field = Yes
	     $ch = curl_init('https://app.asana.com/api/1.0/tasks/' . $asanaID . '?');
	     $header = array(
	     'Accept: application/json',
	     'Content-type:text/json;charset=utf-8',
	     'Authorization: Bearer 0/58b1dadca0ab586755e08967847d3c7e');
	     curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	     curl_setopt($ch, CURLOPT_POSTFIELDS, '{
	       "data": {
	         "custom_fields":{
	           "1108856983701891": "1108856983701892"
	         }
	       }
	     }');
	     $curl = curl_exec($ch);
	     curl_close($ch);
	// Set custom field

      // query projects
       $ch = curl_init('https://app.asana.com/api/1.0/teams/916127945120086/projects');
       $header = array(
       'Accept: application/json',
       'Content-type:text/json;charset=utf-8',
       'Authorization: Bearer 0/58b1dadca0ab586755e08967847d3c7e');
       curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

       $curl = curl_exec($ch);

       $projects = json_decode($curl, JSON_PRETTY_PRINT)['data'];

       curl_close($ch);

   //
    // match up tag and station
        if ($project) {
          $x = 0;
            while ($x < 7) {
              $projectname = $projects[$x]['name'] ?? NULL;
              $projectid = $projects[$x]['id'] ?? NULL;

              if ($project == $projectname) {
                  break;
              }
              $x++;
            }
        }

           // echo $projectid;
    // Add project to task
   	      $ch = curl_init('https://app.asana.com/api/1.0/tasks/' . $asanaID . '/addProject/');
   	      $header = array(
   	      'Accept: application/json',
   	      'Content-type:text/json;charset=utf-8',
   	      'Authorization: Bearer 0/58b1dadca0ab586755e08967847d3c7e');
   	      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
   	      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   	      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
   	      curl_setopt($ch, CURLOPT_POSTFIELDS, '{
   	        "data": {
   	          "project" : "' . $projectid . '"
   	          }
   	      }');
   	      $curl = curl_exec($ch);
   	      curl_close($ch); //add project to task

   	 if ($follower) {
 // Add follower
   	 	    $ch = curl_init('https://app.asana.com/api/1.0/tasks/' . $asanaID . '/addFollowers');
   	 	    $header = array(
   	 	    'Accept: application/json',
   	 	    'Content-type:text/json;charset=utf-8',
   	 	    'Authorization: Bearer 0/58b1dadca0ab586755e08967847d3c7e');
   	 	    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
   	 	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   	 	     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
   	 	    curl_setopt($ch, CURLOPT_POSTFIELDS, '{
   	 	      "data": {
   	 	        "followers": "' . $follower . '"
   	 	      }
   	 	    }');

   	 	    $ccurl_exec($ch);
   	 //		    $follower = json_decode( $curl, JSON_PRETTY_PRINT );
   	 //		    var_dump($follower);
   	 		if (!$curl) {
   	 	    	$error = 'Error: ' . curl_error($ch) . ' (#' . $id . ')';
   	 	    	file_put_contents('submissionsLog.txt', $error , FILE_APPEND | LOCK_EX);
   	 		}

	}
?>
