<?php
//Here's a little helper class to help you evaluate a math expression, e.g. 2+5*3.
//https://stackoverflow.com/questions/18880772/calculate-math-expression-from-a-string-using-eval
class Field_calculate {
    const PATTERN = '/(?:\-?\d+(?:\.?\d+)?[\+\-\*\/])+\-?\d+(?:\.?\d+)?/';

    const PARENTHESIS_DEPTH = 10;

    public function calculate($input){
        if(strpos($input, '+') != null || strpos($input, '-') != null || strpos($input, '/') != null || strpos($input, '*') != null){
            //  Remove white spaces and invalid math chars
            $input = str_replace(',', '.', $input);
            $input = preg_replace('[^0-9\.\+\-\*\/\(\)]', '', $input);

            //  Calculate each of the parenthesis from the top
            $i = 0;
            while(strpos($input, '(') || strpos($input, ')')){
                $input = preg_replace_callback('/\(([^\(\)]+)\)/', 'self::callback', $input);

                $i++;
                if($i > self::PARENTHESIS_DEPTH){
                    break;
                }
            }

            //  Calculate the result
            if(preg_match(self::PATTERN, $input, $match)){
                return $this->compute($match[0]);
            }
            // To handle the special case of expressions surrounded by global parenthesis like "(1+1)"
            if(is_numeric($input)){
                return $input;
            }

            return 0;
        }

        return $input;
    }

    private function compute($input){
        $compute = create_function('', 'return '.$input.';');

        return 0 + $compute();
    }

    private function callback($input){
        if(is_numeric($input[1])){
            return $input[1];
        }
        elseif(preg_match(self::PATTERN, $input[1], $match)){
            return $this->compute($match[0]);
        }

        return 0;
    }
}

//This is an example of object-oriented programming. I anticipate you'll take a couple of classes about it if you go into CS/CE, but here's the usage:

$Calculator = new Field_calculate();
//sanitize your input - ask me about this as well. It can be a security risk to just use raw data from the client
$expression = htmlentities($_POST['result']);
$result = $Calculator->calculate($expression);
//Now figure out what to do with the result.

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Calculator</title>

		<!-- You need this tag for the webpage to be responsive (mobile-friendly) -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		
		<!-------------------- LINKS -------------------->
		<!-- Bootstrap framework CDN -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" 
			    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" 
				integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

		<!-- jQuery CDN -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<!-- Custom CSS and JavaScript files -->
		<link rel="stylesheet" href="app.css">
		<script src="app.js"></script>

	</head>
	<body>
		<!-- This is a Bootstrap class to keep things tidy and centered -->
		<div class="container">
			<!-- This is up to you to style, in app.css. I'd probably suggest getting some practice with Grid. -->
			<form method="POST" action="index.php" id="calculator">
				<input name="result" id="result" value="0">
				<div class="calculator-row">
					<!-- .btn and .btn-secondary are Bootstrap classes to make these look like grey buttons. -->
					<!-- Inspect element and go into the Style tab to see what it does under the hood. -->
					<div class="btn btn-secondary calculator-button">7</div>
					<div class="btn btn-secondary calculator-button">8</div>
					<div class="btn btn-secondary calculator-button">9</div>
				</div>
				<!-- etc -->
			</div>
		</div>
	</body>
</html>
