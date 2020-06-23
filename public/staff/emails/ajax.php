<?php require_once('../../../private/initialize.php'); ?>
<?php
if(is_post_request()) {
  $posts = $_POST['posts'];
  $count = 0;
  foreach($posts as $post) {
    // Create record using post parameters
    $args = $post;
    $id = $post['id'];
    $station = $post['station'];
    $post = Email::find_by_id($id);
    var_dump($post);

    $post->merge_attributes($args);

    $result = $post->save();
    if($result === true) {
      // $new_id = $task->id;
      $count++;
      // echo 'The post was updated successfully.';
      // $session->message('The post was updated successfully.');
      // redirect_to(url_for('/staff/emails/index.php?station=' . $station));


    } else {
      // show errors
      // echo 'There was an error';
      // redirect_to(url_for('/staff/posts/index.php'));
    }
  }

  $session->message($count . ' posts were updated successfully.');
  // redirect_to(url_for('/staff/emails/index.php?station=' . $station));
}

 ?>
