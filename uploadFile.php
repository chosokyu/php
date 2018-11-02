<?php

$target_dir = "uploads/"; //ファイルが置かれるディレクトリを指定します
$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]); //ファイルのパスを指定
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));//ファイルの拡張子を指定

// check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
    if($check !== false) {
        echo "ファイルは画像です。 - |" . $check["mime"] . ".";
	echo '<br>';
        $uploadOk = 1;
    } else {
        echo "ファイルは画像ではありません。";
	echo '<br>';
        $uploadOk = 0;
    }
}

// ファイルが存在しているか確認する
if (file_exists($target_file)) {
    echo "ファイルは既に存在します。";
    $uploadOk = 0;
}

// ファイルのサイズを確認
if ($_FILES["fileUpload"]["size"] > 500000) {
    echo "ファイルが大きすぎます。";
    $uploadOk = 0;
}

// ファイルのタイプを確認
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "JPG、JPEG、PNG、GIFファイルのみが許可されています。";
    $uploadOk = 0;
}
// $uploadOkがエラーで0になっているか確認
if ($uploadOk == 0) {
    echo "ファイルはアップロードできませんでした。";
// 正常ならばアップロード
} else {
    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
        echo "このファイルは ". basename( $_FILES["fileUpload"]["name"]). " アップロードされました。";

?>
