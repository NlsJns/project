<?php
class Picto
{
	private $db_server = "localhost";
	private $db_user = "root";
	private $db_password = "root";
	private $db_database = "lesphp";

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
	
	public function Save($eventId, $lengte, $emotie, $genre)
	{
		$conn = new mysqli($this->db_server, $this->db_user, $this->db_password, $this->db_database);
		$conn->set_charset("utf8");
		if ($lengte == "leeg") {
			throw new Exception('Gelieve een lengte in te vullen');
		}
		$query = "INSERT INTO `tblPictos` (`cdbid`, `lengte`, `emotie`, `genre`)
VALUES
	('".$conn->real_escape_string($eventId)."','".$conn->real_escape_string($lengte)."','".$conn->real_escape_string($emotie)."','".$conn->real_escape_string($genre)."');";
	
		$result = $conn->query($query);
		return $result;
	}
}
?>