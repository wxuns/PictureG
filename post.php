<?php
error_reporting(E_ALL);
$operator = $_POST["operator"];
$time = $_POST["time"];
$title = $_POST["title"];
$top = $_POST["top"];
$bottom = $_POST["bottom"];
$apptitle = $_POST["apptitle"];
$file = $_POST["file"];
// echo mb_substr($top, 0,40);
// echo mb_strlen($top);exit();
// $font = "./font/0.ttf";
// $img = imagecreatefromjpeg('./images/0.jpg');
// $black = imagecolorexact($img, 255, 255, 255);
// // imagettftext($img, 12, 0, 0, 0, $black, $font, $operator);
// imagestring($img, 5, 0, 0, "Hello world!", $black);
// header('Content-Type: image/png');
// imagepng($img, "./temp/".md5(time()).".png");
$img = __DIR__ . "/images/0.jpg";
$logo = __DIR__.$file;
// 获取图片信息
$info = getimagesize($img);
$info2 = getimagesize($logo);
// 通过图片的编号来获取图片类型
$type = image_type_to_extension($info['2'], false);
$type2 = image_type_to_extension($info2['2'], false);
// 在内容中创一个和我们这个图片一样的图片
$ext = "imagecreatefrom{$type}";
$ext2 = "imagecreatefrom{$type2}";
// 把图片复制到内存中
$image = $ext($img);
$image2 = $ext2($logo);
imagecopy($image, $image2, 20, 605, 0, 0, 70, 70);
$color = imagecolorallocatealpha($image, 0, 0, 0, 0);
$gray = imagecolorallocatealpha($image, 133, 133, 138, 1);

imagettftext($image, 18, 0, 55, 28, $color, __DIR__ . '/font/1.ttf', $operator);
imagettftext($image, 18, 0, 335, 28, $color, __DIR__ . '/font/1.ttf', $time);
imagettftext($image, 30, 0, 60, 100, $color, __DIR__ . '/font/1.ttf', $title);
imagettftext($image, 20, 0, 23, 220, $gray, __DIR__ . '/font/1.ttf', mb_substr($top, 0,38));
imagettftext($image, 20, 0, 23, 260, $gray, __DIR__ . '/font/1.ttf', mb_substr($top, 38, 40));
imagettftext($image, 20, 0, 23, 300, $gray, __DIR__ . '/font/1.ttf', mb_substr($top, 78));

imagettftext($image, 20, 0, 23, 530, $gray, __DIR__ . '/font/1.ttf', mb_substr($bottom, 0,40));
imagettftext($image, 20, 0, 23, 560, $gray, __DIR__ . '/font/1.ttf', mb_substr($bottom, 40, 43));

imagettftext($image, 25, 0, 130, 650, $color, __DIR__ . '/font/1.ttf', $apptitle);


// header("content-type:" . $info['mime']);

$func = "image{$type}";
$img = '/temp/'.md5(time()).'.'.$type;
$func($image,__DIR__.$img);

echo json_encode(['msg'=>'success','src'=>$img]);