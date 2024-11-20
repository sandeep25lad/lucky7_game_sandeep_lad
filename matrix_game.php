<?php
    session_start();
    $_SESSION['player_1']['dice_roll_history'];
    $_SESSION['player_2']['dice_roll_history'];
    $_SESSION['player_3']['dice_roll_history'];
    $_SESSION['player_1']['coordinate'];
    $_SESSION['player_2']['coordinate'];
    $_SESSION['player_3']['coordinate'];

    if(isset($_POST['play'])){
        $grid = $_POST['grid'];
        if($grid!="" && $grid!=null){
            $winnerPosition = $grid * $grid;
            $_SESSION['winnerPosition'] = $winnerPosition;

            for($i=1; $i<=3; $i++){
                $dice = rand(1, 6);
                array_push($_SESSION['player_'.$i]['dice_roll_history'], $dice);

                $sum = 0;
                for($j=1; $j<=count($_SESSION['player_'.$i]['dice_roll_history']); $j++){
                    $sum = $sum + $_SESSION['player_'.$i]['dice_roll_history'][$j-1];
                }

                $coordinates = [];
            for($k=0; $k<$grid; $k++){
                for($g=0; $g<$grid;$g++){
                    $newcoordinate = "($g, $k)";
                    array_push($coordinates, $newcoordinate);
                }
            }

            array_push($_SESSION['player_'.$i]['coordinate'], $coordinates[$dice-1]);

            }

            

        } else{
            echo "Something went wrong!!";
        }
        
    }

    if(isset($_POST['reset'])){
        $_SESSION['player_1']['dice_roll_history'] = [];
        $_SESSION['player_2']['dice_roll_history'] = [];
        $_SESSION['player_3']['dice_roll_history'] = [];

        $_SESSION['player_1']['winner'] = '';
        $_SESSION['player_2']['winner'] = '';
        $_SESSION['player_3']['winner'] = '';

        $_SESSION['player_1']['coordinate'] = [];
        $_SESSION['player_2']['coordinate'] = [];
        $_SESSION['player_3']['coordinate'] = [];
    }
    
?>

<html>
    <head></head>
    <title>Grid System</title>

    <body>
        <form method="post">
            <label>Grid:</label>
            <input type="text" name="grid">

            <label>Players:</label>
            <input type="number" value="3" disabled>

            <input type="submit" name="play" value="Play">
        </form>

        <table border="1">
            <tr>
                <td>Player No:</td>
                <td>Dice Roll history</td>
                <td>Position history</td>
                <td>Co-ordinate history</td>
                <td>Winner Status</td>
            </tr>

            <?php 
                for($i=1; $i<=3; $i++){
                $j=1;
                 ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <?php for($j=1; $j<=count($_SESSION['player_'.$i]['dice_roll_history']); $j++){
                                    echo $_SESSION['player_'.$i]['dice_roll_history'][$j-1].",";
                                } 
                            ?>
                        </td>
                        <td>
                            <?php 
                                $position = 0;
                                for($j=1; $j<=count($_SESSION['player_'.$i]['dice_roll_history']); $j++){
                                    $newposition = $position + $_SESSION['player_'.$i]['dice_roll_history'][$j-1];
                                    if($newposition <= $_SESSION['winnerPosition']){
                                        $position = $newposition;
                                    }
                                    echo $position.",";
                                } 
                            ?>
                        </td>
                        <td>
                            <?php for($s=0; $s<count($_SESSION['player_'.$i]['coordinate']); $s++)
                                    {
                                        echo $_SESSION['player_'.$i]['coordinate'][$s].",";
                                    }
                            ?>
                        </td>
                        <td>
                            <?php 
                                if( $position == $_SESSION['winnerPosition'] ){
                                     echo "Winner!!";
                                }
                            ?>
                        </td>
                    </tr>
                 <?php
                }
            ?>
            
        </table>

        <br>

        <form method="post">
            <input type="submit" name="reset" value="reset">
        </form>


    </body>
</html>