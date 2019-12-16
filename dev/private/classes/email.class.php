<?php

class Email extends DatabaseObject {

  // ----- START OF ACTIVE RECORD CODE ------
  static protected $table_name = "posts";
  static protected $db_columns = ['id', 'station', 'title', 'link', 'pubDate', 'imageLink', 'featured', 'position', 'category', 'excerpt', 'visible'];

  public $id;
  public $station;
  public $title;
  public $link;
  public $pubDate;
  public $imageLink;
  public $imageThumb;
  public $featured = 0;
  public $position = 0;
  public $category;
  public $excerpt;
  public $visible;

   const STATION = [
    1 => 'X96',
    2 => 'Mix',
    3 => 'U92',
    4 => 'Rewind',
    5 => 'Eagle',
    6 => 'ESPN'
  ];

   const STATION_URL = [
    1 => 'X96',
    2 => 'Mix1051utah',
    3 => 'U92slc',
    4 => 'Rewind1007',
    5 => '1015TheEagle',
    6 => 'ESPN700Sports'
  ];

   const STATION_FB = [
    1 => 'X96Music',
    2 => 'mix1051utah',
    3 => 'U92SLC',
    4 => 'Rewind100.7',
    5 => '1015TheEagle',
    6 => 'ESPN700'
  ];

   const STATION_TW = [
    1 => 'X96',
    2 => 'mix1051utah',
    3 => 'U92SLC',
    4 => 'Rewind1007fm',
    5 => '1015TheEagleUT',
    6 => 'ESPN700'
  ];

   const STATION_IG = [
    1 => 'x96fm',
    2 => 'mix1051utah',
    3 => 'U92SLC',
    4 => 'Rewind1007fm',
    5 => '1015TheEagleUT',
    6 => 'ESPN700'
  ];

   const STATION_APP = [
    1 => 'https://itunes.apple.com/us/app/x96-kxrk/id655730921?mt=8',
    2 => 'https://apps.apple.com/us/app/mix-105-1-utah/id653652578',
    3 => 'https://apps.apple.com/us/app/u92-slc/id671489114',
    4 => 'https://apps.apple.com/us/app/rewind-100-7/id656814346',
    5 => 'https://apps.apple.com/us/app/1015-the-eagle/id653586558',
    6 => 'https://apps.apple.com/us/app/espn-700-radio/id403281568'
  ];

   const STATION_GP = [
    1 => 'https://play.google.com/store/apps/details?id=com.broadway.kxrk',
    2 => 'https://play.google.com/store/apps/details?id=com.broadwaymediagroup.kudd',
    3 => 'https://play.google.com/store/apps/details?id=com.broadwaymediagroup.kuuu',
    4 => 'https://play.google.com/store/apps/details?id=com.broadway.KYMV',
    5 => 'https://play.google.com/store/apps/details?id=com.broadway.KEGA',
    6 => 'https://play.google.com/store/apps/developer?id=Broadway+Media'
  ];

   const CATEGORY = [
    0 => 'Other',
    1 => 'News',
    2 => 'Life',
    3 => 'Contests',
    4 => 'Interviews',
    5 => 'RSL',
    6 => 'Utah Jazz',
    7 => 'University of Utah',
    8 => 'Salt Lake Stallions'
  ];

  public function __construct($args=[]) {
    //$this->brand = isset($args['brand']) ? $args['brand'] : '';
    $this->station = $args['station'] ?? '';
    $this->title = $args['title'] ?? '';
    $this->link = $args['link'] ?? '';
    $this->pubDate = $args['pubDate'] ?? NULL;
    $this->imageLink = $args['imageLink'] ?? '';
    $this->featured = $args['featured'] ?? 0;
    $this->position = $args['position'] ?? 0;
    $this->category = $args['category'] ?? '';
    $this->excerpt = $args['excerpt'] ?? '';
    $this->visible = $args['visible'] ?? '';


  }

  public function station() {
    if($this->station > 0) {
      return self::STATION[$this->station];
    } else {
      return "Unknown";
    }
  }

  public function category() {
    if($this->category) {
      return self::CATEGORY[$this->category];
    } else {
      return "Unknown";
    }
  }

  static public function find_by_date($date) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE pubDate='" . self::$database->escape_string($date) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_title($title) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE title='" . self::$database->escape_string($title) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_link($link) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE link='" . self::$database->escape_string($link) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  //
  // public function shift_errors_array() {
  //   global $errors;
  //   $new_errors = $errors;
  //   $errors = call_user_func_array('array_merge', $new_errors);
  //   return $errors;
  // }
  //
  public function featured() {
    if ($this->featured == 1) {
      return true;
    }
  }

