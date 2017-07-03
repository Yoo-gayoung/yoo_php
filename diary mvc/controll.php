<?php
require_once 'dto.php';

class Controller{
	private	$action;
	private $myfile;
	private $view;
	private $data;
	
	public function __construct($action){
		$this->action = $action;
		$this->myfile = new MyFile();
	}
	
	public function run(){
		switch($this->action){ //action에 따라 각각 수행한다.
			case "list":
				$this->flist();
				break;
			case "read":
				$this->read();
				break;
			case "writeForm":
				$this->writeForm();
				break;
			case "write":
				$this->write();
				return;
			case "check":
				$this->check();
				return;
			case "del":
				$this->del();
				return;
			case "download":
				$this->download();
				return;
		}
		require $this->view;
	}
	public function download(){ // 저장된 일기를 컴퓨터에 저장한다.
		$fname=$_GET['fname'];
		header("Content-Disposition:attachment;filename=".$fname); //첨부파일의 파일명 지정
		header("Content-type:application/octet-stream;name=".$fname); //
		$result=file_get_contents("content/".$fname);
		print $result;
	}
	
	public function flist(){ //파일의 이름 목록을 출력하는 함수
		$this->data = $this->myfile->flist(1);
		$this->view = "list.php";
	}
	
	public function read(){ //목록에 있는 파일이름을 누르면, 그 파일의 상세 내용을 read.php에 나타낸다.
		$this->myfile->setFileName($_GET['fname']);
		$this->myfile->read();
		$this->view = "read.php";
	}
	
	public function write(){ // write.php에서 입력한 일기를 저장한다.
		$this->myfile->setFileName($_POST['fname'].".txt");
		$this->myfile->setContent($_POST['content']);
		$this->myfile->setImgName($_POST['iname']);
		$this->myfile->write();
		$this->action = "list";
		$this->run();
	}
	
	public function check(){ // 날짜의 중복 여부를 나타낸다.
		$this->myfile->setFileName($_POST['fname']);
		$flag = $this->myfile->check();
		if($flag){
			print "<script>alert('중복된 이름');</script>";
			require "check.php";
		}else{
			print "<script>opener.document.f1.fname.value='".$this->myfile->getFileName()."';opener.document.f1.result.value=true;self.close();</script>";
		}
	}
	
	public function del(){ // 일기를 삭제한다.
		$this->myfile->setFileName($_GET['fname']);
		$this->myfile->delete();
		$this->action = "list";
		$this->run();
	}
	public function writeForm(){
		$this->data = $this->myfile->flist(2);
		$this->view = "write.php";
	}
}
?>



