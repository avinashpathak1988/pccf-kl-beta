<?php 
class MoneyHelper extends AppHelper{
	public function india($amount, $suffix = 1){
        setlocale(LC_MONETARY, 'en_IN');
        if (ctype_digit($amount) ) {
             // is whole number
             // if not required any numbers after decimal use this format
             $amount = money_format('%!.0n', $amount);
        }else {
             // is not whole number
             $amount = money_format('%!i', $amount);
        }
        if(!$suffix){
            return $amount;
        }else{
            return $amount;
        }
    }
	/////////////////////////////////////////////////////////////
	public function speak($number) {
        /*****
         * A recursive function to turn digits into words
         * Numbers must be integers from -999,999,999,999 to 999,999,999,999 inclussive.    
         *
         *  (C) 2010 Peter Ajtai
         *    This program is free software: you can redistribute it and/or modify
         *    it under the terms of the GNU General Public License as published by
         *    the Free Software Foundation, either version 3 of the License, or
         *    (at your option) any later version.
         *
         *    This program is distributed in the hope that it will be useful,
         *    but WITHOUT ANY WARRANTY; without even the implied warranty of
         *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
         *    GNU General Public License for more details.
         *
         *    See the GNU General Public License: <http://www.gnu.org/licenses/>.
         *
         */
        // zero is a special case, it cause problems even with typecasting if we don't deal with it here
        $max_size = pow(10,18);
        if (!$number) return "zero";
        if (is_int($number) && $number < abs($max_size)) {            
            switch ($number) {
                // set up some rules for converting digits to words
                case $number < 0:
                    $prefix = "negative";
                    $suffix = translateToWords(-1*$number);
                    $string = $prefix . " " . $suffix;
                    break;
                case 1:
                    $string = "one";
                    break;
                case 2:
                    $string = "two";
                    break;
                case 3:
                    $string = "three";
                    break;
                case 4: 
                    $string = "four";
                    break;
                case 5:
                    $string = "five";
                    break;
                case 6:
                    $string = "six";
                    break;
                case 7:
                    $string = "seven";
                    break;
                case 8:
                    $string = "eight";
                    break;
                case 9:
                    $string = "nine";
                    break;                
                case 10:
                    $string = "ten";
                    break;            
                case 11:
                    $string = "eleven";
                    break;            
                case 12:
                    $string = "twelve";
                    break;            
                case 13:
                    $string = "thirteen";
                    break;            
                // fourteen handled later
                case 15:
                    $string = "fifteen";
                    break;            
                case $number < 20:
                    $string = translateToWords($number%10);
                    // eighteen only has one "t"
                    if ($number == 18){
                        $suffix = "een";
                    } else {
                        $suffix = "teen";
                    }
                    $string .= $suffix;
                    break;            
                case 20:
                    $string = "twenty";
                    break;            
                case 30:
                    $string = "thirty";
                    break;            
                case 40:
                    $string = "forty";
                    break;            
                case 50:
                    $string = "fifty";
                    break;            
                case 60:
                    $string = "sixty";
                    break;            
                case 70:
                    $string = "seventy";
                    break;            
                case 80:
                    $string = "eighty";
                    break;            
                case 90:
                    $string = "ninety";
                    break;                
                case $number < 100:
                    $prefix = $this->speak($number-$number%10);
                    $suffix = $this->speak($number%10);
                    $string = $prefix . "-" . $suffix;
                    break;
                // handles all number 100 to 999
                case $number < pow(10,3):                    
                    // floor return a float not an integer
                    $prefix = $this->speak(intval(floor($number/pow(10,2)))) . " hundred";
                    if ($number%pow(10,2)) $suffix = " and " . $this->speak($number%pow(10,2));
                    $string = $prefix . $suffix;
                    break;
                case $number < pow(10,6):
                    // floor return a float not an integer
                    $prefix = $this->speak(intval(floor($number/pow(10,3)))) . " thousand";
                    if ($number%pow(10,3)) $suffix = $this->speak($number%pow(10,3));
                    $string = $prefix . " " . $suffix;
                    break;
                case $number < pow(10,9):
                    // floor return a float not an integer
                    $prefix = $this->speak(intval(floor($number/pow(10,6)))) . " million";
                    if ($number%pow(10,6)) $suffix = $this->speak($number%pow(10,6));
                    $string = $prefix . " " . $suffix;
                    break;                    
                case $number < pow(10,12):
                    // floor return a float not an integer
                    $prefix = $this->speak(intval(floor($number/pow(10,9)))) . " billion";
                    if ($number%pow(10,9)) $suffix = $this->speak($number%pow(10,9));
                    $string = $prefix . " " . $suffix;    
                    break;
                case $number < pow(10,15):
                    // floor return a float not an integer
                    $prefix = $this->speak(intval(floor($number/pow(10,12)))) . " trillion";
                    if ($number%pow(10,12)) $suffix = $this->speak($number%pow(10,12));
                    $string = $prefix . " " . $suffix;    
                    break;        
                // Be careful not to pass default formatted numbers in the quadrillions+ into this function
                // Default formatting is float and causes errors
                case $number < pow(10,18):
                    // floor return a float not an integer
                    $prefix = $this->speak(intval(floor($number/pow(10,15)))) . " quadrillion";
                    if ($number%pow(10,15)) $suffix = $this->speak($number%pow(10,15));
                    $string = $prefix . " " . $suffix;    
                    break;                    
            }
        } else{
            echo "ERROR with - $number<br/> Number must be an integer between -" . number_format($max_size, 0, ".", ",") . " and " . number_format($max_size, 0, ".", ",") . " exclussive.";
        }
        return $string;    
    }
    function convert_number_to_words($number){
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            100000              => 'lakhs',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (@str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        return $string;
    }
}
 ?>