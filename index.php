<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Scheduled messaging system</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <div class="jumbotron">
  <?php
$date = $_GET['date'];
// in case SMS confirmation were added
// number input field:
// <label>Your phone number: </label><input type="text" name="phone" id="phone"  onkeyup="this.value=this.value.replace(/[^\d]+/,'')" maxlength="9" class="form-control"/> 
// php part:
//if($date=='fail'){
//	echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Fail!</strong> Check if the number was entered correctly.</div>";
//}
if($date!=0){
echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> Your mail will be sent at " . date('l jS \of F Y h:i:s A', $date) . "</div>";
}



?>
  <div class="container"><div class="col-md-2"><img src="background.ico" height="100%" width="100%"></img></div><div class="col-md-6"><div class="container"><br><h1>Mail Scheduler</h1></div></div></div></div>

	<div class="container">
	
<form class="form-signin" name="mail_form" id="mail_form" method="post" action="process_mail.php" >
<h2 class="form-signin-heading">Schedule your message!</h2>
<div class="label label-warning" height="10" width="30">
  Mail details</div><br>
        <label>Recipient mail: </label><input type="email" name="name" id="name" required='true' class="form-control"/>
        <label>Mail Title: </label><input type="text" name="title" id="title" required='true' class="form-control"/>       
		<label for ="email">Enter email: </label><textarea rows="10" cols = "70" name="email" id="email" required='true' wrap = "hard" style="resize:none" class="form-control"/></textarea>
		<br><div class="label label-info">
  Time and date</div><br><br>
        <div class="container"><select id="hour" name ="hour"></select><select id = "minute" name="minute"></select><select id = "year" name="year" onChange="setDays()"></select><select id = "month" name="month" onChange="setDays()"></select><select id = "day" name="day"></select></div>
		<br><input type="submit" name="s1" id="s1" value="Submit!" class="btn btn-lg btn-success" style="float:right"/>
</form></div>
<div class="container">


</div>
 <script>

            function fill(target, firstval, lastval) {
                select = document.getElementById(target);

                for (var x = firstval; x <= lastval; x++) {
                    var option = document.createElement('option');
                    option.value = x;
                    option.innerHTML = x;
                    select.appendChild(option);
                }
            }

            function checkDaysInMonth() {

                if (document.getElementById('month').selectedIndex === 1) {
                    options = document.getElementById('year').options;
                    selectedVal = options[document.getElementById('year').selectedIndex].value;

                    if (selectedVal % 1000 === 0 || (selectedVal % 4 === 0 && selectedVal % 100 !== 0)) {
                        return 29;
                    } else {
                        return 28;
                    }
                } else {
                    switch (document.getElementById('month').selectedIndex) {
                        case 0:
                            return 31;
                            break;
                        case 2:
                            return 31;
                            break;
                        case 3:
                            return 30;
                            break;
                        case 4:
                            return 31;
                            break;
                        case 5:
                            return 30;
                            break;
                        case 6:
                            return 31;
                            break;
                        case 7:
                            return 31;
                            break;
                        case 8:
                            return 30;
                            break;
                        case 9:
                            return 31;
                            break;
                        case 10:
                            return 30;
                            break;
                        case 11:
                            return 31;
                    }
                }
            }

            function setDays() {
                var days = checkDaysInMonth();
                var size = document.getElementById('day').options.length;

                if (days > size) {
                    for (var x = size; x < days; x++) {
                        option = document.createElement('option');
                        option.value = x+1;
                        option.innerHTML = x+1;
                        document.getElementById('day').add(option, x);
                    }
                } else if (days < size) {
                    for (var x = days; x < size; x++) {
                        document.getElementById('day').remove(days);
                    }
                }
            }

            fill('hour', 0, 23);
            fill('minute', 0, 59);
            fill('year', new Date().getFullYear(), new Date().getFullYear() + 50);
            fill('month', 1, 12);
            fill('day', 1, 31);
			
var now = new Date();
document.getElementById('day').selectedIndex = now.getDate()-1;
document.getElementById('month').selectedIndex = now.getMonth();
document.getElementById('hour').selectedIndex = now.getHours();
document.getElementById('minute').selectedIndex = now.getMinutes();
setDays();
        </script>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>