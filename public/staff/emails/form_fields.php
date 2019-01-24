<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($post)) {
  redirect_to(url_for('/staff/emails/index.php?station=' . h($station)));
}
$post->station = $station;
?>

<dl>
  <dt>Station</dt>
  <dd><?php echo h($post->station()); ?></dd>
  <dd><input type="hidden" name="post[station]" value="<?php echo $post->station; ?>" /></dd>
  <dd><input type="hidden" name="post[pubDate]" value="<?php date_default_timezone_set("America/Denver");
  echo date("Y-m-d H:i:s");?>"></dd>
</dl>

<dl>
  <dt>Title</dt>
  <dd><input type="text" name="post[title]" value="<?php echo h($post->title); ?>" /></dd>
</dl>

<dl>
  <dt>Post Link</dt>
  <dd><input type="url" name="post[link]" value="<?php echo h($post->link); ?>" /></dd>
</dl>

<dl>
  <dt>Image Link</dt>
  <dd><input type="url" name="post[imageLink]" value="<?php echo h($post->imageLink); ?>" /></dd>
</dl>

<dl>
  <dt>Category</dt>
  <dd><select name="post[category]">
    <option value=""></option>
  <?php foreach(Email::CATEGORY as $category_id => $category_name) { if ($station !=6) {
    if ($category_id > 3) {
      break;
    }
  }?>
    <option value="<?php echo $category_id; ?>" <?php if($post->category == $category_id) { echo 'selected'; } ?>><?php echo $category_name; ?></option>
  <?php } ?>
  </select></dd>
</dl>

<dl>
  <dt>Excerpt</dt>
  <dd><textarea name="post[excerpt]" rows="4" cols="50"><?php echo hd($post->excerpt); ?></textarea></dd>
</dl>
