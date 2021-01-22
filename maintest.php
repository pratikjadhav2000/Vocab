<?php

if(isset($_GET['username']) && isset($_GET['userid']) && isset($_GET['testname']) ){ 
 	$username=$_GET['username']; 
 	 $userid=$_GET['userid']; 
 	 $testname=$_GET['testname'];
}
else{
	header("Location: loginmain.php?error=unknownacess");
exit();
	
}

include "connect.php";

$tablename=mysqli_real_escape_string($conn_test,$userid."_".$testname);

//fetch the questions from tablename

$query="select * from `slueatrx_vocab`.`$tablename` order by question_id";

			if (!($stmt = $conn_test->prepare($query))) {
				 echo("Error description: stmtprepare" . $conn_test -> error);
			//header("Location: signupmain.php?error=sqlerrorusernamequery");
			exit();

			}
			else{
				
				//$stmt->bind_param("s",$tablename);
				
				if(!$stmt->execute()){
						echo("Error description: stmtexecute " . $conn_test -> error);
						exit();
				}
						//store the result variable here
				$result = $stmt->get_result();

	//header("Location: maintest.php?testname=".$testname."&userid=".$userid);
				
			}

?>

<!DOCTYPE html>
<html>
<head>
	
<style>

div#test{ border:#000 1px solid; padding:40px 40px 40px 40px;
font-size: 25px;
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
    width: 1.8em;
    height: 1.8em;

}




.tp{
	
		text-decoration: none;
	width: 30%;
	padding: 15px 25px 15px 25px;
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
  top: 65px;
		font-size: 50px;
		float: right;
	list-style-type: none;
	margin-top: 10px;
	margin-right: 7px;
	background-color: #FFF;
}

#timer:hover{
	
	transform: scale(1.5);
}

.logoutbutton{
	
	width: 10%;
	padding: 10px 10px;
	border-radius: 20px;
	font-size: 15px;
	margin: 10px 0;
	border: none;
	outline: none;
	cursor: pointer;
	transition: 0.6s ease;
	background: lightgray;
	float: right;
	top: 0;
	text-align: center;

}

.logoutbutton:hover{
	background-color: green;
	color: #fff;
}

</style>

<script src="timer.js" ></script>

</head>

<body>
	<header id="header" class="">

				<form action="loginmain.php" method="post">
					<input type="submit" class="logoutbutton" name="logout" value="LogOut">
				</form>
				<p class="logoutbutton"><?php echo $username ?></p><br><br>

	</header><!-- /header -->


</body>		

<footer>

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
 <?php
 while( $row = $result->fetch_assoc() ){
 	?>

questions.push([ " <?php echo $row["question"]; ?> "," <?php echo $row["option1"]; ?> ", " <?php echo $row["option2"]; ?> "," <?php echo $row["option3"]; ?> ", " <?php echo $row["option4"]; ?> ", " <?php echo $row["answer"]; ?> " ,"0"]);
<?php
}
?>


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

		end.innerHTML = "<br><br><center><button onclick='startagain()'>Start Again</button><a href='mytests.php?<?php echo "username=".$username."&userid=".$userid; ?>'>Give Another Test</a><button onclick='reviewtest()'>Review test</button></center>";


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


	_("test_status").innerHTML = "<br>"+" Question "+(pos+1)+" of "+questions.length+"<br>";
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

</footer>


</html>