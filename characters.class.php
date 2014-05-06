<?php
/*
Jeff Baker (sinerasis at gmail dot com)
March 2013
*/
class Characters {
	/* Properties */
	
	// enable/disable
	private $shuffle = true;
	private $lowercase = true;
	private $uppercase = true;
	private $numbers = true;
	private $specialcharacters = true;
	
	// counts
	private $lowercase_count = 1;
	private $uppercase_count = 1;
	private $number_count = 1;
	private $specialcharacter_count = 1;
	
	// pools
	private $alphabet_pool = Array();
	private $number_pool = Array();
	private $specialcharacter_pool = Array();
	
	/* Public Methods */
	
	// void __construct(mixed options)
	public function __construct($options = false) {
		// default alphabet pool
		if(!isset($options['alphabet_pool'])) $this->alphabet_pool = range('a','z');
		
		// default number pool
		if(!isset($options['number_pool'])) $this->number_pool = range(0,9);
		
		// default special character pool
		if(!isset($options['specialcharacter_pool'])) foreach(array_merge(range(32,47), range(58,54), range(91,96), range(123,126)) as $code) $this->specialcharacters_pool[] = chr($code);
		
		// set options if provided
		if($options) self::SetOptions($options);
	}
	
	// string Generate()
	public function Generate() {
		// an array to hold our parts
		$parts = Array();
		
		// lowercase letter(s)
		if($this->lowercase && !empty($this->alphabet_pool)) {
			for($i=0; $i<$this->lowercase_count; $i++) {
				$parts[] = strtolower($this->alphabet_pool[array_rand($this->alphabet_pool, 1)]);
			}
		}

		// uppercase letter(s)
		if($this->uppercase && !empty($this->alphabet_pool)) {
			for($i=0; $i<$this->uppercase_count; $i++) {
				$parts[] = strtoupper($this->alphabet_pool[array_rand($this->alphabet_pool, 1)]);
			}
		}

		// number(s)
		if($this->numbers && !empty($this->number_pool)) {
			for($i=0; $i<$this->number_count; $i++) {
				$parts[] = (string) $this->number_pool[array_rand($this->number_pool, 1)];
			}
		}

		// special character(s)
		if($this->specialcharacters && !empty($this->specialcharacters_pool)) {
			for($i=0; $i<$this->specialcharacter_count; $i++) {
				$parts[] = $this->specialcharacters_pool[array_rand($this->specialcharacters_pool, 1)];
			}
		}
		
		// shuffle
		if($this->shuffle) shuffle($parts);
		
		// return
		return implode("", $parts);
	}
	
	/* "Enable" methods */
	
	// bool EnableShuffle()
	public function EnableShuffle() {
		return self::SetShuffle(true);
	}
	
	// bool EnableLowerCase()
	public function EnableLowerCase() {
		return self::SetLowerCase(true);
	}
	
	// bool EnableUpperCase()
	public function EnableUpperCase() {
		return self::SetUpperCase(true);
	}
	
	// bool EnableNumbers()
	public function EnableNumbers() {
		return self::SetNumbers(true);
	}
	
	// bool EnableSpecialCharacters()
	public function EnableSpecialCharacters() {
		return self::SetSpecialCharacters(true);
	}
	
	/* "Disable" methods */
	
	// bool DisableShuffle()
	public function DisableShuffle() {
		return self::SetShuffle(false);
	}
	
	// bool DisableLowerCase()
	public function DisableLowerCase() {
		return self::SetLowerCase(false);
	}
	
	// bool DisableUpperCase()
	public function DisableUpperCase() {
		return self::SetUpperCase(false);
	}
	
	// bool DisableNumbers()
	public function DisableNumbers() {
		return self::SetNumbers(false);
	}
	
	// bool DisableSpecialCharacters()
	public function DisableSpecialCharacters() {
		return self::SetSpecialCharacters(false);
	}
	
	/* "Get" methods */
	
	// bool GetShuffle()
	public function GetShuffle() {
		return $this->shuffle;
	}
	
	// bool GetLowerCase()
	public function GetLowerCase() {
		return $this->lowercase;
	}
	
	// bool GetUpperCase()
	public function GetUpperCase() {
		return $this->uppercase;
	}
	
	// bool GetNumbers()
	public function GetNumbers() {
		return $this->numbers;
	}
	
	// bool GetSpecialCharacters()
	public function GetSpecialCharacters() {
		return $this->specialcharacters;
	}
	
	// int GetLowerCaseCount()
	public function GetLowerCaseCount() {
		return $this->lowercase_count;
	}
	
	// int GetUpperCaseCount()
	public function GetUpperCaseCount() {
		return $this->uppercase_count;
	}
	
	// int GetNumberCount()
	public function GetNumberCount() {
		return $this->number_count;
	}
	
	// int GetSpecialCharacterCount()
	public function GetSpecialCharacterCount() {
		return $this->specialcharacter_count;
	}
	
	// array GetAlphabetPool()
	public function GetAlphabetPool() {
		return $this->alphabet_pool;
	}
	
