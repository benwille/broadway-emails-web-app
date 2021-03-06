<?php

  ob_start(); // turn on output buffering

  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define( 'PRIVATE_PATH', dirname( __FILE__ ) );
  define( 'PROJECT_PATH', dirname( PRIVATE_PATH ) );
  define( 'PUBLIC_PATH', PROJECT_PATH . '/html' );
  define( 'SHARED_PATH', PRIVATE_PATH . '/shared' );

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can set a hardcoded value:
  // define("WWW_ROOT", '/~kevinskoglund/chain_gang/public');
  // define("WWW_ROOT", '');
  // * Can dynamically find everything in URL up to "/html"
  $public_end = strpos( $_SERVER['SCRIPT_NAME'], '/html' ) + 5;
  $doc_root = substr( $_SERVER['SCRIPT_NAME'], 0, $public_end );
  define( 'WWW_ROOT', $doc_root );

  // Root path to server. User for localhost or server path including http:// or https://
  define( 'SERVER_ROOT', $_SERVER['DOCUMENT_ROOT'] );

  require_once( 'functions.php' );
  require_once( 'status_error_functions.php' );
  require_once( 'db_credentials.php' );
  require_once( 'database_functions.php' );
  require_once( 'validation_functions.php' );

  // Load class definitions manually
  // -> Individually
  // require_once( 'classes/databaseobject.class.php' );
  // require_once( 'classes/user.class.php' );
  // require_once( 'classes/email.class.php' );
  // require_once( 'classes/session.class.php' );
  // require_once( 'classes/pagination.class.php' );
  // require_once( 'classes/parsecsv.class.php' );
  // require_once( 'classes/ad.class.php' );


  // Autoload class definitions
  function my_autoload( $class ) {
  	if ( preg_match( '/\A\w+\Z/', $class ) ) {
      $class = strtolower($class);
  		include( 'classes/' . $class . '.class.php' );
  	}
  }
  spl_autoload_register( 'my_autoload' );

  $database = db_connect();
  $db = new DatabaseObject;
  DatabaseObject::set_database( $database );

  $session = new Session();