  public function visible() {
    if ($this->visible == 1) {
      return true;
    }
  }

  public function pubDate() {
    $date = date_create( $this->pubDate);
    $dateformat = date_format($date, 'D d M Y h:i A');
    return $dateformat;
  }

  protected function validate() {
    $this->errors = [];

    if (!is_unique_article($this->link, $this->id ?? 0)) {
      $this->errors[] = "1 or more articles have already been uploaded.";
    }

    if (is_blank($this->title)) {
      $this->errors[] = "Title cannot be blank";
    }

    if (is_blank($this->link)) {
      $this->errors[] = "Link cannot be blank";
    }

    if (is_blank($this->pubDate)) {
      $this->errors[] = "Date cannot be blank";
    }

    if (is_blank($this->imageLink)) {
      $this->errors[] = "Image cannot be blank";
    }

    // if (!can_be_promoted($this->promoted, $this->id ?? 0)) {
    //   $this->errors[] = "You have too many promoted posts, please remove at least one before promoting a new post.";
    // }

    // if ($this->promoted == 0 && $this->hero == 1) {
    //   $this->errors[] = "You have to remove this post from being hero first.";
    //  }

    // if (!can_be_hero($this->hero, $this->id ?? 0)) {
    //   $this->errors[] = "You can only have one promoted hero post.";
    // }

    // if (!can_be_team_hero($this->team, $this->team_hero, $this->id ?? 0)) {
    //   $this->errors[] = "You can only have one promoted team hero post.";
    // }
    //
    // if (!can_be_team_featured($this->team, $this->team_featured, $this->id ?? 0)) {
    //   $this->errors[] = "You have too many featured posts, please remove at least one before featuring a new post.";
    // }
    //
    // if ($this->team_featured == 1 && $this->team_hero == 1) {
    //   $this->errors[] = "The post can't be both a hero and featured post. Please choose one.";
    //  }

    return $this->errors;
  }

  static public function post_query($station, $category, $featured) {
    $sql = "SELECT * FROM posts ";
    $sql .= "WHERE station=" . $station . " ";
    $sql .= "AND category=" . $category . " ";
    $sql .= "AND featured=" . $featured . " ";
    $sql .= "AND visible=1 ";
    $sql .= "ORDER BY position = 0, position, pubDate DESC ";
    $sql .= "LIMIT 5 ";
    $results = Email::find_by_sql($sql);
    return $results;
  }

