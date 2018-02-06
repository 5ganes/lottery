// function getPrize(){
// 	var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             var prize = this.responseText;
//             return prize;
//             // console.log(prize);
//         }
//     };
//     xmlhttp.open("GET", "ajax/getprize.php", true);
//     xmlhttp.send();
// }

function checkEntry(){
	var random = Math.floor((Math.random() * 1000) + 1);
	// check for new entry
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var check = this.responseText;
            if(check == 'No') setTimeout(checkEntry, 1);
            document.getElementById('result').innerHTML = 'Congratulations !<br> Lottery Number : ' + random + check;
            return random;
        }
    };
    xmlhttp.open("GET", "ajax/check.php?ln="+random, true);
    xmlhttp.send();
}

function findNumber(){
	
	checkEntry();
	
	document.getElementById('load').style = 'display:none';
	// document.getElementById('result').innerHTML = 'Lottery Number : ' + random;
	document.getElementById('result').style = 'display:block';
	document.getElementById('start').innerHTML = '<img src="images/start.png">';
}
function startLottery(){
	document.getElementById('start').innerHTML = '<p style="padding:10% 2%;">Generating Lottery Result . . .</p>';
	document.getElementById('result').style = 'display:none';
	document.getElementById('load').style = 'display:block';
	setTimeout(findNumber, 30000);
}
function resetLotteryTable(){
	// reset lottery table
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('result').innerHTML = 'Lottery system has been reset successully';
            return random;
        }
    };
    xmlhttp.open("GET", "ajax/reset.php", true);
    xmlhttp.send();

	document.getElementById('load').style = 'display:none';
	document.getElementById('result').style = 'display:block';

}
function resetLottery(){
	document.getElementById('result').style = 'display:none';
	document.getElementById('load').style = 'display:block';
	setTimeout(resetLotteryTable, 10000);
}
function myLoad(){
	// alert('hello world');
	document.getElementById('load').style = 'display:none';
	document.getElementById('result').style = 'display:none';
	var start = document.getElementById('start');
	start.addEventListener('click', startLottery);

	var reset = document.getElementById('reset');
	reset.addEventListener('click', resetLottery);
}
document.addEventListener('DOMContentLoaded', myLoad);