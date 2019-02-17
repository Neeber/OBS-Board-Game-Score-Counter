<?php
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {
			case 'scorePlus':
				increaseScoreByOne($_POST['playerID']);
				break;
			case 'scoreMinus':
				decreaseScoreByOne($_POST['playerID']);
				break;
			case 'scorePlus5x':
				increaseScoreByFive($_POST['playerID']);
				break;
			case 'scoreMinus5x':
				decreaseScoreByFive($_POST['playerID']);
				break;
			case 'submitButton':
				submitButton($_POST['playerName'], $_POST['playerID']);
				break;
		}
	}

	function readXMLFile($pid,$btnChoice){

		if(file_exists('../scoreboard.xml')){
			//open XML file
			$xml = simplexml_load_file('../scoreboard.xml');

			//xpath to navigate through the xml file
			$player = $xml->xpath('/scoreboard/player');

			if($btnChoice == 1){
				$uScore = $player[$pid]->score;
				$uScore = $uScore + 1;
				$player[$pid]->score = $uScore;
			}elseif($btnChoice == 2){
				$uScore = $player[$pid]->score;
				$uScore = $uScore - 1;
				$player[$pid]->score = $uScore;
			}elseif($btnChoice == 3){
				$uScore = $player[$pid]->score;
				$uScore = $uScore + 5;
				$player[$pid]->score = $uScore;
			}elseif($btnChoice == 4){
				$uScore = $player[$pid]->score;
				$uScore = $uScore - 5;
				$player[$pid]->score = $uScore;
			}

			//save XML file
			$xml->asXML('../scoreboard.xml');

			echo $uScore;

		} else {
			echo 'CNF scoreboard.xml';
		}


		//exit;
	}

	function increaseScoreByOne($pid) {

		$btnChoice = 1;
		readXMLFile($pid,$btnChoice);

	}

	function decreaseScoreByOne($pid) {

		$btnChoice = 2;
		readXMLFile($pid,$btnChoice);

	}

	function increaseScoreByFive($pid) {

		$btnChoice = 3;
		readXMLFile($pid,$btnChoice);
	}

	function decreaseScoreByFive($pid) {

		$btnChoice = 4;
		readXMLFile($pid,$btnChoice);
	}

	function submitButton($pName,$pid) {

		if(file_exists('../scoreboard.xml')){
			//open XML file
			$xml = simplexml_load_file('../scoreboard.xml');

			//xpath to navigate through the xml file
			$player = $xml->xpath('/scoreboard/player');		

			//update value in selected node
			//$pid = $_POST['PlayerID'];
			$player[$pid]->name = $pName;

			//save XML file
			$xml->asXML('../scoreboard.xml');

			echo $pName;

		} else {
			echo 'CNF scoreboard.xml';
		}
		exit;
	}
?>