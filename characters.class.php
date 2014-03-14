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
	
	// pools
	private $alphabet = Array();
	private $integers = Array();
	private $characters = Array();
	
	/* Public Methods */
	
	// void __construct()
	public function __construct($options = false) {
		if($options && is_array($options)) {
			self::SetOptions($options);
		} else {
			// (default) alphabet
			$this->alphabet = range('a','z');
			
			// (default) integers
			$this->integers = range(0,9);
			
			// (default) "special" characters
			$special_ascii = array_merge(range(32,47), range(58,54), range(91,96), range(123,126));
			foreach($special_ascii as $code) {
				$this->characters[] = chr($code);
			}
		}
	}
	
	// string Generate()
	public function Generate() {
		// an array to hold our parts
		$parts = Array();
		
		// lowercase letter
		if($this->lcase) {
			for($i=0; $i<$this->lcase_count; $i++) {
				$parts[] = strtolower($this->alphabet[array_rand($this->alphabet, 1)]);
			}
		}

		// uppercase letter
		if($this->ucase) {
			for($i=0; $i<$this->ucase_count; $i++) {
				$parts[] = strtoupper($this->alphabet[array_rand($this->alphabet, 1)]);
			}
		}

		// number
		if($this->number) {
			for($i=0; $i<$this->number_count; $i++) {
				$parts[] = (string) $this->integers[array_rand($this->integers, 1)];
			}
		}

		// special characters
		if($this->special) {
			for($i=0; $i<$this->special_count; $i++) {
				$parts[] = $this->characters[array_rand($this->characters, 1)];
			}
		}
		
		// shuffle
		if($this->shuffle) {
			shuffle($parts);
		}
		
		// return
		return implode("", $parts);
	}
	
	// void EnableLowercase()
	public function EnableLowercase() {
		$this->lcase = true;
	}
	
	// void DisableLowercase()
	public function DisableLowercase() {
		$this->lcase = false;
	}
	
	// void EnableUppercase()
	public function EnableUppercase() {
		$this->ucase = true;
	}
	
	// void DisableUppercase()
	public function DisableUppercase() {
		$this->ucase = false;
	}
	
	// void EnableNumbers()
	public function EnableNumbers() {
		$this->number = true;
	}
	
	// void DisableNumbers()
	public function DisableNumbers() {
		$this->number = false;
	}
	
	// void EnableSpecialCharacters()
	public function EnableSpecialCharacters() {
		$this->special = true;
	}
	
	// void DisableSpecialCharacters()
	public function DisableSpecialCharacters() {
		$this->special = false;
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
			$this->scrable = $options['shuffle'];
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