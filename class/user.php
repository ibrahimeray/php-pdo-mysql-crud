<?php

class User {

	private $mysqli;

	// Connect to database
	function __construct($host, $user, $pass, $database) {
		// Connect to database
		$this->mysqli = new mysqli($host, $user, $pass, $database);
		$this->mysqli->set_charset('utf8');

		if (mysqli_connect_errno($this->mysqli)) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	// Close database
	function close_database() {
		$this->mysqli->close();
	}

	public function login($benutzername, $password) {

		// Change username to lowercase
		$benutzername = strtolower($benutzername);

		// Check username and password in kunden
		$query = "SELECT * FROM recruiter 
                            WHERE benutzername = ? AND password = ?";
		$stmt = $this->mysqli->stmt_init();
		if ($stmt->prepare($query)) {
			// Bind your variables to replace the ?s
			$stmt->bind_param('ss', $username, $password);
			// Execute query
			$stmt->execute();
			/* store result */
			$stmt->store_result();
			$row = $stmt->num_rows;

			if ($row === 0) {
				return false;
			} else {
				$result = $this->mysqli->query($query);
				$data = mysqli_fetch_array($result);
				return $data;
			}
		}
	}

	public function register($vorname, $nachname, $geburtsdatum, $benutzername, $password) {

		try {
			$hash_password = password_hash($password, PASSWORD_DEFAULT);
			$geburtsdatum   = date("Y-m-d",$geburtsdatum);

			$abfrage = $this->db->prepare("SELECT benutzername FROM recruiter WHERE benutzername=:benutzername");
			$abfrage->execute(array(':benutzername' => $benutzername));
			$row = $abfrage->fetch(PDO::FETCH_ASSOC);

			if ($row['benutzername'] == $benutzername) {
				return false;
			} else {
				$abfrage = $this->db->prepare("INSERT INTO recruiter(benutzername,password,vorname,nachname,geburtsdatum) 
                                  VALUES(:benutzername, :password, :vorname,:nachname,:geburtsdatum)");
				$abfrage->bindparam(":benutzername", $benutzername);
				$abfrage->bindparam(":password", $hash_password);
				$abfrage->bindparam(":vorname", $vorname);
				$abfrage->bindparam(":nachname", $nachname);
				$abfrage->bindparam(":geburtsdatum", $datum_format);
				$abfrage->execute();
				return true;
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function erstellen($titel, $beschreibung, $erstellungsdatum, $user_id) {


		$query = "INSERT INTO `jobs` (`user_id`, `titel`,`beschreibung`,`erstellungsdatum`) 
                                  VALUES('$user_id', '$titel', '$beschreibung','$erstellungsdatum')";

		$result = $this->mysqli->query($query);


		var_dump($result->num_rows);
	}

	public function edit($user_id, $jobs_id) {

		$query = "SELECT * FROM jobs WHERE jobs_id=$jobs_id AND user_id=$user_id";
		$result = $this->mysqli->query($query);
		return $result;
	}

	public function edit_save($titel, $beschreibung, $erstellungsdatum, $user_id, $jobs_id) {

		$query = "UPDATE jobs SET 
				titel='$titel', beschreibung ='$beschreibung', erstellungsdatum=$erstellungsdatum
				WHERE jobs_id=$jobs_id AND user_id=$user_id";
		$result = $this->mysqli->query($query);
		return "OK";
	}

	public function jobliste($user_id) {

		$query = "SELECT * FROM jobs WHERE user_id=" . $user_id;
		$result = $this->mysqli->query($query);
		return $result;
	}

	public function delete($jobs_id, $user_id) {

		// Get all deals data from deals table
		$query = "DELETE FROM jobs WHERE jobs_id=$jobs_id AND user_id=$user_id";
		$result = $this->mysqli->query($query);

		// Gesamte Liste Anzeigen
		$query = "SELECT * FROM jobs WHERE user_id=" . $user_id;
		$result = $this->mysqli->query($query);
		$data = mysqli_fetch_array($result);
		return $data;
	}

	public function is_loggedin() {
		if (isset($_SESSION['user_session'])) {
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