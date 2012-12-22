<?php

 require_once("flyError.php");

 class flyDbMysql extends flyDb {


	/**
	 * @access public
	 */
	var $DB_SERVER;
	var $DB_USER;
	var $DB_PASS;
	var $DB_NAME;

	var $connected =false;
	var $lazy =true;
	var $last_insert_id = false;
	var $total_queries =0;
	var $time_taken_total =0;
	var $time_taken =array();
	var $last_query ="";
	var $query_stack = array();

	/**
	 * @access private
	 */
	var $db_link;
	var $result_link;



	function flyDbMysql($secret) {
		if($secret!="flyMysqlpass") {
			return new flyError("Unable to call private constructor of Singleton class. Use getInstance() call instead!");
		}
	}


	function & getInstance(){
		//not used?
	}


	/**
	 *  Creates connection to database.
	 *  If connection is lazy, than only stores connection info,
	 *  then connects while first query runs.
	 */
	function connect($server, $user, $pass, $dbname) {
		$this->DB_SERVER = $server;
		$this->DB_USER   = $user;
		$this->DB_PASS   = $pass;
		$this->DB_NAME   = $dbname;

		if(!$this->lazy){
			$this->do_connect();
		}
	}


	/**
	 *  @access private
	 *  Creates connection itself.
	 *  Might not be called manually.
	 */
	function do_connect() {
		$this->db_link = mysql_connect( $this->DB_SERVER, $this->DB_USER, $this->DB_PASS );
		if($this->db_link === false) {
			return new flyError("Connection to DB failed. Response: ".mysql_error());
		}
		$res = mysql_select_db( $this->DB_NAME , $this->db_link );
		if($res === false) {
			return new flyError("Unable to select DB \"$this->DB_NAME\". ".mysql_error());
		}
		$this->connected = true;
	}


	/**
	 * Execute a query to database,
	 * that doesn't return any data
	 * (INSERT, UPDATE, DELETE, etc.)
	 * If succes, returns
	 * number of rows affected.
	 * In a case of an error
	 * returns false.
	 */
	 function exec($query =""){
		$res = $this->do_query($query);
		if($res !== false){
			return mysql_affected_rows($this->db_link);
		}
		return false;
	 }


	 /**
	  * @access private
	  * Execute a query itself.
	  * Might not be called manually.
	  */
	 function do_query($query){
	 	if($this->lazy && !$this->connected) {
	 		$this->do_connect();
	 	}

	 	$this->last_query = $query;
	 	$this->query_stack[] = $query;
	 	 list($usec, $sec) = explode(" ", microtime());
	 	$time = ((float)$usec+(float)$sec);

		$result = mysql_query($query);
		$this->result_link = $result;
		
		if ($result === false) {
			return new flyError("Error in DB query. Response: ".mysql_error() );
		}

		 list($usec, $sec) = explode(" ", microtime());
	 	$time = ((float)$usec+(float)$sec) - $time;

		$this->time_taken[] = $time;
	 	$this->time_taken_total += $time;
		$this->total_queries += 1;
		
		$this->last_insert_id = mysql_insert_id();

		return $result;
	 }


	 /**
	  * Retrieve array with query results
	  * Returns array of objects,
	  * or array of arrays if $return_array==true
	  */
	function fetch_all_rows($query, $return_array =0){
		$result = array();

		$this->do_query($query);

		if(!is_resource($this->result_link)) {
			return false;
		}

		while($row = mysql_fetch_assoc($this->result_link)) {
			if(!$return_array) {
					$object = new stdClass;
					foreach($row as $k=>$v) {
						$object->$k = $v;
					}
					$result[] = $object;
			} else {
					$array = array();
					foreach($row as $k=>$v) {
						$array[$k] = $v;
					}
					$result[] = $array;
			}
		}

		return $result;
	}


	/**
	 * Retrieve single row
	 * Returns FALSE if no data retrieved.
	 * Returns object or assocciative array if $return_array==true
	 */
	 function fetch_row($query, $return_array =0) {
		$this->do_query($query);

		if(!is_resource($this->result_link)) {
			return false;
		}

		if($return_array) {
			if(!$result = mysql_fetch_assoc($this->result_link)) {
				return false;
			}
		} else {
			if(!$result = mysql_fetch_object($this->result_link)) {
				return false;
			}
		}

		return $result;
	 }


	/**
	 * Retrieve one column from query results
	 */
	 function fetch_column($query, $column =null) {
	 	$result = array();

		$this->do_query($query);

		if(!is_resource($this->result_link)) {
			return false;
		}
		
		if(!mysql_num_rows($this->result_link)){
			return array();
		}
		
		$row = mysql_fetch_assoc($this->result_link);
	 	
	 	if(!$row){
	 		return array();
	 	}
		if(is_null($column)){
			$keys = array_keys($row);
			$column = $keys[0];
		}
		if(!isset($row[$column])) {
			return new flyError("Incorrect column specified! (\"$column\")");
		}

		@mysql_data_seek($this->result_link, 0);

		while($row = mysql_fetch_assoc($this->result_link)) {
			$result[] = $row[$column];
		}

		return $result;
	 }


	/**
	 * Retrieve key=>value array
	 * 'Key' and 'Value' are column names in query result
	 * If names or one of them are empty, then first two columns are taken.  
	 */
	 function fetch_key_value($query, $key =null, $value =null) {
		$result = array();

		$this->do_query($query);

		if(!is_resource($this->result_link)) {
			return false;
		}

		$row = mysql_fetch_assoc($this->result_link);
		
	 	if(empty($row)){
			return false;
		}
		
	 	if(empty($key) || empty($value)){
	 		$keys = array_keys($row);
	 	}
		if(empty($key)){
			$key = $keys[0];
		}
		if(empty($value)){
			$value = $keys[1];
		}
		
		if(!array_key_exists($key, $row)) {
			return new flyError("No specified column as Key! (\"$key\")");
		}
		if(!array_key_exists($value, $row)) {
			return new flyError("No specified column as Value! (\"$value\")");
		}

		@mysql_data_seek($this->result_link, 0);

		while($row = mysql_fetch_assoc($this->result_link)) {
			$result[$row[$key]] = $row[$value];
		}

		return $result;
	 }


	/**
	 * Retrieve one column from first row in result
	 * 'Value' - is a column name in query result.
	 * If column name not specified - first column is taken.
	 */
	 function fetch_value($query, $value =null) {
		$this->do_query($query);

		if(!is_resource($this->result_link)) {
			return false;
		}

		$row = mysql_fetch_assoc($this->result_link);
		
		if(!$row || !sizeof($row)){
			return false;
		}
		
		if(is_null($value)){
			$keys = array_keys($row);
			$value = $keys[0];
		}

		return $row[$value];
	 }


 }

?>