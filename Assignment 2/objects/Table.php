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

	public function setTableClass($tableclass){
		$this->tableclass = $tableclass;
	}

	public function setTableHeaderClass($thclass){
		$this->thclass = $thclass;
	}

	public function setTableRowClass($trclass){
		$this->trclass = $trclass;
	}

	public function setTableLastRowClass($lasttrclass){
		$this->lasttrclass = $lasttrclass;
	}

	public function render(){
		if (count($this->columns)==0){
			return false;
		}
		if ($this->tableclass != ""){
			echo "<div class='".$this->tableclass."'><table>";
		} else {
			echo "<div><table>";
		}
		if ($this->thclass != ""){
			echo "<tr class='".$this->thclass."'>";
		} else {
			echo "<tr>";
		}
		foreach ($this->columns as $column){
			echo "<th>".t(strtoupper($column))."</th>";
		}
		echo "</tr>";
		$numrows = count($this->rows);
		for ($i = 0; $i < $numrows; $i++){
			if ($i == ($numrows-1)){
				if ($this->lasttrclass != ""){
					echo "<tr class'".$this->lasttrcclass."'>";
				} else {
					echo "<tr>";
				}				
			} else {
				if ($this->trclass != ""){
					echo "<tr class'".$this->trclass."'>";
				} else {
					echo "<tr>";
				}
			}
			foreach ($this->rows[$i] as $r){
				echo "<td>".$r."</td>";
			}
			echo "</tr>";
		}
		echo "</table></div>";
	}

	public function renderCart($ids){
		if (count($this->columns)==0){
			return false;
		}
		if ($this->tableclass != ""){
			echo "<div class='".$this->tableclass."'><table>";
		} else {
			echo "<div><table>";
		}
		if ($this->thclass != ""){
			echo "<tr class='".$this->thclass."'>";
		} else {
			echo "<tr>";
		}
		foreach ($this->columns as $column){
			echo "<th>".t(strtoupper($column))."</th>";
		}
		echo "</tr>";
		$numrows = count($this->rows);
		for ($i = 0; $i < $numrows; $i++){
			if ($i == ($numrows-1)){
				if ($this->lasttrclass != ""){
					echo "<tr class'".$this->lasttrcclass."'>";
				} else {
					echo "<tr>";
				}				
			} else {
				if ($this->trclass != ""){
					echo "<tr class'".$this->trclass."'>";
				} else {
					echo "<tr>";
				}
			}
			echo "<form name='addorremove' action='ajax/addorremove.php' method='post'>";
			echo "<input type='hidden' name='prev' value=".$_SERVER['REQUEST_URI'].">";
			for ($j = 0; $j < count($this->rows[$i]); $j++){
				if ($j == 2 && $i != ($numrows-1)){
					echo "<td><input type='hidden' name='id' value=".$ids[$i]."><input class='button' type='Submit' name='add' value='+' onclick='addItem(\"".$ids[$i]."\");return false;'><br>";
					echo $this->rows[$i][$j]."<br>";
					echo "<input type='hidden' name='id' value=".$ids[$i]."><input class='button' type='Submit' name='rem' value='-' onclick='subItem(\"".$ids[$i]."\");return false;'></td>";
				} else {
					echo "<td>".$this->rows[$i][$j]."</td>";					
				}
								
			}
			echo "</tr>";
			echo "</form>";
		}
		echo "</table></div>";
	}
}
