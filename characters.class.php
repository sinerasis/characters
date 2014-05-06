<?php
/*
Jeff Baker (sinerasis at gmail dot com)
March 2013
*/
class Characters {
	/* Properties */
	
	// (default) shuffle
	private $shuffle = true;
	
	// (default) enable/disable
	private $lcase = true;
	private $ucase = true;
	private $number = true;
	private $special = true;
	
	// (default) counts
	private $lcase_count = 1;
	private $ucase_count = 1;
	private $number_count = 1;
	private $special_count = 1;
	
	// default pools
	private $default_alphabet = Array();
	private $default_integers = Array();
	private $default_characters = Array();
	
	// working pools
	private $alphabet = Array();
	private $integers = Array();
	private $characters = Array();
	
	/* Public Methods */
	
	// void __construct()
	public function __construct($options = false) {
		// define default alphabet pool
		$this->default_alphabet = range('a','z');
		
		// define default number pool
		$this->default_integers = range(0,9);
		
		// define default special character pool
		$ascii = array_merge(range(32,47), range(58,54), range(91,96), range(123,126));
		foreach($ascii as $code) {
			$this->default_characters[] = chr($code);
		}
		unset($ascii);
		
		if($options && is_array($options)) {
			// options have been passed
			self::SetOptions($options);
		} else {
			// set working pools
			$this->alphabet = $this->default_alphabet;
			$this->integers = $this->default_integers;
			$this->characters = $this->default_characters;
		}
	}
	
	// string Generate()
	public function Generate() {
		// an array to hold our parts
		$parts = Array();
		
		// lowercase letter
		if($this->lcase) {
			if(!empty($this->alphabet)) {
				for($i=0; $i<$this->lcase_count; $i++) {
					$parts[] = strtolower($this->alphabet[array_rand($this->alphabet, 1)]);
				}
			} else {
				die('Invalid alphabet pool.');
			}
		}

		// uppercase letter
		if($this->ucase) {
			if(!empty($this->alphabet)) {
				for($i=0; $i<$this->ucase_count; $i++) {
					$parts[] = strtoupper($this->alphabet[array_rand($this->alphabet, 1)]);
				}
			} else {
				die('Invalid alphabet pool.');
			}
		}

		// number
		if($this->number) {
			if(!empty($this->integers)) {
				for($i=0; $i<$this->number_count; $i++) {
					$parts[] = (string) $this->integers[array_rand($this->integers, 1)];
				}
			} else {
				die('Invalid integer pool.');
			}
		}

		// special characters
		if($this->special) {
			if(!empty($this->characters)) {
				for($i=0; $i<$this->special_count; $i++) {
					$parts[] = $this->characters[array_rand($this->characters, 1)];
				}
			} else {
				die('Invalid characters pool.');
			}
		}
		
		// shuffle
		if($this->shuffle) {
			shuffle($parts);
		}
		
		// return
		return implode("", $parts);
	}
	
	// bool ToggleLowerCase(bool option)
	public function ToggleLowerCase($option) {
		if($option === true) {
			$this->lcase = true;
		} else {
			$this->lcase = false;
		}
		return $this->lcase;
	}
	
	// bool ToggleUpperCase(bool option)
	public function ToggleUpperCase($option) {
		if($option === true) {
			$this->ucase = true;
		} else {
			$this->ucase = false;
		}
		return $this->ucase;
	}
	
	// bool ToggleNumbers(bool option)
	public function ToggleNumbers($option) {
		if($option === true) {
			$this->number = true;
		} else {
			$this->number = false;
		}
		return $this->number;
	}
	
	// bool ToggleSpecialCharacters(bool option)
	public function ToggleSpecialCharacters($option) {
		if($option === true) {
			$this->special = true;
		} else {
			$this->special = false;
		}
		return $this->special;
	}
	
	// bool SetLowercaseCount(int count)
	public function SetLowercaseCount($count) {
		if(is_number($count)) {
			$this->lcase_count = $count;
			return true;
		}
		return false;
	}
	
	// int GetLowercaseCount()
	public function GetLowercaseCount() {
		return $this->lcase_count;
	}
	
	// bool SetUppercaseCount(int count)
	public function SetUppercaseCount($count) {
		if(is_number($count)) {
			$this->ucase_count = $count;
			return true;
		}
		return false;
	}
	
	// int GetUpperCount()
	public function GetUppercaseCount() {
		return $this->ucase_count;
	}
	
	// bool SetNumbercount(int count)
	public function SetNumberCount($count) {
		if(is_number($count)) {
			$this->number_count = $count;
			return true;
		}
		return false;
	}
	
	// int GetNumberCount()
	public function GetNumberCount() {
		return $this->number_count;
	}
	
	// bool SetSpecialCount(int count)
	public function SetSpecialCount($count) {
		if(is_number($count)) {
			$this->special_count = $count;
			return true;
		}
		return false;
	}
	
	// int GetSpecialCount()
	public function GetSpecialCount() {
		return $this->special_count;
	}
	
	/* Private Methods */
	
	// void SetOptions(array options)
	private function SetOptions($options) {
		// set shuffle
		if(isset($options['shuffle']) && is_bool($options['shuffle'])) {
			$this->shuffle = $options['shuffle'];
		}
		
		// set lowercase
		if(isset($options['lcase']) && is_bool($options['lowercase'])) {
			$this->lcase = $options['lowercase'];
		}
		
		// set uppercase
		if(isset($options['uppercase']) && is_bool($options['uppercase'])) {
			$this->ucase = $options['uppercase'];
		}
		
		// set number
		if(isset($options['number']) && is_bool($options['number'])) {
			$this->number = $options['number'];
		}
		
		// set special
		if(isset($options['special']) && is_bool($options['special'])) {
			$this->special = $options['special'];
		}
		
		// define alphabet
		if(isset($options['alphabet']) && is_array($options['alphabet'])) {
			$this->alphabet = $options['alphabet'];
		}
		
		// define integers
		if(isset($options['integers']) && is_array($options['integers'])) {
			$this->integers = $options['integers'];
		}
		
		// define special characters
		if(isset($options['characters']) && is_array($options['characters'])) {
			$this->characters = $options['characters'];
		}
	}
}
?>