	// array GetNumberPool()
	public function GetNumberPool() {
		return $this->number_pool;
	}
	
	// array GetSpecialCharacterPool()
	public function GetSpecialCharacterPool() {
		return $this->specialcharacter_pool;
	}
	
	// array GetOptions()
	public function GetOptions() {
		return Array(
			'shuffle'=>GetShuffle(),
			'lowercase'=>GetLowerCase(),
			'uppercase'=>GetUpperCase(),
			'numbers'=>GetNumbers(),
			'specialcharacters'=>GetSpecialCharacters(),
			'lowercase_count'=>GetLowerCaseCount(),
			'uppercase_count'=>GetUpperCaseCount(),
			'number_count'=>GetNumberCount(),
			'specialcharacter_count'=>GetSpecialCharacterCount(),
			'alphabet_pool'=>GetAlphabetPool(),
			'number_pool'=>GetNumberPool(),
			'specialcharacter_pool'=>GetSpecialCharacterPool()
		);
	}
	
	/* "Set" methods */
	
	// bool SetShuffle(bool option)
	public function SetShuffle($option) {
		if(is_bool($option)) {
			$this->shuffle = $option;
			return true;
		}
		return false;
	}
	
	// bool SetLowerCase(bool option)
	public function SetLowerCase($option) {
		if(is_bool($option)) {
			$this->lowercase = $option;
			return true;
		}
		return false;
	}
	
	// bool SetUpperCase(bool option)
	public function SetUpperCase($option) {
		if(is_bool($option)) {
			$this->uppercase = $option;
			return true;
		}
		return false;
	}
	
	// bool SetNumbers(bool option)
	public function SetNumbers($option) {
		if(is_bool($option)) {
			$this->numbers = $option;
			return true;
		}
		return false;
	}
	
	// bool SetSpecialCharacters(bool option)
	public function SetSpecialCharacters($option) {
		if(is_bool($option)) {
			$this->specialcharacters = $option;
			return true;
		}
		return false;
	}
	
	// bool SetLowerCaseCount(int count)
	public function SetLowerCaseCount($count) {
		if(is_numeric($count) && $count >= 0) {
			$this->lowercase_count = $count;
			return true;
		}
		return false;
	}
	
	// bool SetUpperCaseCount(int count)
	public function SetUpperCaseCount($count) {
		if(is_numeric($count) && $count >= 0) {
			$this->uppercase_count = $count;
			return true;
		}
		return false;
	}
	
	// bool SetNumberCount(int count)
	public function SetNumberCount($count) {
		if(is_numeric($count) && $count >= 0) {
			$this->number_count = $count;
			return true;
		}
		return false;
	}
	
	// bool SetSpecialCharacterCount(int count)
	public function SetSpecialCharacterCount($count) {
		if(is_numeric($count) && $count >= 0) {
			$this->specialcharacter_count = $count;
			return true;
		}
		return false;
	}
	
	// bool SetAlphabetPool(array alphabet)
	public function SetAlphabetPool($alphabet) {
		if(is_array($alphabet)) {
			$this->alphabet_pool = $alphabet;
			return true;
		}
		return false;
	}
	
	// bool SetNumberPool(array numbers)
	public function SetNumberPool($numbers) {
		if(is_array($numbers)) {
			$this->number_pool = $numbers;
			return true;
		}
		return false;
	}
	
	// bool SetSpecialCharacterPool(array characters)
	public function SetSpecialCharacterPool($characters) {
		if(is_array($characters)) {
			$this->specialcharacter_pool = $characters;
			return true;
		}
		return false;
	}
	
	// bool SetOptions(array options)
	public function SetOptions($options) {
		if(is_array($options)) {
			$results = Array();
			if(isset($options['shuffle'])) $results[] = self::SetShuffle($options['shuffle']);
			if(isset($options['lowercase'])) $results[] = self::SetLowerCase($options['lowercase']);
			if(isset($options['uppercase'])) $results[] = self::SetUpperCase($options['uppercase']);
			if(isset($options['numbers'])) $results[] = self::SetNumbers($options['numbers']);
			if(isset($options['specialcharacters'])) $results[] = self::SetSpecialCharacters($options['specialcharacters']);
			if(isset($options['lowercase_count'])) $results[] = self::SetLowerCaseCount($options['lowercase_count']);
			if(isset($options['uppercase_count'])) $results[] = self::SetUpperCaseCount($options['uppercase_count']);
			if(isset($options['number_count'])) $results[] = self::SetNumberCount($options['number_count']);
			if(isset($options['specialcharacters_count'])) $results[] = self::SetSpecialCharacterCount($options['specialcharacter_count']);
			if(isset($options['alphabet_pool'])) $results[] = self::SetAlphabetPool($options['alphabet_pool']);
			if(isset($options['number_pool'])) $results[] = self::SetNumberPool($options['number_pool']);
			if(isset($options['specialcharacter_pool'])) $results[] = self::SetSpecialCharacterPool($options['specialcharacter_pool']);
			return !(in_array(false, $results, true));
		}
		return false;
	}
}
?>
