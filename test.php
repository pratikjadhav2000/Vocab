<?php 

include "connect.php";

//create the questions



$questionlist = "select * from test order by rand() limit 5 " ;
$resultquestions = mysqli_query($conn,$questionlist);

$question="what is apple?";
$answer="fruit";
$option1="planet";
$option2="hardware";
$option3="fruit";
$option4="car";

					function newtest(){
						global $conn;
						global $questionlist;
						global $resultquestions;
						$resultquestions = mysqli_query($conn,$questionlist);

					}

					function getquestion(){
						
						global $resultquestions;
						global $conn;
						global $question;
						global $answer;
						global $option1;
						global $option2;
						global $option3;
						global $option4;

						

						 $rowquestion = $resultquestions->fetch_assoc() ;

	
	
	 $question=$rowquestion["question"];
	$answer=$rowquestion["answer"];	

				//    AFTER DISPLAYING THE QUESTION CREATE VIEW OF WRONG ANSWERS		///////////////////

	$query = "create view wronganswers as select answer from test where answer!='$answer' order by rand() limit 3" ;
	 mysqli_query($conn,$query);

	 		//   then merge with answer and jumble it.

	 $query = "select answer from test where answer='$answer' union select answer from wronganswers order by rand()" ;
	 $options=mysqli_query($conn,$query);


	 	//these are the options
	 if ($options->num_rows > 0) {
    // output data of each row ie. option list table 

        $row = $options->fetch_assoc();
        $option1=$row["answer"];


        $row = $options->fetch_assoc();
        $option2=$row["answer"];


        $row = $options->fetch_assoc();
        $option3=$row["answer"];


        $row = $options->fetch_assoc();
        $option4=$row["answer"];
        

    
		} else {
    echo "0 results";
			}

		
				//				DELETE THE VIEW OF WRONGS ANSWERS			//

				$query = "drop view wronganswers" ;
	 mysqli_query($conn,$query);


	

			
			
			}	//function ends here

/*
getquestion();
echo $question,"<br>";

getquestion();
echo $question,"<br>";

getquestion();
echo $question,"<br>";

getquestion();
echo $question,"<br>";

*/



  ?>



