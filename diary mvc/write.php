<html>
<head>
<script type="text/javascript">
function a(){
   var win=window.open("check.php","","width=150,height=150");
}
function b(){
   if(f1.result.value=="true"){
      f1.submit();
   }else{
      alert("중복체크 미완료");
   }
}
</script>
</head>
<body>
<h3>일기쓰기</h3>
<form name="f1" action="index.php?action=write" method="post">
날짜:<input type="text" name="fname">
<input type="button" value="중복체크" onclick="a()"><br><br>
<?php 
foreach ($this->data as $f){
      print "<input type=radio name=iname value=".$f.">";
      print "<img src=img/".$f." style='width:30;height:30;'>";
}   
?>
<br><br>내용<br>
<textarea name="content" rows="15" cols="45"></textarea><br>
<input type="hidden" value="false" name="result">
<input type="button" value="save" onclick="b()">
</form>
</body>
</html>