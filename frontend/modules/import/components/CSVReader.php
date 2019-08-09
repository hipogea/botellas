<?php

/**
 * Extendemos esta clase como un Helper para leer archivos CSV
 */

USE ruskid\csvimporter\CSVReader AS MyReader;

use Exception;

/**
 * CSV Reader
 * @author Julian Ramírez  <demin@trabeja.com>
 */
class CSVReader  extends MyReader{

    /**
     * @var string the path of the uploaded CSV file on the server.
     */
    /*public $filename;

    /**
     * FGETCSV() options: length, delimiter, enclosure, escape.
     * @var array 
     */
    public $fgetcsvOptions = ['length' => 0, 
        'delimiter' => ',',
        'enclosure' => '"', 
        'escape' => "\\"];

    /**
     * Start insert from line number. Set 1 if CSV file has header.
     * @var integer
     */
    public $startFromLine = 1;

    /**
     * @throws Exception
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Will read CSV file into array
     * @throws Exception
     * @return $array csv filtered data 
     */
    public function readFile() {
        $this->verifiyFile();
       

        $lines = []; //Clear and set rows
        if (($fp = fopen($this->filename, 'r')) !== FALSE) {
            while (($line =$this->ReadLineCsv($fp) ) !== FALSE) {
                array_push($lines, $line);
            }
        }
        //Remove unused lines from all lines
        for ($i = 0; $i < $this->startFromLine; $i++) {
            unset($lines[$i]);
        }
        return $lines;
    }
    
    
   public function getFirstRow(){
       $this->verifiyFile();
       $inicial=1;
       $linea=null;
       if (($fp = fopen($this->filename, 'r')) !== FALSE) {
            while (($line =$this->ReadLineCsv($fp) ) !== FALSE) {
                if($this->startFromLine==$inicial){
                     $linea=$line; break;
                }
                
                $inicial++;
            }
        }
      return $linea;
       
   } 
   
   private function verifiyFile(){
       if (!file_exists($this->filename)) {
            throw new Exception(__CLASS__ . ' couldn\'t find the CSV file.');
        }
   }
     
   private function ReadLineCsv($fp){
        //Prepare fgetcsv parameters
        $length = isset($this->fgetcsvOptions['length']) ? $this->fgetcsvOptions['length'] : 0;
        $delimiter = isset($this->fgetcsvOptions['delimiter']) ? $this->fgetcsvOptions['delimiter'] : ',';
        $enclosure = isset($this->fgetcsvOptions['enclosure']) ? $this->fgetcsvOptions['enclosure'] : '"';
        $escape = isset($this->fgetcsvOptions['escape']) ? $this->fgetcsvOptions['escape'] : "\\";
        return fgetcsv($fp, $length, $delimiter, $enclosure, $escape);
   }
   
   
}
