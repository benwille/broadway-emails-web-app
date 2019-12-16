<?php

require_once('../../private/initialize.php');

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['vcreative'];
  $spot = new Spot($args);

  $result = $spot->post();
  // print_r ($admin->sanitized_attributes());

  if($result === true) {

    $session->message('The spot was submitted successfully. Look for your confirmation email.');

} else {
  // show errors
  }
} else {
  // display the form
  $spot = new Spot;
}


?>


<?php $page_title = 'Create Radio Spot'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<script>
$(document).ready(function() {
  $('textarea').eq(0).keyup(function() {
    s = this.value;
    s = s.replace(/(^\s*)|(\s*$)/gi,"");
    s = s.replace(/[ ]{2,}/gi," ");
    s = s.replace(/\n /,"\n");
    $('#count').html('Number of words: ' + s.split(' ').length);
  });

  $('textarea').eq(0).keyup(function() {
    length = Math.floor($('input[name*=length]')[0].value * 2.5);
    remaining = length - s.split(' ').length;
    if (length) {
      if (remaining < 10) {
        $('#remaining').text('Words remaining: ' + (length - s.split(' ').length)).css({'color' : 'red', 'font-size': '20px'});
      }
      if (remaining >= 10) {
        $('#remaining').text('Words remaining: ' + (length - s.split(' ').length)).css({'color' : '', 'font-size': ''});
      }
    }
  });

  // $('input[type=date]').eq(0).change(function() {
  //   d = new Date(this.value);
  //   console.log(d);
  //   d.setDate(d.getDate() + 3);
  //   start = "" + d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + "";
  //   // startdate = '<label>Start Date: </label> <input type="date" name="vcreative[startdate]" min="' + start + '" required>'
  //   // $('#startdate').html(startdate);
  //   $('input[type=date]').eq(1).prop('min', "" + d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + "");
  //   // console.log(jQuery.type(start));
  //   console.log(startdate);
  //   console.log(d.getFullYear());
  //   console.log(d.getMonth());
  //   console.log(d.getDate());
  // });
  //
  // function changeStartDate(start) {
  //   // $('input[type=date]').eq(1).prop('min', start);
  //   startdate = '<label>Start Date: </label> <input type="date" name="vcreative[startdate]" min="' + start + '" required>'
  //   $('#startdate').html(startdate);
  // }
}); //ready

</script>

<div id="content">

  <div class="email new">
    <h1>Create Radio Spot</h1>

    <?php echo display_errors($spot->errors); ?>

    <form action="" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Submit Spot" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
