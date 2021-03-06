<meta charset="utf-8" />

<html>

<head>
    <title>Control Panel - Boardgame Score Board v1.0</title>
    
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>

</head>

<body>
    
    <!-- Edit a Player Name -->
    <input type="text" id="nameTbx" name="playerName">
    <select name="PlayerID" id="PlayerID">
        <option value="0">Player 1</option>
        <option value="1">Player 2</option>
        <option value="2">Player 3</option>
        <option value="3">Player 4</option>
        <option value="4">Player 5</option>
        <option value="5">Player 6</option>
    </select>
    <button id="submitButton" class="playerBtn" value="submitButton">Update Player Name</button>
    <br/><br/>
   
    <!-- Player Controls -->
	
	<div>Player Controls</div>
	<div id="playerControls">
	
    	<div id="playerTopRow">
        <div id="P1ControlDiv" class="playerControlPanel">
            <h2 id="P1NameHeading"></h2>
            <div id="P1ScoreDiv" class="scoreDiv"></div>

            <div class="scoreButtons">
                &nbsp;<button id="scorePlusBtnP1" class="scoreBtn posBtn" value="scorePlus">+1</button>
                <button id="scoreMinusBtnP1" class="scoreBtn negBtn" value="scoreMinus">-1</button>
                <br/>
                <button id="scorePlusX5BtnP1" class="scoreBtn posBtn" value="scorePlus5x">+5</button>
                <button id="scoreMinusX5BtnP1" class="scoreBtn negBtn" value="scoreMinus5x">-5</button>
            </div>
        </div>

        <div id="P2ControlDiv" class="playerControlPanel">
            <h2 id="P2NameHeading"></h2>
            <div id="P2ScoreDiv" class="scoreDiv"></div>

            <div class="scoreButtons">
                &nbsp;<button id="scorePlusBtnP2" class="scoreBtn posBtn" value="scorePlus">+1</button>
                <button id="scoreMinusBtnP2" class="scoreBtn negBtn" value="scoreMinus">-1</button>
                <br/>
                <button id="scorePlusX5BtnP2" class="scoreBtn posBtn" value="scorePlus5x">+5</button>
                <button id="scoreMinusX5BtnP2" class="scoreBtn negBtn" value="scoreMinus5x">-5</button>
            </div>
        </div>    

        <div id="P3ControlDiv" class="playerControlPanel">
            <h2 id="P3NameHeading"></h2>
            <div id="P3ScoreDiv" class="scoreDiv"></div>

            <div class="scoreButtons">
                &nbsp;<button id="scorePlusBtnP3" class="scoreBtn posBtn" value="scorePlus">+1</button>
                <button id="scoreMinusBtnP3" class="scoreBtn negBtn" value="scoreMinus">-1</button>
                <br/>
                <button id="scorePlusX5BtnP3" class="scoreBtn posBtn" value="scorePlus5x">+5</button>
                <button id="scoreMinusX5BtnP3" class="scoreBtn negBtn" value="scoreMinus5x">-5</button>
            </div>
        </div>    
    </div>  

    	<div id="playerBottomRow">
        <div id="P4ControlDiv" class="playerControlPanel">
            <h2 id="P4NameHeading"></h2>
			<div id="P4ScoreDiv" class="scoreDiv"></div>

            <div class="scoreButtons">
                &nbsp;<button id="scorePlusBtnP4" class="scoreBtn posBtn" value="scorePlus">+1</button>
                <button id="scoreMinusBtnP4" class="scoreBtn negBtn" value="scoreMinus">-1</button>
                <br/>
                <button id="scorePlusX5BtnP4" class="scoreBtn posBtn" value="scorePlus5x">+5</button>
                <button id="scoreMinusX5BtnP4" class="scoreBtn negBtn" value="scoreMinus5x">-5</button>
            </div>
        </div>

        <div id="P5ControlDiv" class="playerControlPanel">
            <h2 id="P5NameHeading"></h2>
            <div id="P5ScoreDiv" class="scoreDiv"></div>

            <div class="scoreButtons">
                &nbsp;<button id="scorePlusBtnP5" class="scoreBtn posBtn" value="scorePlus">+1</button>
                <button id="scoreMinusBtnP5" class="scoreBtn negBtn" value="scoreMinus">-1</button>
                <br/>
                <button id="scorePlusX5BtnP5" class="scoreBtn posBtn" value="scorePlus5x">+5</button>
                <button id="scoreMinusX5BtnP5" class="scoreBtn negBtn" value="scoreMinus5x">-5</button>
            </div>
        </div>    

        <div id="P6ControlDiv" class="playerControlPanel">
            <h2 id="P6NameHeading"></h2>
            <div id="P6ScoreDiv" class="scoreDiv"></div>

            <div class="scoreButtons">
                &nbsp;<button id="scorePlusBtnP6" class="scoreBtn posBtn" value="scorePlus">+1</button>
                <button id="scoreMinusBtnP6" class="scoreBtn negBtn" value="scoreMinus">-1</button>
                <br/>
                <button id="scorePlusX5BtnP6" class="scoreBtn posBtn" value="scorePlus5x">+5</button>
                <button id="scoreMinusX5BtnP6" class="scoreBtn negBtn" value="scoreMinus5x">-5</button>
            </div>
        </div>    

    </div>  
		
	</div>

</body>
</html>

<script>
	
    /*** LOAD Data from XML onLoad ***/
    $(document).ready(function() {

	   	$.ajax({
			type: "GET" ,
			url: "scoreboard.xml" ,
			dataType: "xml" ,
			success: function(xml) {
			
				var count = 1;

				$(xml).find('player').each(function(){

					var name = $(this).find('name').text();
					var score = $(this).find('score').text();
					var pid = $(this).find('pid').text();
					
					$("#P" + count + "NameHeading").html(name);
					$("#P" + count + "ScoreDiv").html(score);
					
					count = count + 1;
				}); 
			}       
		});	
    });

    /*** UPDATE PLAYER NAMES! ***/
    $(".playerBtn").on("click", function() {
        var clickBtnValue = $(this).val();        
        var pid = $("#PlayerID").val();
        var pName = $("#nameTbx").val();

		$.ajax({type: "POST", url: "php/ajax.php", data: {'action': clickBtnValue, 'playerName': pName, 'playerID': pid}
		}).done(function(name){
			var pDiv = parseInt(pid) + 1;
			$("#P" + pDiv + "NameHeading").html(pName);
		});
    });
	
	/*** UPDATE SCORES! ***/
	$(".scoreBtn").on("click", function(){
		var PlayerID = $(this).attr("id");
		PlayerID = PlayerID.substr(PlayerID.length - 1);
		
		var pid = PlayerID - 1;
		var clickBtnValue = $(this).val();
		
		$.ajax({type: "POST", url: "php/ajax.php", data: {'action': clickBtnValue,'playerID': pid}
        }).done(function(score){
            $("#P" + PlayerID + "ScoreDiv").html(score);
        });
	});
	
</script>