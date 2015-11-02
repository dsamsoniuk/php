<?php 
class comment {
	
	private $file_name;
	private $contents;
	private $file_size;
	
	function __construct($file_name) {
		$this->file_name = $file_name;	
		$this->check_file();
	}
	
	
	/* -- Sprawdza czy plik istnieje a jezeli nie to go tworzy -- */
	
	private function check_file(){
		if(!file_exists($this->file_name)) {
			$file = fopen($this->file_name, "w");
			$text = 'File created:||'.date('Y-m-d');
			fputs($file,$text);
			fclose($file);
		}
	}
	
	
	/* -- Zwraca zawartosc pliku komentarz (jako tablica) -- */
	
	public function contents(){
		
		$file = fopen($this->file_name, "r");
		$this->file_size = filesize($this->file_name);
		$this->contents = fread($file, $this->file_size);
		
		$line_comment = explode("\n", $this->contents);
		
		for($i=0;$i<count($line_comment); $i++){
			
			$divided_line_comment[$i] = explode('||',$line_comment[$i]);
		}
		fclose($file);
		return $divided_line_comment;
	}
	
	
	/* -- Zapisz do pliku komentarz -- */
	
	public function save_comment($nick_name, $comment){
		
		$file = fopen($this->file_name, "w");
		
		$text = $nick_name.'||'.$comment."\n";
		fputs($file,$text);
		fputs($file, $this->contents);
		
		fclose($file);
		unset($_POST);
		header('Refresh:0');
		
	}
	
		
}

?>