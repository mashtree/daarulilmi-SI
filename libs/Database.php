<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Database extends PDO {

    public $db;
    public $bind;
    protected $_fetchMode = PDO::FETCH_ASSOC;
	private $lastInsertId;
	private $affectedRows;

    public function __construct() {
		try {
			parent::__construct(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
		} catch ( PDOException $e )  {
			echo "<div style='color:white;margin-top:30%;margin-left:40%;background-color:red;align:center;width:25%;position:absolute'>TIDAK DAPAT MENGAKSES DATABASE</div>";
		}
	}

    public function select($sql, $array = array()) {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        return $sth->fetchAll($this->_fetchMode);
    }

    public function update($table, $data, $where) {

        ksort($data);

        $field = null;
        foreach ($data as $key => $value) {
            $field .= "$key = :$key,";
        }

        $field = rtrim($field, ',');

        $wheres = null;
        if (is_array($where)) {
            $wheres = implode(' AND ', $where);
        } else {
            $wheres = $where;
        }
		$this->beginTransaction();
		try{
			$sql = "UPDATE $table SET $field WHERE $wheres";

	//        echo $sql;
			$sth = $this->prepare($sql);

			foreach ($data as $key => $value) {
				$sth->bindValue(":$key", $value);
			}

			$sth->execute();
			$this->affectedRows = $sth->rowCount();
			$this->commit();
			return true;
		}catch(PDOException $e){
			$this->rollback();
			return false;
		}
    }

    public function insert($table, $data) {

        ksort($data);

        $fieldName = implode(',', array_keys($data));
        $fieldValue = implode(',:', array_keys($data));
        $fieldValue = ':' . $fieldValue;
		$this->beginTransaction();
		try{
			$sql = "INSERT INTO $table($fieldName) VALUES ($fieldValue)";

			$sth = $this->prepare($sql);

			foreach ($data as $key => $value) {
				$sth->bindValue(":$key", $value);
			}

			$sth->execute();
			
			$this->affectedRows = $sth->rowCount();
			$this->commit();
			return true;
		}catch(PDOException $e){
			$this->rollback();
			return false;
		}
    }

    public function delete($table, $where) {
		$this->beginTransaction();
		try{
			$sql = "DELETE FROM $table WHERE $where";

			$sth = $this->prepare($sql);
			$sth->execute();
			$this->affectedRows = $sth->rowCount();
			$this->commit();
			return true;
		}catch(PDOException $e){
			$this->rollback();
			return false;
		}
    }

    public function countRow($table) {
        $sql = "SELECT * FROM " . $table;
        $sth = $this->prepare($sql);
        $sth->execute();
        $return = count($sth->fetchAll($this->_fetchMode));
        return $return;
    }

    public function get_column_table($table) {
        $sql = "SHOW COLUMNS FROM " . $table;
        $data = $this->select($sql);
        return $data;
    }

    public function last_insert_id(){
        return $this->lastInsertId();
    }

}