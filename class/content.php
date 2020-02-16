<?php

ob_start();
session_start();
include 'controller.php';

class Content extends Controller {

	public function get_allejobs() {
		$query = "SELECT * FROM recruiter r JOIN jobs j ON (j.user_id=r.user_id) ORDER BY erstellungsdatum DESC";
		return Controller::selectquery($query);
	}

	public function login($benutzername, $password) {
		$new_password	= hash('sha256', $benutzername . $password);
		$query			= "SELECT * FROM recruiter WHERE benutzername='$benutzername' AND password='$new_password'";

		if (!empty(Controller::selectquery($query))) {
			$user_array = array();
			$user_array = Controller::selectquery($query);
			$_SESSION['user_id'] = $user_array[0]['user_id'];
			var_dump($_SESSION['user_id']);
		 
			return true;
		} else {
			return false;
		}
	}

	public function register($vorname, $nachname, $geburtsdatum, $benutzername, $password) {

		$query = "SELECT benutzername FROM recruiter WHERE benutzername='$benutzername'";

		if (empty(Controller::selectquery($query))) {
			$new_password	= hash('sha256', $benutzername . $password);
			$benutzername	= Controller::quote($benutzername);
			$vorname		= Controller::quote($vorname);
			$nachname		= Controller::quote($nachname);
			$date			= date_create($geburtsdatum);
			$geburtsdatum	= date_format($date, 'Y-m-d');
		 

			$register_query = "INSERT INTO recruiter (benutzername,password,vorname,nachname,geburtsdatum) 
                                  VALUES( " . $benutzername . ", 
									     '" . $new_password . "', 
										  " . $vorname . ",
										  " . $nachname . ",
										 '" . $geburtsdatum . "')";
			 
			Controller::query($register_query);

			return true;
		} else {
			return false;
		}
	}

	public function erstellen($titel, $beschreibung, $erstellungsdatum, $user_id) {

		$titel				= Controller::quote($titel);
		$beschreibung		= Controller::quote($beschreibung);
		$user_id			= Controller::quote($user_id);
		$erstellungsdatum	= date_create($erstellungsdatum);
		$erstellungsdatum	= date_format($erstellungsdatum, 'Y-m-d');

		$hinzufugen_query = "INSERT INTO jobs (user_id,titel,beschreibung,erstellungsdatum) 
                                  VALUES(" . $user_id . ", 
									     " . $titel . ", 
										 " . $beschreibung . ",
										 '" . $erstellungsdatum . "' )";
		  
		if (Controller::query($hinzufugen_query)) {
			return true;
		} else {
			return false;
		}
	}

	public function get_edit($user_id, $jobs_id) {
		$query = "SELECT * FROM jobs WHERE jobs_id=$jobs_id AND user_id=$user_id";
		return Controller::selectquery($query)[0];
	}

	public function save_edit($titel, $beschreibung, $erstellungsdatum, $user_id, $jobs_id) {

		$titel				= Controller::quote($titel);
		$beschreibung		= Controller::quote($beschreibung);
		$user_id			= Controller::quote($user_id);
		$erstellungsdatum	= date_create($erstellungsdatum);
	    $erstellungsdatum	= date_format($erstellungsdatum, 'Y-m-d');
		
		$update_query		= "UPDATE jobs SET 
								titel=" .$titel. ", beschreibung =" .$beschreibung. ", erstellungsdatum='" .$erstellungsdatum. "'
								WHERE jobs_id=" .$jobs_id. " AND user_id=" .$user_id ;
	
		if (Controller::query($update_query)) {
			return true;
		} else {
			return false;
		}
	}

	public function get_recruiterjobs($user_id) {
		$query = "SELECT * FROM jobs WHERE user_id=" . $user_id;

		return Controller::selectquery($query);
	}
	
	public function delete($jobs_id,$user_id) {
	    $delete_query ="DELETE FROM jobs WHERE jobs_id=$jobs_id AND user_id=$user_id";
		Controller::query($delete_query);
		$this->redirect('dashboard.php');
	}

	public function is_loggedin() {
		if (isset($_SESSION['user_id'])) {
			return true;
		}
	}

	public function redirect($url) {
		header("Location: $url");
	}

	public function logout() {
		session_destroy();
		unset($_SESSION['user_session']);
		$this->redirect("index.php");
	}

}

?>