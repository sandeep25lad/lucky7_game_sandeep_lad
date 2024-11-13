<?php 
    SESSION_START();

    if(isset($_POST['play'])){
        $type = $_POST['type'];

        $dice1 = rand(1, 6);
        $dice2 = rand(1, 6);

        $diceSum = $dice1 + $dice2;
        $message = "Sorry!! You loose the game!!";

        $_SESSION['current_balance'] = $_SESSION['current_balance'] - 10 ;

        if($type==1){
            if($diceSum < 7){
                $_SESSION['msg'] = "Congratulation!! You won the game!!";
                $_SESSION['current_balance'] = $_SESSION['current_balance'] + 20;
                $_SESSION['selectedOption'] = 'Below 7';
            } else{
                $_SESSION['selectedOption'] = 'Below 7';
                $_SESSION['msg'] = "Sorry!! You loose the game!!";
                // $_SESSION['current_balance'] = $_SESSION['current_balance'] - 10 ;
            }
        }

        if($type==2){
            if($diceSum == 7){
                $_SESSION['msg'] = "Congratulation!! You won the game!!";
                $_SESSION['current_balance'] = $_SESSION['current_balance'] + 30;
                $_SESSION['selectedOption'] = 'Lucky 7';
            } else{
                $_SESSION['selectedOption'] = 'Lucky 7';
                $_SESSION['msg'] = "Sorry!! You loose the game!!";
                // $_SESSION['current_balance'] = $_SESSION['current_balance'] - 10 ;
            }
        }

        if($type==3){
            if($diceSum > 7){
                $_SESSION['msg'] = "Congratulation!! You won the game!!";
                $_SESSION['current_balance'] = $_SESSION['current_balance'] + 20;
                $_SESSION['selectedOption'] = 'Above 7';
            } else{
                $_SESSION['selectedOption'] = 'Above 7';
                $_SESSION['msg'] = "Sorry!! You loose the game!!";
                // $_SESSION['current_balance'] = $_SESSION['current_balance'] - 10 ;
            }
        }
    }

    if(isset($_POST['reset'])){
        $_SESSION['selectedOption'] = '';
        $_SESSION['current_balance'] = 100;
    }
    
?>

<html>
    <title>Lucky 7 game</title>
    <body>
        <h3>Welcome to the Lucky 7 Game</h3>
        <h3>Curerent Balance : <?php echo $_SESSION['current_balance']; ?></h3>
        <form method="post" name="type">
            <select name="type">
                <option value="1">Below 7</option>
                <option value="2">Lucky 7</option>
                <option value="3">Above 7</option>
            </select>
            <br><br>
            <input type="submit" name="play" value="Play">
            <br><br>
            <h4>Selected Option: <?php if(isset($_SESSION['selectedOption'])) { echo $_SESSION['selectedOption']; } ?></h4>
            <h4>Dice 1 Value: <?php if(isset($dice1)) { echo $dice1; } ?></h4>
            <h4>Dice 2 Value: <?php if(isset($dice1)) { echo $dice2; } ?></h4>

            <br>

            <?php if(isset($_SESSION['msg'])) { echo $_SESSION['msg']; }  ?>

            <br>
            <input type="submit" name="reset" value="Reset">
            <input type="button" name="continue_playing" value="Continue Playing">
        </form>

        
    </body>
</html>
