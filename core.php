<?php
require "settings.php";
session_start();

if($_POST)
{

	$ajax = $_POST["query"];    

    $key = security($ajax["keycode"]);

    if($key == "get_guide")
    {

    	if(isset($_SESSION["XCAPTCHA_GUIDE"]))
    		echo $_SESSION["XCAPTCHA_GUIDE"];
    	
    }
    else if ($key == "verification")
    {
    	$data = security($ajax["captchatext"]);
    	

    	if(isset($_SESSION["XCAPTCHA_QUESTION"]))
    	{
    		if($_SESSION["XCAPTCHA_ANSWER"] == $data)
    		{
    			$_SESSION["XCAPTCHA_QUESTION"] = TRUE;
    			echo "ok";

    		}
    		else
    		{
    			echo "error";
    		}
    	}
    	else
    	{
    		echo "<script> refresh_image(); </script>";
    	}

    }

	exit();
}

$probs = array();
$prob_result;


$c = sizeof($FONTS);


$_QUESTION;
$_ANSWER;
$_GUIDE;
$_FONT = $FONTS[rand(0, ($c - 1))];
$_FONTSIZE = 15;
$_TEXTSTART = 20;
$_ANGLE = rand(-15,15);

if($IS_MATH_QUESTIONS_ENABLED)
$probs[] = 1;

if($IS_TURING_QUESTIONS_ENABLED)
$probs[] = 2;

if($IS_CAPTCHA_QUESTIONS_ENABLED)
$probs[] = 3;


$c = sizeof($probs);

if($c == 0)
	$prob_result = 3;
else
{
	$prob_result = $probs[rand(0,($c - 1))];
}


switch ($prob_result) {
	case 1:
		$_GUIDE = "Please calculate the math question.";
		switch ($MATH_QUESTIONS_DIFFICULTY) {
			case 1:
				// X . Y
				$val1 = rand(0,9);
				$val2 = rand(0,9);

				$op = rand(0,1);		//	0: addition 		1: multiplication
				if($op == 0)
				{
					$_QUESTION = $val1." + ".$val2;
					$_ANSWER = $val1 + $val2;
				}
				else if ($op ==1)
				{
					$_QUESTION = $val1." X ".$val2;
					$_ANSWER = $val1 * $val2;
				}


			break;

			case 2:
				// X . (Y . Z)

				$val1 = rand(0,9);
				$val2 = rand(0,9);
				$val3 = rand(0,9);
				$op1  = rand(0,1);
				$op2  = rand(0,1);


				if($op2 == 0)
				{
					$problem_ = $val2." + ".$val3;
					$answer_  = $val2 + $val3;
				}
				else if ($op2 == 1)
				{
					$problem_ = $val2." * ".$val3;
					$answer_  = $val2 * $val3;
				}

				if($op1 == 0)
				{
					$_QUESTION = $val1." + (".$problem_.")";
					$_ANSWER = $val1 + $answer_;
				}
				else if ($op1 == 1)
				{
					$_QUESTION = $val1." * (".$problem_.")";
					$_ANSWER = $val1 * $answer_;
				}


			break;

			case 3:
				//	 prob1        prob2
				// (X ., T) .. ( Y .. Z)
				//    op1    op2     op3

				$val1 = rand(0,9);
				$val2 = rand(0,9);
				$val3 = rand(0,9);
				$val4 = rand(0,9);
				$op1  = rand(0,1);
				$op2  = rand(0,1);
				$op3  = rand(0,1); 


				if($op3 == 0)
				{
					$problem2 = $val3." + ".$val4;
					$answer2  = $val3 + $val4;
				}
				else if ($op3 == 1)
				{
					$problem2 = $val3." * ".$val4;
					$answer2  = $val3 * $val4;
				}


				if($op1 == 0)
				{
					$problem1 = $val1." + ".$val2;
					$answer1  = $val1 + $val2;
				}
				else if ($op1 == 1)
				{
					$problem1 = $val1." * ".$val2;
					$answer1  = $val1 * $val2;
				}


				if($op2 == 0)
				{
					$_QUESTION = "(".$problem1.")"." + "."(".$problem2.")";
					$_ANSWER = $answer1 + $answer2;
				}
				else if ($op2 == 1)
				{
					$_QUESTION = "(".$problem1.")"." * "."(".$problem2.")";
					$_ANSWER = $answer1 * $answer2;
				}

				$_FONTSIZE = 12;	
				$_TEXTSTART = 3;
			break;
		}
		break;
	
	case 2:

		$_GUIDE = "Please answer the question.";
		$i = 0;
		$u = rand(0,(sizeof($TURING_QUESTIONS) - 1));


		foreach($TURING_QUESTIONS AS $ANSWER)
		{
			if($i == $u)
			{
				$_ANSWER= $ANSWER;
				break;
			}
			$i++;
		}

		$_QUESTION = array_search($_ANSWER,$TURING_QUESTIONS);
		
		$sq = strlen($_QUESTION);
		
		if($sq <= 40)
		{
			
			if($sq >= 20)
			{
				$splitted = str_split($_QUESTION, 20);
				$_QUESTION = implode("\n", $splitted);
				
			}
			
			$_FONTSIZE = 10;	
			$_TEXTSTART = 3;
			$_ANGLE = rand(-5,15);
		}
		else
		{
			$splitted = str_split($_QUESTION, 20);
			$_QUESTION = implode("\n", $splitted);
			$_FONTSIZE = 8;	
			$_TEXTSTART = 2;
			$_ANGLE = rand(5,15);

		}

	break;

	case 3:

		$_GUIDE = "Please type this chars.";
		$_ANSWER = substr(md5(rand(0,999999)),0,6);
		$_QUESTION = $_ANSWER;

	break;

}



function security($data)
{

	$data = mysql_real_escape_string(htmlspecialchars(strip_tags(trim(addslashes($data)))));
	
	return $data;
	
}

?>