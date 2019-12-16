<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($ad)) {
  redirect_to(url_for('/staff/emails/index.php?station=' . h($station)));
}
// $ad->station = $station;
date_default_timezone_set("America/Denver");

?>

<dl>
  <dt>Title</dt>
  <dd><input type="text" name="ad[title]" value="<?php echo h($ad->title); ?>" /></dd>
</dl>

<dl>
  <dt>Image Link</dt>
  <dd><input type="url" name="ad[imageLink]" value="<?php echo h($ad->imageLink); ?>" /><br />
  <img class="img-fluid" src="<?php echo h($ad->imageLink); ?>"></dd>

</dl>

<dl>
  <dt>Post Link</dt>
  <dd><input type="url" name="ad[link]" value="<?php echo h($ad->link); ?>" /></dd>
</dl>

<dl>
  <dt>Position</dt>
  <dd><select name="ad[position]">
    <option value=""></option>
  <?php foreach(Ad::POSITION as $position_id => $position_name) { ?>
    <option value="<?php echo $position_id; ?>" <?php if($ad->position == $position_id) { echo 'selected'; } ?>><?php echo $position_name; ?></option>
  <?php } ?>
  </select></dd>
</dl>

<dl>
  <dt>Stations</dt>
  <?php $stations = $ad->allStations();
  ?>
  <dd><input type="checkbox" name="ad[station][]" value="1"<?php echo in_array(1, $stations) ? 'checked' : '';  ?> /> X96<br />
  <input type="checkbox" name="ad[station][]" value="2"<?php echo in_array(2, $stations) ? 'checked' : '';  ?>/> Mix<br />
  <input type="checkbox" name="ad[station][]" value="3"<?php echo in_array(3, $stations) ? 'checked' : '';  ?>/> U92<br />
  <input type="checkbox" name="ad[station][]" value="4"<?php echo in_array(4, $stations) ? 'checked' : '';  ?>/> Rewind<br />
  <input type="checkbox" name="ad[station][]" value="5"<?php echo in_array(5, $stations) ? 'checked' : '';  ?>/> Eagle<br />
  <input type="checkbox" name="ad[station][]" value="6"<?php echo in_array(6, $stations) ? 'checked' : '';  ?>/> ESPN</dd>

</dl>
