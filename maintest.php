<?php

include "test.php";

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
<meta charset="UTF-8">
<style>

div#test{ border:#000 1px solid; padding:40px 40px 40px 40px;
font-size: 30px; }

A {
		text-decoration: none;
	width: 100%;
	padding: 10px 160px;
	border-radius: 20px;
	font-size: 22px;
	margin: 10px 0;
	border: none;
	outline: none;
	cursor: pointer;
	transition: 0.6s ease;
	background: lightgray;
	color: #000;
	} 

	A:hover{
			background-color: green;
	color: #fff;


	} 

	input[type=radio] {
    border: 10px;
    width: 2.5em;
    height: 2.5em;
}


button{
	
	width: 25%;
	padding: 10px 50px;
	border-radius: 20px;
	font-size: 22px;
	margin: 10px 0;
	border: none;
	outline: none;
	cursor: pointer;
	transition: 0.6s ease;
	background: lightgray;

}

button:hover{
	background-color: green;
	color: #fff;
}


</style>

</head>

<body>


<h2 id="test_status"></h2>
<div id="test"></div>
<div id="end"></div>

<script type="text/javascript" async defer>

var questionmark = " ? ";

var pos = 0, test, test_status, question, choice, choices, chA, chB, chC,chD, correct = 0;

var questions = [];


//fill the questions array with fetching questions from the database

//function to get question from the server
// for now is having problem so witten manually


	
	
<?php getquestion(); ?> 
questions.push([ " <?php echo $question; ?> "," <?php echo $option1; ?> ", " <?php echo $option2; ?> "," <?php echo $option3; ?> ", " <?php echo $option4; ?> ", " <?php echo $answer; ?> " ,"0"]);

<?php getquestion(); ?> 
questions.push([ " <?php echo $question; ?> "," <?php echo $option1; ?> ", " <?php echo $option2; ?> "," <?php echo $option3; ?> ", " <?php echo $option4; ?> ", " <?php echo $answer; ?> ","0" ]);

<?php getquestion(); ?> 
questions.push([ " <?php echo $question; ?> "," <?php echo $option1; ?> ", " <?php echo $option2; ?> "," <?php echo $option3; ?> ", " <?php echo $option4; ?> ", " <?php echo $answer; ?> ","0" ]);

<?php getquestion(); ?> 
questions.push([ " <?php echo $question; ?> "," <?php echo $option1; ?> ", " <?php echo $option2; ?> "," <?php echo $option3; ?> ", " <?php echo $option4; ?> ", " <?php echo $answer; ?> ","0"]);

<?php getquestion(); ?> 
questions.push([ " <?php echo $question; ?> "," <?php echo $option1; ?> ", " <?php echo $option2; ?> "," <?php echo $option3; ?> ", " <?php echo $option4; ?> ", " <?php echo $answer; ?> ","0" ]);




function startagain(){
	end.innerHTML = "<br><br><?php newtest(); ?>";		//doesnt work for now....this creates different test

for(pos=0;pos<questions.length;pos++)
{
	questions[pos][6] == "0";		
	
	}

	pos=0;
	renderQuestion();
	
}

function newtest(){
	location.reload()
}




function checktest(){

correct=0;
for(pos=0;pos<questions.length;pos++)
{

	if(questions[pos][6] == "1"){
		correct++;
	}
	}


}


function _(x){
	return document.getElementById(x);
}
function renderQuestion(){
	test = _("test");
	end = _("end");


	if(pos >= questions.length){

				

checktest();

		test.innerHTML = "<br><h2>You got "+correct+" of "+questions.length+" questions correct</h2><br>";
		test.innerHTML += questions;
		
		
		_("test_status").innerHTML = "<br>Test Completed<br><br><br>";
		
		

		end.innerHTML = "<br><br><center><button onclick='startagain()'>Start Again</button><button onclick='newtest()'>Give Another Test</button><a href='login.html' >LogOut</a></center>";

		return false;
	}


	_("test_status").innerHTML = "<br>Question "+(pos+1)+" of "+questions.length+"<br><br>";
	question = questions[pos][0];
	chA = questions[pos][1];
	chB = questions[pos][2];
	chC = questions[pos][3];
	chD = questions[pos][4];
	test.innerHTML = "<h3>"+question+questionmark+"</h3><br><br><br>";
	test.innerHTML += "<input type='radio' name='choices' value='"+chA+"'> "+chA+"<br><br>";
	test.innerHTML += "<input type='radio' name='choices' value='"+chB+"'> "+chB+"<br><br>";
	test.innerHTML += "<input type='radio' name='choices' value='"+chC+"'> "+chC+"<br><br>";
	test.innerHTML += "<input type='radio' name='choices' value='"+chD+"'> "+chD+"<br><br><br>";
	test.innerHTML += "<center><button onclick='previous()'>Previous</button><button onclick='checkAnswer()'>Next</button></center>";
	
}
function checkAnswer(){
	choices = document.getElementsByName("choices");
	for(var i=0; i<choices.length; i++){
		if(choices[i].checked){
			choice = choices[i].value;
		}
	}
	if(choice == questions[pos][5]){
		questions[pos][6]="1";
	}
	else
	{
		questions[pos][6]="0";
	}
	pos++;
	renderQuestion();
}


function previous(){
	
	if(pos!=0){
		pos--;
	renderQuestion();
	}
}






window.addEventListener("load", renderQuestion ,true);
</script>

</body>
</html>