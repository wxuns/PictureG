<?php

if(!$_FILES['file']['error']){
	$newfile = '/logo/'.md5(time()) . '.png';
	$logo = __DIR__ . $newfile;
	move_uploaded_file($_FILES['file']['tmp_name'],$logo);
	list($width, $height) = getimagesize($logo);
	// 获取图片信息
	$info1 = getimagesize($logo);
	// 通过图片的编号来获取图片类型
	$type1 = image_type_to_extension($info1['2'], false);
	// 在内容中创一个和我们这个图片一样的图片
	$ext1 = "imagecreatefrom{$type1}";
	$thumb = imagecreatetruecolor(70, 70);
	imagecolorallocatealpha($thumb, 255, 255, 255,75);
	$source = $ext1($logo);
	imagecopyresized($thumb, $source, 0, 0, 0, 0, 70, 70, $width, $height);
	$func1 = "image{$type1}";
	$tmp = '/logo/thumb'.md5(time()).'.'.$type1;
	$func1($thumb,__DIR__.$tmp);
	echo json_encode(['code'=>0,"msg"=>"上传成功","data"=>["src"=>$tmp]]);
}