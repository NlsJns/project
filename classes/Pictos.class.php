<?php
class Picto
{

/////////////    SET DATABASE INFO    /////////////

	private $db_server = "localhost";
	private $db_user = "root";
	private $db_password = "root";
	private $db_database = "lesphp";

/////////////    FUNCTION TO GET ONE EVENT    /////////////

	public function GetAllFromId($eventId)
	{
		$conn = new mysqli($this->db_server, $this->db_user, $this->db_password, $this->db_database);
		$conn->set_charset("utf8");
		$query = "select * from tblPictos where cdbid = '".$conn->real_escape_string($eventId)."';";
		$result = $conn->query($query);
		$result_array=array();

		while($row = $result->fetch_array())
		{
			$result_array[] = $row;
		}

		return($result_array);
	}

/////////////    FUNCTION TO GET EVENTS WITH SAME 'LENGTE'    /////////////

	public function GetAllFromLengte($eventLengte)
	{
		$conn = new mysqli($this->db_server, $this->db_user, $this->db_password, $this->db_database);
		$conn->set_charset("utf8");
		$query = "select cdbid from tblPictos where lengte = '".$conn->real_escape_string($eventLengte)."';";
		$result = $conn->query($query);
		$result_array=array();

		while($row = $result->fetch_array())
		{
			$result_array[] = $row;
		}
		$r_array=array();
		foreach($result_array as $r) {
			$r_array[] = $r['cdbid'];
			
		}
		return($r_array);
	}

/////////////    FUNCTION TO GET EVENTS WITH SAME 'EMOTIE'    /////////////

	public function GetAllFromEmotie($eventEmotie)
	{
		$conn = new mysqli($this->db_server, $this->db_user, $this->db_password, $this->db_database);
		$conn->set_charset("utf8");
		$query = "select cdbid from tblPictos where emotie LIKE '%".$conn->real_escape_string($eventEmotie)."%';";
		$result = $conn->query($query);
		$result_array=array();

		while($row = $result->fetch_array())
		{
			$result_array[] = $row;
		}
		$r_array=array();
		foreach($result_array as $r) {
			$r_array[] = $r['cdbid'];
			
		}
		return($r_array);
	}

/////////////    FUNCTION TO GET EVENTS WITH SAME 'GENRE'    /////////////

	public function GetAllFromGenre($eventGenre)
	{
		$conn = new mysqli($this->db_server, $this->db_user, $this->db_password, $this->db_database);
		$conn->set_charset("utf8");
		$query = "select cdbid from tblPictos where genre LIKE '%".$conn->real_escape_string($eventGenre)."%';";
		$result = $conn->query($query);
		$result_array=array();

		while($row = $result->fetch_array())
		{
			$result_array[] = $row;
		}
		$r_array=array();
		foreach($result_array as $r) {
			$r_array[] = $r['cdbid'];
			
		}
		return($r_array);
	}

	
/////////////    FUNCTION TO SAVE PICTOS    /////////////

	public function Save($eventId, $lengte, $emotie, $genre)
	{
		$conn = new mysqli($this->db_server, $this->db_user, $this->db_password, $this->db_database);
		$conn->set_charset("utf8");
		$query = "INSERT INTO `tblPictos` (`cdbid`, `lengte`, `emotie`, `genre`)
VALUES
	('".$conn->real_escape_string($eventId)."','".$conn->real_escape_string($lengte)."','".$conn->real_escape_string($emotie)."','".$conn->real_escape_string($genre)."');";
	
		$result = $conn->query($query);
		if($result = "") {
			throw new Exception("Er ging iets mis bij het opslagen van uw samenvatting. Probeer het later opnieuw.");
		}
		else {
			return $result;
		}
	}
}
?>