<?php
	class LeagueTable
{
	public function __construct($Sportsmen)
    {
		
		foreach($Sportsmen as $name => $p)
        {
			$this->ranking[$p] = array
            (
                'name' => $name,
                'games_played' => 0, 
                'score' => 0,
                'rank' => $name
            );
        }
	}



	public function recordResult($Sportsmen, $score)
    {
		$this->ranking[$Sportsmen]['games_played']++;
		$this->ranking[$Sportsmen]['score'] += $score;
	}
	
    

	public function reRank()
    {

       
        foreach($this->ranking as $Sportsmen => $records){
        foreach($this->ranking as $Sportsmen1 => $records1){
            if (($records['score'] > $records1['score']) &&
            ($records['rank'] >= $records1['rank']))
            {$this->swap($this->ranking[$Sportsmen]['rank'],$this->ranking[$Sportsmen1]['rank']);}
            
            if (($records['score'] == $records1['score']) &&
            ($records['games_played'] > $records1['games_played']))
            {$this->swap($this->ranking[$Sportsmen]['rank'],$this->ranking[$Sportsmen1]['rank']);}
            // according to index
            if (($records['score'] == $records1['score']) &&
            ($records['games_played'] == $records1['games_played'])&&
            ($records['name'] > $records1['name']))
            {$this->swap($this->ranking[$Sportsmen]['rank'],$this->ranking[$Sportsmen1]['rank']);}



        }
        }


	}
    
    
    function swap(&$x,&$y) {
        $tmp=$x;
        $x=$y;
        $y=$tmp;
    }    


	public function playerRank($rank)
    {
        $this->reRank();

        foreach($this->ranking as $Sportsmen => $records){
            if ($records['rank']==$rank-1)
            return $Sportsmen;
        }

	}

}
      
$table = new LeagueTable(array('Chris', 'Mike', 'Arnold'));
$table->recordResult('Mike', 2);
$table->recordResult('Mike', 3);
$table->recordResult('Arnold', 5);
$table->recordResult('Chris', 5);
echo $table->playerRank(1);
?>
