<?php

class Spot {

	public $firstname;
	public $lastname;
	private $personID;
	public $email;
	public $client;
	public $title;
	public $duedate;
	public $startdate;
	public $enddate;
	public $adtype;
	public $length;
	public $rotation;
	public $stations;
	public $script;
	public $notes;

	public function __construct( $args = [] ) {
		$this->firstname = $args['first'] ?? '';
		$this->lastname = $args['last'] ?? '';
		$this->email = $args['email'] ?? '';
		$this->client = $args['client'] ?? '';
		$this->title = $args['title'] ?? '';
		$this->duedaate = $args['duedate'] ?? '';
		$this->startdate = $args['startdate'] ?? '';
		$this->enddate = $args['enddate'] ?? '';
		$this->adtype = $args['adtype'] ?? '';
		$this->length = $args['length'] ?? '';
		$this->rotation = $args['rotation'] ?? '';
		$this->stations = $args['station'] ?? [];
		$this->script = $args['script'] ?? '';
		$this->notes = $args['notes'] ?? '';
		$this->cartid = 'API' . mt_rand( 1000, 9999 );
		$this->errors = [];

	}

	public function getPersonID() {
		$ch = curl_init( 'http://api-v2.internal.vcreative.net/app_test.php/lov' );

		$header = array(
			'Content-type:text/json',
			'token: 15567415584993',
		);

		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$curl = curl_exec( $ch );
		$vcreative = json_decode( $curl, JSON_PRETTY_PRINT )['persons'];

		curl_close( $ch );

		foreach ( $vcreative as $person ) {
			if ( $person['lastname'] == $this->lastname && $person['firstname'] == $this->firstname ) {
				$this->personID = $person['personid'];
				break;
			}
		}

		return false;

	}

	public function post() {
		$start = microtime( true );

		$this->validate();
		if ( ! empty( $this->errors ) ) {
			return false;
		}

		$this->getPersonID();

		$stations = [];
		foreach ( $this->stations as $station ) {
			$stations[] = '{
           "stationid" : "' . $station . '",
           "cartid" : "' . $this->cartid . '",
           "scheduledflag" : "0"
        }';
		}

		$stationJSON = implode( ', ', $stations );

		$postfields = '{
    "clientname": "' . $this->client . '",
    "crtitle": "' . $this->title . '",
    "duedate": "' . $this->duedate . '",
    "runstartdate": "' . $this->startdate . '",
    "runenddate": "' . $this->enddate . '",
    "crlength": "' . $this->length . '",
    "rotationpercent": "' . $this->rotation . '",
    "crstatus": "G",
    "adtypeid": "' . $this->adtype . '",
    "crscript" : "' . $this->script . '",
    "prodnotes" : "' . $this->notes . '",
    "cartid" : "' . $this->cartid . '",
    "Station": [' . $stationJSON . '
    ],
    "POC": [
   {
         "personid": "' . $this->personID . '",
         "howid": "0"
     },
   {
         "personid": "' . $this->personID . '",
         "howid": "8"
     }
    ]
    }';
		var_dump( $postfields );
		$end = microtime( true ) - $start;
		echo '(' . number_format( $end, 2 ) . ' seconds)';
		return true;
		// Post Spot
		$ch = curl_init( 'http://api-v2.internal.vcreative.net/app_test.php/spot_update/0' );

		$header = array(
			'Content-type:text/json',
			'token: 15567415584993',
		);

		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $postfields );

		// $curl = curl_exec($ch);
		// // $vcreative = json_decode($curl, JSON_PRETTY_PRINT);
		//
		// curl_close($ch);
		//
	}

	protected function validate() {
		$this->errors = [];

		if ( is_blank( $this->firstname ) ) {
			$this->errors[] = 'First name cannot be blank.';
		}

		if ( is_blank( $this->lastname ) ) {
			$this->errors[] = 'Last name cannot be blank.';
		}

		if ( is_blank( $this->email ) ) {
			$this->errors[] = 'Email cannot be blank.';
		} elseif ( ! has_length( $this->email, array( 'max' => 255 ) ) ) {
			$this->errors[] = 'Last name must be less than 255 characters.';
		} elseif ( ! has_valid_email_format( $this->email ) ) {
			$this->errors[] = 'Email must be a valid format.';
		}

		if ( is_blank( $this->client ) ) {
			$this->errors[] = 'Client Name cannot be blank.';
		}

		if ( is_blank( $this->title ) ) {
			$this->errors[] = 'Spot Title cannot be blank.';
		}

		if ( is_blank( $this->length ) ) {
			$this->errors[] = 'Length of spot cannot be blank';
		}

		if ( is_blank( $this->rotation ) ) {
			$this->errors[] = 'Rotation cannot be blank';
		}

		if ( empty( $this->stations ) ) {
			$this->errors[] = 'You must choose at least one station.';
		}

		if ( is_blank( $this->script ) ) {
			$this->errors[] = 'Your script cannont be empty';
		}

		return $this->errors;
	}

	public static function find_by_username( $username ) {
		$sql = 'SELECT * FROM ' . static::$table_name . ' ';
		$sql .= "WHERE username='" . self::$database->escape_string( $username ) . "'";
		$obj_array = static::find_by_sql( $sql );
		if ( ! empty( $obj_array ) ) {
			return array_shift( $obj_array );
		} else {
			return false;
		}
	}

	public function login( $user ) {
		if ( $user ) {
			session_regenerate_id();
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->username = $_SESSION['username'] = $user->username;
			$this->last_login = $_SESSION['last_login'] = time();
		}
		return true;
	}

	public function is_logged_in() {
		// return isset($this->user_id);
		return isset( $this->user_id ) && $this->last_login_is_recent();
	}

	public function user_id() {
		return $this->user_id;
	}

	public function logout() {
		unset( $_SESSION['user_id'] );
		unset( $_SESSION['username'] );
		unset( $_SESSION['last_login'] );
		unset( $this->user_id );
		unset( $this->username );
		unset( $this->last_login );

		return true;
	}

	private function check_stored_login() {
		if ( isset( $_SESSION['user_id'] ) ) {
			$this->user_id = $_SESSION['user_id'];
			$this->username = $_SESSION['username'];
			$this->last_login = $_SESSION['last_login'];
		}
	}

	private function last_login_is_recent() {
		if ( ! isset( $this->last_login ) ) {
			return false;
		} elseif ( ( $this->last_login + self::MAX_LOGIN_AGE ) < time() ) {
			return false;
		} else {
			return true;
		}
	}

	public function message( $msg = '' ) {
		if ( ! empty( $msg ) ) {
			// Set message
			$_SESSION['message'] = $msg;
			return true;
		} else {
			// this is a get message
			return $_SESSION['message'] ?? '';

		}
	}

	public function clear_message() {
		unset( $_SESSION['message'] );
	}

}


