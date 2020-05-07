var status=1;

function timer(id,timeleft){



var x=document.getElementById(id);

function countdown(){
	x.innerHTML=convert(timeleft);
	timeleft--;
	if(timeleft<0){
		clearInterval(y);
		x.innerHTML="timeup";
		timeup();
	}
	if(status==0){
		clearInterval(y);
		
	}
}



function convert(x){

var min,sec;

min=Math.floor(x/60); ;
sec=x%60;

return min+":"+sec;

}

	var y=setInterval(countdown,1000);
	

function timeup(){
		
	checktest();
	result();
	
	
}

}