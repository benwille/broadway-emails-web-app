<?php require_once('../../private/initialize.php'); ?>

<?php require_login(); ?>

<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Emails</h2>
    <p>This site is intended to help stations create weekly emails quickly and efficiently. Until automatic ingestion is set up the
    email is a two-step process.</p>
    <ol>
      <li>Click on the arrow to the right of your station. And look for the dropdown tab that says "News Feed." Click "News Feed."</li>
      <li>At the bottom of the page you will click "Add Articles."</li>
      <li>Click your station link in the menu</li>
      <li>
        Make sure all articles are in their correct catgory. If not, change the category and update the article.
      </li>
      <li>
        Click the featured checkbox next to any article that should be featured at the very top of the email.
      </li>
      <li>
        For each section you can position the articles in the order you would like. This is NOT required.
      </li>
      <li>
        When you are statified with the positions of the email, click "Create Email" at the top of the page.
      </li>
      <li>
        To get the code you can either A) File > Save the document. Then open it up in a text editor and copy the code to Mailchimp. B) Hit
        Command + U in Firefox or Option + Command + U in Chrome to open the source code. Then copy the code to Mailchimp.
      </li>
    </ol>
    <nav class="mt-5 nav flex-row justify-content-around nav-pills">
      <a class="nav-link btn btn-primary" href="<?php echo url_for('/staff/emails/index.php?station=1'); ?>">X96</a>
      <a class="nav-link btn btn-primary" href="<?php echo url_for('/staff/emails/index.php?station=2'); ?>">Mix</a>
      <a class="nav-link btn btn-primary" href="<?php echo url_for('/staff/emails/index.php?station=3'); ?>">U92</a>
      <a class="nav-link btn btn-primary" href="<?php echo url_for('/staff/emails/index.php?station=4'); ?>">Eagle</a>
      <a class="nav-link btn btn-primary" href="<?php echo url_for('/staff/emails/index.php?station=5'); ?>">Rewind</a>
      <a class="nav-link btn btn-primary" href="<?php echo url_for('/staff/emails/index.php?station=6'); ?>">ESPN</a>
    </nav>
    <!-- <ul>
      <li><a href="<?php //echo url_for('/staff/tasks/index.php'); ?>">Tasks</a></li>
      <li><a href="<?php //echo url_for('/staff/archives/index.php'); ?>">Archives</a></li>
      <li><a href="<?php //echo url_for('/staff/admins/index.php'); ?>">Admins</a></li>
    </ul> -->
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
