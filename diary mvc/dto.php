<?php
// setter, getter, read, write, flist, delete
class MyFile {
	private $fDir;
	private $imgDir;
	private $fileName;
	private $imgName;
	private $content;
	public function __construct() {
		$this->fDir = "content";
		$this->imgDir = "img";
		if (! is_dir ( $this->fDir )) {
			mkdir ( $this->fDir );
		}
		if (! is_dir ( $this->imgDir )) {
			mkdir ( $this->imgDir );
		}
	}
	public function setFileName($fileName) {
		$this->fileName = $fileName;
	}
	public function getFileName() {
		return $this->fileName;
	}
	public function setImgName($imgName) {
		$this->imgName = $imgName;
	}
	public function getImgName() {
		return $this->imgName;
	}
	public function setContent($content) {
		$this->content = $content;
	}
	public function getContent() {
		return $this->content;
	}
	public function flist($type) {
		$dir = "";
		$files = array ();
		if ($type == 1) { // flist
			$dir = $this->fDir;
		} else if ($type == 2) { // imglist
			$dir = $this->imgDir;
		}
		$dp = opendir ( $dir );
		while ( $file = readdir ( $dp ) ) {
			$fname = $file;
			if ($fname != "." && $fname != "..") {
				$files [] = $fname;
			}
		}
		closedir ( $dp );
		return $files;
	}
	public function read(){
		$str = file_get_contents($this->fDir."/".$this->fileName);
		$arr = explode("img=", $str);
		$this->content = $arr[0];
		$this->imgName = $arr[1];
	}
	public function write(){
		$result = $this->content."img=".$this->imgName;
		file_put_contents($this->fDir."/".$this->fileName, $result);
	}
	public function delete(){
		unlink($this->fDir."/".$this->fileName);
	}
	public function check(){
		$fname = $this->fDir."/".$this->fileName.".txt";
		if(is_file($fname)){
			return true;
		}else{
			return false;
		}
	}
}
?>