  public function get_posts($station, $category) {
    global $admin;
    global $pagination;
    global $per_page;

    // $sql = "SELECT * FROM posts ";
    // $sql .= "WHERE station=" . $station . " ";
    // $sql .= "AND category=" . $category . " ";
    // // $sql .= "AND visible=1 ";
    // $sql .= "AND NOT featured=1 ";
    // $sql .= "ORDER BY pubDate DESC ";
    // $sql .= "LIMIT {$per_page} ";
    // $results = Email::find_by_sql($sql);
    $sql = "(SELECT * FROM posts ";
    $sql .= "WHERE station=" . $station . " ";
    $sql .= "AND category=" . $category . " ";
    $sql .= "AND visible=1 ";
    $sql .= "AND NOT featured=1 ";
    $sql .= "ORDER BY pubDate DESC ";
    $sql .= "LIMIT 10) ";
    $sql .= "UNION (SELECT * FROM posts ";
    $sql .= "WHERE station=" . $station . " ";
    $sql .= "AND category=" . $category . " ";
    $sql .= "AND visible=0 ";
    $sql .= "AND NOT featured=1 ";
    $sql .= "ORDER BY pubDate DESC ";
    $sql .= "LIMIT 5) ";
    $sql .= "ORDER BY pubDate DESC ";
    // $sql .= "LIMIT {$per_page} ";
    $results = Email::find_by_sql($sql);

    // if (!$results) {
    //   return false;
    // }

    // $results = $this->post_query($station, $category, $featured);

    $category = $this->category(); ?>

    <div class="table-responsive">
      <table class="list table">
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Publish Date</th>
          <th>Position</th>
          <th>Featured</th>
          <th>Visible</th>
          <th>&nbsp;</th>
          <?php if ($admin->is_admin()) { ?>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        <?php } ?>
        </tr>
        <?php foreach($results as $post) { ?>
          <tr>
            <form action="<?php echo 'index.php?id=' . h(u($post->id)) . '&station=' . $station ; ?>" method="post" id="postform">
            <td><?php echo h($post->title); ?></td>
            <td class="align-middle">
              <select name="post[category]">
                <option value=""></option>
                <?php foreach(Email::CATEGORY as $category_id => $category_name) { if ($station !=6) {
                  if ($category_id > 3) {
                    break;
                  }
                }?>
                <option value="<?php echo $category_id; ?>" <?php if($post->category == $category_id) { echo 'selected'; } ?>><?php echo $category_name; ?></option>
              <?php } ?>
              </select>
            </td>
            <td><?php echo h($post->pubDate()); ?></td>
            <td><input type="number" name="post[position]" value="<?php echo h($post->position);?>" min="1" max="10" /></td>
            <td class="text-center align-middle">
              <input type="hidden" name="post[featured]" value="0" />
              <input type="checkbox" name="post[featured]" value="1"<?php if($post->featured()) { echo " checked"; } ?> />
            </td>
            <td class="text-center align-middle">
              <input type="hidden" name="post[visible]" value="0" />
              <input type="checkbox" name="post[visible]" value="1"<?php if($post->visible()) { echo " checked"; } ?> />
            </td>
            <td class="align-middle"><a class="action" href="<?php echo $post->link; ?>" target="_blank">View</a></td>
            <?php if ($admin->is_admin()) { ?>
            <td class="align-middle"><a class="action" href="<?php echo url_for('/staff/emails/edit.php?id=' . h(u($post->id)) . '&station=' . h(u($post->station))); ?>">Edit</a></td>
            <td class="align-middle"><a class="action" href="<?php echo url_for('/staff/emails/delete.php?id=' . h(u($post->id)) . '&station=' . h(u($post->station))); ?>">Delete</a></td>
            <td class="align-middle"><input type="submit" value="Update" /></td>
            <?php } ?>
            </form>
      	  </tr>
        <?php } ?>
    	</table>
    </div><!-- $category posts -->
  <?php
  }

  public function contest_posts($station) {
    global $admin;
    $sql = "SELECT * FROM posts ";
    $sql .= "WHERE station=" . $station . " ";
    $sql .= "AND category=3 ";
    $sql .= "ORDER BY pubDate DESC ";
    $contests = Email::find_by_sql($sql); ?>

    <div class="table-responsive">
      <table class="list table">
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Publish Date</th>
          <th>Position</th>
          <th>Featured</th>
          <th>&nbsp;</th>
          <?php if ($admin->is_admin()) { ?>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        <?php } ?>
        </tr>
        <?php foreach($contests as $post) { ?>
          <tr>
            <form action="<?php echo 'index.php?id=' . h(u($post->id)) ; ?>" method="post" id="postform">
            <td><?php echo h($post->title); ?></td>
            <td class="align-middle">
              <select name="post[category]">
                <option value=""></option>
              <?php foreach(Email::CATEGORY as $category_id => $category_name) { ?>
                <option value="<?php echo $category_id; ?>" <?php if($post->category == $category_id) { echo 'selected'; } ?>><?php echo $category_name; ?></option>
              <?php } ?>
              </select>
            </td>
            <td><?php echo h($post->pubDate()); ?></td>
            <td><input type="number" name="post[position]" value="<?php echo h($post->position);?>" min="1" max="10" /></td>
            <td class="text-center align-middle">
              <input type="hidden" name="post[featured]" value="0" />
              <input type="checkbox" name="post[featured]" value="1"<?php if($post->featured()) { echo " checked"; } ?> />
            </td>
            <td class="align-middle"><a class="action" href="<?php echo $post->link; ?>" target="_blank">View</a></td>
            <?php if ($admin->is_admin()) { ?>
            <td class="align-middle"><a class="action" href="<?php echo url_for('/staff/posts/edit.php?id=' . h(u($post->id))); ?>">Edit</a></td>
            <td class="align-middle"><a class="action" href="<?php echo url_for('/staff/posts/delete.php?id=' . h(u($post->id))); ?>">Delete</a></td>
            <td class="align-middle"><input type="submit" value="Update" /></td>
            <?php } ?>
            </form>
      	  </tr>
        <?php } ?>
    	</table>
    </div><!-- Contest posts -->

  <?php }

}

?>
