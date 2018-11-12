<?php
class Table {
	private $rows = [];
	private $columns = [];
	private $tableclass = "";
	private $thclass = "";
	private $trclass = "";
	private $lasttrclass = "";

	public function __construct($rows=[], $columns=[]){
		$this->rows = $rows;
		$this->columns = $columns;
	}

	public function addColumn($column){
		$this->columns[] = $column;
	}

	public function addRow($row){
		$this->rows[] = $row;
	}

	public function tableclass($tableclass){
		$this->tableclass = $tableclass;
	}

	public function tableclass($thclass){
		$this->thclass = $thclass;
	}

	public function tableclass($trclass){
		$this->trclass = $trclass;
	}

	public function tableclass($lasttrclass){
		$this->lasttrclass = $lasttrclass;
	}

	public function render(){
		if (count($this->column)==0){
			return false;
		}
		if ($tableclass != ""){
			echo "<div class='".$tableclass."'>";
		} else {
			echo "<div>";
		}
		if ($thclass != ""){
			echo "<tr class='".$thclass."'>";
		} else {
			echo "<tr>";
		}
		foreach ($column in $this->columns){
			echo "<th>".$column."</th>";
		}
		echo "</tr>";
		$numrows = count($this->rows);
		for ($i = 0; $i < $numrows; $i++){
			if ($i == ($numrows-1)){
				if ($lasttrcclass != ""){
					echo "<tr class'".$lasttrcclass."'>";
				} else {
					echo "<tr>";
				}				
			} else {
				if ($trclass != ""){
					echo "<tr class'".$trclass."'>";
				} else {
					echo "<tr>";
				}
			}
			foreach ($r in $row){
				echo "<td>".$r."</td>";
			}
			echo "</tr>";
		}
	}
}