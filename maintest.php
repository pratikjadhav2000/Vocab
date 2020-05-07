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
font-size: 33px;
margin-left: 5px;
margin-right: 5px;
margin-bottom: 10px; }

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




.tp{
	
		text-decoration: none;
	width: 75%;
	padding: 40px 50px 40px 50px;
	border-radius: 40px;

	
	margin: 10px 0;
	border: none;
	outline: none;
	cursor: pointer;
	transition: 0.6s ease;
	

}

.tp:hover{
	background-color: lightskyblue;
	color: #fff;
	transform: scale(1.045);
	


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

#timer{

  position: sticky;
  top: 0;
		font-size: 50px;
		float: right;
	list-style-type: none;
	margin-top: 10px;
	margin-right: 70px;
	background-color: #FFF;
}

#timer:hover{
	
	transform: scale(1.5);
}



</style>

</head>

<body>

<script src="timer.js" ></script>
		

<h2 id="timer"></h2>
<h2 id="result"></h2>
<h2 id="test_status"></h2>
<div id="test"></div>
<div id="end"></div>

<script type="text/javascript" async defer>


timertime=60;
timer("timer",timertime);

var questionmark = " ? ";

var pos = 0, test, test_status, question, choice, choices, chA, chB, chC,chD, correct = 0;

var questions = [];
var radio = [];
var marked;
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

for(var i=0;i<questions.length;i++){
	radio.push("");
}


function startagain(){
_("result").innerHTML = "";	
status=1;
choice="";
timer("timer",timertime);
end.innerHTML ="";

for(pos=0;pos<questions.length;pos++){
	
	questions[pos][6] = "0";
	radio[pos]="";		
	
	}

	pos=0;
	renderQuestion();
	
}

function newtest(){
	location.reload()
}




function checktest(){

checkAnswer();
correct=0;
for(pos=0;pos<questions.length;pos++)
{

	if(questions[pos][6] == "1"){
		correct++;
	}
	}


}

function submit(){

status=0;
				
			checktest();	
		result();


}


function result(){

	
	_("result").innerHTML = "<center><h1>Result</h1></center>"

		test.innerHTML = "<br><h2>You got "+correct+" of "+questions.length+" questions correct</h2><br>";
		
		
		
		_("test_status").innerHTML = "<br>Test Completed<br><br><br>";
		
		pos=0;

		end.innerHTML = "<br><br><center><button onclick='startagain()'>Start Again</button><button onclick='newtest()'>Give Another Test</button><a href='login.html' >LogOut</a><br><button onclick='reviewtest()'>Review test</button></center>";


		return false;


}


function reviewtest(){

	
	_("result").innerHTML = "<center><h1>Review Test</h1></center>"
end.innerHTML ="";

test = _("test");
	end = _("end");


	if(pos >= questions.length){

			result();

		return false;
	}


	_("test_status").innerHTML = "<br>Question "+(pos+1)+" of "+questions.length+"<br><br>";
	question = questions[pos][0];
	chA = questions[pos][1];
	chB = questions[pos][2];
	chC = questions[pos][3];
	chD = questions[pos][4];
	test.innerHTML = "<h3>"+question+questionmark+"</h3><br>";
	test.innerHTML += "<label><div class='tp'><input type='radio' name='reviewchoice' id='1' value='"+chA+"'> "+chA+"</div></label>";
	test.innerHTML += "<label><div class='tp'><input type='radio' name='reviewchoice' id='2' value='"+chB+"'> "+chB+"</div></label>";
	test.innerHTML += "<label><div class='tp'><input type='radio' name='reviewchoice' id='3' value='"+chC+"'> "+chC+"</div></label>";
	test.innerHTML += "<label><div class='tp'><input type='radio' name='reviewchoice' id='4' value='"+chD+"'> "+chD+"</div></label><br>";
	test.innerHTML += " Answer : "+questions[pos][5]+" <br>"
	test.innerHTML += "<center><button onclick='previousreview()' id='previous'>Previous</button><button onclick='nextreview()' id='next'>Next</button></center>";
	test.innerHTML += "<center><button onclick='result()' id='submit'>Done</button></center>";

			if(pos==0){hide("previous");}
			if(pos== questions.length-1){hide("next"); unhide("submit");}else{hide("submit");}


	
	 if(radio[pos]!=""){
	 	marked=radio[pos];
	check(marked);
		 }

		 disabled("reviewchoice");

}

function disabled(name){


	choices = document.getElementsByName(name);
	for(var i=0; i<choices.length; i++){
	
		choices[i].disabled=true;

	}

}

function _(x){
	return document.getElementById(x);
}
function renderQuestion(){
	test = _("test");
	end = _("end");


	if(pos >= questions.length){

			submit();

		
	}


	_("test_status").innerHTML = "<br>Question "+(pos+1)+" of "+questions.length+"<br><br>";
	question = questions[pos][0];
	chA = questions[pos][1];
	chB = questions[pos][2];
	chC = questions[pos][3];
	chD = questions[pos][4];
	test.innerHTML = "<h3>"+question+questionmark+"</h3><br>";
	test.innerHTML += "<label><div class='tp'><input type='radio' name='choices' id='1' value='"+chA+"'> "+chA+"</div></label>";
	test.innerHTML += "<label><div class='tp'><input type='radio' name='choices' id='2' value='"+chB+"'> "+chB+"</div></label>";
	test.innerHTML += "<label><div class='tp'><input type='radio' name='choices' id='3' value='"+chC+"'> "+chC+"</div></label>";
	test.innerHTML += "<label><div class='tp'><input type='radio' name='choices' id='4' value='"+chD+"'> "+chD+"</div></label><br>";
	test.innerHTML += "<center><button onclick='previous()' id='previous'>Previous</button><button onclick='next()' id='next'>Next</button></center>";
	test.innerHTML += "<center><button onclick='submit()' id='submit'>Submit</button></center>";

			if(pos==0){hide("previous");}
			if(pos== questions.length-1){hide("next"); unhide("submit");}else{hide("submit");}


	
	 if(radio[pos]!=""){
	 	marked=radio[pos];
	check(marked);
	 }
}
function checkAnswer(){
	choices = document.getElementsByName("choices");
	for(var i=0; i<choices.length; i++){
		if(choices[i].checked){
			choice = choices[i].value;
			radio[pos]=choices[i].id;
		}

	}
	if(choice == questions[pos][5]){
		questions[pos][6]="1";
	}
	else
	{
		questions[pos][6]="0";
	}

}

function next(){
		checkAnswer();
		pos++;
	renderQuestion();
}


function previous(){

		checkAnswer();

	if(pos!=0){
		pos--;
	renderQuestion();
	}

}

function nextreview(){
		
		pos++;
	reviewtest();
}


function previousreview(){

		

	if(pos!=0){
		pos--;
	reviewtest();
	}

}


function check(id) {

var element = document.getElementById(id);

  element.checked = true;
  

}

function uncheck(id) {
  document.getElementById(id).checked = false;
}

function hide(id){
	 var hide = document.getElementById(id);
      hide.style.display = "none";
}

function unhide(id){
	 var unhide = document.getElementById(id);
      unhide.style.display = "block";
}



window.addEventListener("load", renderQuestion ,true);
</script>

</body>
</html>
