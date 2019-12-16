<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
// if(!isset($post)) {
//   redirect_to(url_for('/staff/emails/?station=' . h($station)));
// }
// $post->station = $station;
date_default_timezone_set("America/Denver");
$now = date('Y-m-d');
$duedate = date('Y-m-d', strtotime($now . '+ 2 days'));
$startdate = date('Y-m-d', strtotime($now . '+ 3 days'));
$enddate = date('Y-m-d', strtotime($now . '+ 4 days'));
// $pubDate = $post->pubDate ?? date("Y-m-d H:i:s");
// if ($_POST['vcreative']) {
//   $vcreative = $_POST['vcreative'];
//   if($vcreative) {
//     var_dump($vcreative);
//   }
// }
?>
  <dl>
    <dt>Name</dt>
    <dd><input type="text" name="vcreative[first]" value="" placeholder="First Name" /></dd>
    <dd><input type="text" name="vcreative[last]" value="" placeholder="Last Name" /></dd>
  </dl>

  <dl>
    <dt>Email</dt>
    <dd><input type="email" name="vcreative[email]" value="" placeholder="Email"  /></dd>
  </dl>

  <dl>
    <dt>Client Name</dt>
    <dd><input type="text" name="vcreative[client]" value=""  /></dd>
  </dl>

  <dl>
    <dt>Spot Title</dt>
    <dd><input type="text" name="vcreative[title]" value=""  /></dd>
  </dl>

  <dl>
    <dt>Dates</dt>
    <dd><label>Due Date: </label> <input type="date" name="vcreative[duedate]" min="<?php echo $duedate;?>" required></dd>
    <dd id="startdate"><label>Start Date: </label> <input type="date" name="vcreative[startdate]" min="<?php echo $startdate;?>" required></dd>
    <dd><label>End Date: </label> <input type="date" name="vcreative[enddate]" min="<?php echo $enddate;?>" required></dd>
  </dl>

  <dl>
    <dt>Ad Info</dt>
    <dd>
      <label>Ad Type: </label>
      <select name="vcreative[adtype]" >
        <option value="7088">Commercial</option>
        <option value="7094">Ad Lib</option>
        <option value="7104">PSA</option>
        <option value="7105">Promo</option>
      </select>
    </dd>
    <dd>
      <label>Length: </label>
      <input type="number" name="vcreative[length]" min="0"  />
    </dd>
    <dd>
      <label>Rotation: </label>
      <input type="number" name="vcreative[rotation]" style="width:50px" min="0" max="100"  />
    </dd>
  </dl>

  <dl>
    <dt>Stations</dt>
    <input type="checkbox" name="vcreative[station][]" value="5594" /> X96
    <input type="checkbox" name="vcreative[station][]" value="5590" /> U92
    <input type="checkbox" name="vcreative[station][]" value="5596" /> Rewind
    <input type="checkbox" name="vcreative[station][]" value="5588" /> Eagle
    <input type="checkbox" name="vcreative[station][]" value="5592" /> Mix
    <input type="checkbox" name="vcreative[station][]" value="5586" /> ESPN700
    <input type="checkbox" name="vcreative[station][]" value="6141" /> ESPN960
  </dl>

  <dl>
    <dt>Script</dt>
    <dd><textarea id="script" name="vcreative[script]" rows="4" cols="50" ></textarea></dd>
    <dd><span id="count">Number of words:</span><br />
    <span id="remaining"></span></dd>
  </dl>

  <dl>
    <dt>Production Notes</dt>
    <dd><textarea name="vcreative[notes]" rows="4" cols="50"></textarea></dd>
  </dl>
