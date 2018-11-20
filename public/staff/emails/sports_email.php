<?php require_once('../../../private/initialize.php'); ?>

<?php
  if(!isset($_GET['station'])) {
  redirect_to(url_for('/staff/emails/index.php'));
  }
  $station = $_GET['station'];
  foreach(Email::STATION as $station_id => $station_name) {
    if($station == $station_id) {
    $stationName = $station_name;
    break;
    }
  }
  foreach(Email::STATION_URL as $station_id => $station_url) {
    if($station == $station_id) {
    $stationURL = "https://www." . $station_url . ".com/";
    break;
    }
  }
?>
<?php require_once('../../../private/content.php'); ?>

<?php $page_title = $stationName . ' Email'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="row">
  <div class="col-lg-8 offset-lg-2">
    <?php
    if ($featured) {
      $x = first_position($featured);
      ?>

    <div class="card mb-5" id="featured">
      <div class="card-header">
          <span>Featured</span>
      </div>

        <div class="card-body">
          <div class="card mb-2">
            <img class="card-img" src="<?php echo $featured[0]->imageLink ?>" alt="<?php echo $featured[0]->title ?>">
            <div class="card-img-overlay d-flex hero">
              <div class="mt-auto text-white">
                <h2 class="card-title"><a href="<?php echo $featured[0]->link ?>" target="_blank"><?php echo $featured[0]->title ?></a></h2>
                <p class="card-text"><?php echo $featured[0]->excerpt; ?></p>
              </div>
            </div>
          </div>
          <div class="card-title-below mt-2">
            <h2 class="card-title"><a href="<?php echo $featured[0]->link ?>" target="_blank"><?php echo $featured[0]->title ?></a></h2>
            <p class="card-text"><?php echo $featured[0]->excerpt; ?></p>
          </div>
        </div>
        <div class="list-group list-group-flush">
          <?php if ($featured) {
            foreach ($featured as $i => $post) {
              if ($i == 0) {
                continue;
              }
              if ($i == 1) { ?>
                <div class="card mx-2 mx-lg-4">
                  <div class="d-flex media list-group-item" id="featured">
                    <div class="my-auto"><img class="d-flex img-fluid rounded mr-3"  src="<?php echo $post->imageLink ?>" alt="<?php echo $post->title ?>"></div>
                    <div class="media-body">
                      <h4><a href="<?php echo $post->link; ?>"><?php echo $post->title; ?></a></h4>
                      <p class="card-text"><?php echo $post->excerpt; ?></p>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
              <a class="list-group-item" href="<?php echo $post->link; ?>"><?php echo $post->title; ?></a>
            <?php }}
          } ?>
        </div>
    </div>
  <?php } ?><!--Featured Section-->

  <?php
  if ($sports_posts) {
    // var_dump($sports_posts);
    foreach ($sports_posts as $sports_post) {
      if ($sports_post) {
  ?>
  <div class="card mb-5" id="news">
    <div class="card-header">
        <div class="d-flex">
          <div class="flex-grow-1">
            <span><?php echo $sports_post[0]->category(); ?></span>
          </div>
          <div class="my-auto"><a href="<?php echo $stationURL . 'category/utes';?>" target="_blank">See All &raquo;</a></div>
        </div>
    </div>

      <div class="card-body">
        <div class="card mb-2">
          <a href="<?php echo $sports_post[0]->link ?>" target="_blank"><img class="card-img img-fluid mb-2 mb-lg-1" src="<?php echo $sports_post[0]->imageLink ?>" alt="<?php echo $sports_post[0]->title ?>"></a>
          <div class="card-img-overlay d-flex hero">
            <div class="mt-auto text-white">
              <h2 class="card-title"><a href="<?php echo $sports_post[0]->link ?>" target="_blank"><?php echo $sports_post[0]->title ?></a></h2>
              <p class="card-text"><?php echo $sports_post[0]->excerpt; ?></p>
            </div>
          </div>
        </div>
        <div class="card-title-below mt-2">
          <h2 class="card-title"><a href="<?php echo $sports_post[0]->link ?>" target="_blank"><?php echo $sports_post[0]->title ?></a></h2>
          <p class="card-text"><?php echo $sports_post[0]->excerpt; ?></p>
        </div>
      </div>
      <div class="list-group list-group-flush">
        <?php if ($sports_post) {
          foreach ($sports_post as $i => $post) {
            if ($i >= 6) {
              break;
            }
            if ($i == 0) {
              continue;
            }
            if ($i == 1) { ?>
              <div class="card mx-2 mx-lg-4">
                <div class="d-flex media list-group-item" id="news_featured">
                  <div class="my-auto"><img class="d-flex img-fluid rounded mr-3" src="<?php echo $post->imageLink ?>" alt="<?php echo $post->title ?>"></div>
                  <div class="media-body">
                    <h4><a href="<?php echo $post->link; ?>"><?php echo $post->title; ?></a></h4>
                    <p class="card-text"><?php echo $post->excerpt; ?></p>
                  </div>
                </div>
              </div>
            <?php } else { ?>
            <a class="list-group-item" href="<?php echo $post->link; ?>"><?php echo $post->title; ?></a>
          <?php
        }}} ?>
      </div>
      <div class="card-footer text-center">
        <a class="card-link text-center" href="<?php echo $stationURL . 'category/utes';?>" target="_blank">See All</a>
      </div>
    </div>
  <?php }}} ?><!--Sports Sections-->

  <?php
  if ($news) { ?>
    <div class="card mb-5" id="news">
      <div class="card-header">
          <div class="d-flex">
            <div class="flex-grow-1">
              <span>News</span>
            </div>
            <div class="my-auto"><a href="<?php echo $stationURL . 'category/news';?>" target="_blank">See All &raquo;</a></div>
          </div>
      </div>

        <div class="card-body">
          <div class="card mb-2">
            <a href="<?php echo $news[0]->link ?>" target="_blank"><img class="card-img img-fluid mb-2 mb-lg-1" src="<?php echo $news[0]->imageLink ?>" alt="<?php echo $news[0]->title ?>"></a>
            <div class="card-img-overlay d-flex hero">
              <div class="mt-auto text-white">
                <h2 class="card-title"><a href="<?php echo $news[0]->link ?>" target="_blank"><?php echo $news[0]->title ?></a></h2>
                <p class="card-text"><?php echo $news[0]->excerpt; ?></p>
              </div>
            </div>
          </div>
          <div class="card-title-below mt-2">
            <h2 class="card-title"><a href="<?php echo $news[0]->link ?>" target="_blank"><?php echo $news[0]->title ?></a></h2>
            <p class="card-text"><?php echo $news[0]->excerpt; ?></p>
          </div>
        </div>
        <div class="list-group list-group-flush">
          <?php if ($news) {
            foreach ($news as $i => $post) {
              if ($i >= 6) {
                break;
              }
              if ($i == 0) {
                continue;
              }
              if ($i == 1) { ?>
                <div class="card mx-2 mx-lg-4">
                  <div class="d-flex media list-group-item" id="news_featured">
                    <div class="my-auto"><img class="d-flex img-fluid rounded mr-3" src="<?php echo $post->imageLink ?>" alt="<?php echo $post->title ?>"></div>
                    <div class="media-body">
                      <h4><a href="<?php echo $post->link; ?>"><?php echo $post->title; ?></a></h4>
                      <p class="card-text"><?php echo $post->excerpt; ?></p>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
              <a class="list-group-item" href="<?php echo $post->link; ?>"><?php echo $post->title; ?></a>
            <?php
          }}} ?>
        </div>
        <div class="card-footer text-center">
          <a class="card-link text-center" href="<?php echo $stationURL . 'category/news';?>" target="_blank">See All</a>
        </div>
      </div>
    <?php } ?><!--News Section-->

  <?php
  if ($contests) { ?>
    <div class="card mb-5" id="contests">
      <div class="card-header">
        <div class="d-flex">
          <div class="flex-grow-1">
            <span>Contests</span>
          </div>
          <div class="my-auto"><a href="<?php echo $stationURL . 'contests';?>" target="_blank">See All &raquo;</a></div>
        </div>
      </div>
      <div class="card-body">
        <div class="card mb-2">
          <a href="<?php echo $contests[0]->link ?>" target="_blank"><img class="card-img img-fluid mb-2 mb-lg-1" src="<?php echo $contests[0]->imageLink ?>" alt="<?php echo $contests[0]->title ?>"></a>
          <div class="card-img-overlay d-flex hero">
            <div class="mt-auto text-white">
              <h2 class="card-title"><a href="<?php echo $contests[0]->link ?>" target="_blank"><?php echo $contests[0]->title ?></a></h2>
              <p class="card-text"><?php echo $contests[0]->excerpt; ?></p>
            </div>
          </div>
        </div>
        <div class="card-title-below mt-2">
          <h2 class="card-title"><a href="<?php echo $contests[0]->link ?>" target="_blank"><?php echo $contests[0]->title ?></a></h2>
          <p class="card-text"><?php echo $contests[0]->excerpt; ?></p>
        </div>
      </div>
      <div class="list-group list-group-flush">
        <?php if ($contests) {
          foreach ($contests as $i => $contest) {
            if ($i >= 6) {
              break;
            }
            if ($i == 0) {
              continue;
            }
            if ($i == 1) { ?>
              <div class="card mx-2 mx-lg-4">
                <div class="d-flex media list-group-item" id="contest_featured">
                  <div class="my-auto"><img class="d-flex img-fluid rounded mr-3" src="<?php echo $contest->imageLink ?>" alt="<?php echo $contest->title ?>"></div>
                  <div class="media-body">
                    <h4><a href="<?php echo $contest->link; ?>"><?php echo $contest->title; ?></a></h4>
                    <p class="card-text"><?php echo $contest->excerpt; ?></p>
                  </div>
                </div>
              </div>
            <?php } else { ?>
            <a class="list-group-item" href="<?php echo $contest->link; ?>"><?php echo $contest->title; ?></a>
          <?php }}
        } ?>
      </div>
      <div class="card-footer text-center">
        <a class="card-link text-center" href="<?php echo $stationURL . 'contests';?>" target="_blank">See All</a>
      </div>
    </div> <!--Contests Section-->
  <?php } ?>

  <?php
  if ($life) { ?>
    <div class="card mb-5" id="life">
      <div class="card-header">
        <div class="d-flex">
          <div class="flex-grow-1">
            <span>Life</span>
          </div>
          <div class="my-auto"><a href="<?php echo $stationURL . 'category/life';?>" target="_blank">See All &raquo;</a></div>
        </div>
      </div>
          <div class="card-body">
            <div class="card mb-2">
              <a href="<?php echo $life[0]->link ?>" target="_blank"><img class="card-img img-fluid mb-2 mb-lg-1" src="<?php echo $life[0]->imageLink ?>" alt="<?php echo $life[0]->title ?>"></a>
              <div class="card-img-overlay d-flex hero">
                <div class="mt-auto text-white">
                  <h2 class="card-title"><a href="<?php echo $life[0]->link ?>" target="_blank"><?php echo $life[0]->title ?></a></h2>
                  <p class="card-text"><?php echo $life[0]->excerpt; ?></p>
                </div>
              </div>
            </div>
            <div class="card-title-below mt-2">
              <h2 class="card-title"><a href="<?php echo $life[0]->link ?>" target="_blank"><?php echo $life[0]->title ?></a></h2>
              <p class="card-text"><?php echo $life[0]->excerpt; ?></p>
            </div>
          </div>

        <div class="list-group list-group-flush">
          <?php if ($life) {
            foreach ($life as $i => $life_post) {
              if ($i >= 6) {
                break;
              }
              if ($i == 0) {
                continue;
              }
              if ($i == 1) { ?>
                <div class="card mx-2 mx-lg-4">
                  <div class="d-flex media list-group-item" id="life_featured">
                    <div class="my-auto"><img class="d-flex img-fluid rounded mr-3" src="<?php echo $life_post->imageLink ?>" alt="<?php echo $life_post->title ?>"></div>
                    <div class="media-body">
                      <h4><a href="<?php echo $life_post->link; ?>"><?php echo $life_post->title; ?></a></h4>
                      <p class="card-text"><?php echo $life_post->excerpt; ?></p>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
              <a class="list-group-item" href="<?php echo $life_post->link; ?>"><?php echo $life_post->title; ?></a>
            <?php }}
          } ?>
        </div>
        <div class="card-footer text-center">
          <a class="card-link text-center" href="<?php echo $stationURL . 'category/life';?>" target="_blank">See All</a>
        </div>
      </div>
    <?php } ?><!--Life Section-->

    <?php if ($latest) { ?>
    <div class="card mb-5" id="latest">
      <div class="card-header">
        <div class="d-flex">
          <div class="flex-grow-1">
            <span>Latest</span>
          </div>
          <div class="my-auto"><a href="<?php echo $stationURL . 'blog';?>" target="_blank">See All &raquo;</a></div>
        </div>
      </div>

        <div class="list-group list-group-flush">
          <?php if ($latest) {
            foreach ($latest as $i => $post) {
              if ($i >= 6) {
                break;
              } ?>
              <a class="list-group-item" href="<?php echo $post->link; ?>"><?php echo $post->title; ?></a>
          <?php  }} ?>
        </div>
        <div class="card-footer text-center">
          <a class="card-link text-center" href="https://rsl.com" target="_blank">See All</a>
        </div>
    </div> <!--Latest News Section-->
  <?php } ?>
  </div> <!-- Main Section - Left Side -->


</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>
