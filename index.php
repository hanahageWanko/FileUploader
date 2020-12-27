<?php
  require_once './errors.php';
  if (isset($_POST['submitUpload']) && isset($_FILES['targetFile'])) {
      $uploadDir = './uploads/';
      $targetFile = $uploadDir.$_FILES['targetFile']['name'];
      $tmpName = $_FILES['targetFile']['tmp_name'];
      $errorInt = $_FILES['targetFile']['error'];
      $fileSize = $_FILES['targetFile']['size'];
      $pathInfo = pathinfo($_FILES['targetFile']['name']);
      $fileType = ['png','jpg','jpeg','gif'];

      $errorMessage = new ErrorMessage();

      // 同名ファイルが保存先に存在するか確認
      if ($errorInt === 1) {
        echo $errorMessage->error(1);
        return;
      } elseif ($fileSize > 1048576 /*1048576 = 1MB*/) {
        echo $errorMessage->error(2);
        return;
      } elseif ($errorInt === 4) {
        header('Location: index.php');
        exit;
      }

      if (!in_array($pathInfo['extension'], $fileType)) {
        echo $errorMessage->error(91);
        return;
      }

      $number = 1;
      while (file_exists($targetFile)) {
          var_dump($uploadDir.$pathInfo['filename']);
          $targetFile = $uploadDir.$pathInfo['filename'].'-'.$number.'.'.$pathInfo['extension'];
          $number++;
      }
      $isUploader = move_uploaded_file($tmpName, $targetFile);
      echo $isUploader ? $errorMessage->error(0) : $errorMessage->error(4);
      exit;
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>アップロードするファイルの選択</title>
</head>
<body>
  <form action="./index.php" method="POST" enctype="multipart/form-data">
    <div>
    <label for="file"><strong>Select file to update:</strong></label>
    </div>
    <div>
      <input type="file" name="targetFile" id="file">
      <input type="submit" name="submitUpload" value="upload">
    </div> 
  </form>
</body>
</html>