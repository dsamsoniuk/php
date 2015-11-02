<?php
session_start();

/* ----- Nazwa pliku --------- */
$file_name = "licznik.txt";


echo '<h2>Licznik PHP napisany obiektowo + sesja</h2>';
echo '<br>';

$objekt = new file;
$objekt->set_file($file_name);

echo 'Nazwa pliku:';
echo $objekt->display_file_name();
echo '<br>Licznik odwiedzin:';
echo $objekt->display_contents();



/* ----------------------------------------------------------------------------------------------- */
/* --- Odczytaj plik i jego zawartosc oraz dodaj 1 do zawartosci --------------------------------- */
/* ----------------------------------------------------------------------------------------------- */


class file {
	
	protected $file_name;
	protected $file_size;
	protected $contents;
	
	
	/* -- Ustaw nowy plik --- */
	
	public function set_file($nazwa){
	$this->file_name = $nazwa;
	$this->exist();
	}
	
	
	/* -- Wyswietl zawartosc pliku --- */
	
	public function display_contents(){
		return $this->contents;
	}
	
	
	/* -- Wyswietl nazwe pliku --- */
	
	public function display_file_name(){
		return $this->file_name;}
		
		
	/* -- Otworz zawartosc pliku --- */
	
	private function file_contents(){
		$file_open=fopen($this->file_name, "r");
		$this->file_size = filesize($this->file_name);
		$this->contents = fread($file_open, $this->file_size);
		
		if(!isset($_SESSION['counter_inc'])){
			$this->counter($this->contents);
			$_SESSION['counter_inc']=false;
		}

		fclose($file_open);
	}
	
	
	/* -- Dodaj 1 do zawartosci pliku --- */	
	
	private function counter($number){
		$file_open=fopen($this->file_name, "w+");
		$number = intval($number)+1;
		fputs($file_open,$number);
		fclose($file_open);
	}
	
	
	/* -- Sprawdz czy istnieje plik --- */
	
	private function exist(){
		if(!file_exists($this->file_name)){
			echo 'Plik nie istnieje, sprawdz czy poprawnie napisałeś.';}
		else { 
			//echo 'Plik istnieje'; 
			$this->file_contents();}
	}
	
}





?>