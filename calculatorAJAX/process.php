<?php
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
        //$compute = create_function('', 'return '.$input.';');

        return 0 + eval("return $input;");
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

$Calculator = new Field_calculate();
//sanitize your input - ask me about this as well. It can be a security risk to just use raw data from the client
$expression = htmlentities($_POST['result']);
$result = $Calculator->calculate($expression);

//Instead of displaying this in HTML, you'll want to use either plaintext or JSON.
//You can ask me about JSON or read up on it, but it's a way to represent objects as plain text.
//So once your JS gets it again, it can de-JSON-ize the text and get the object again, even though it was originally in PHP.
//Pretty cool, huh? But we're going to just echo it out because we only have one thing to return, rather than
//  something like an array.
echo $result;
?>
