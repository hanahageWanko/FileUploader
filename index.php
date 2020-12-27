<?php
  require_once './ImageUploader.php';
  if (
    isset($_POST['submitUpload'])
    && (isset($_FILES['targetFile']) && $_FILES['targetFile']["name"] !== ""))
  {
      $files = new ImageUploader($_FILES['targetFile']);
      $uploadDir = './uploads/';
      $targetFile = $uploadDir.$files->getName();

      if ($files->getError() !== 0) {
          $files->errorMessage($files->getError());
          return;
      }
      if ($files->getSize() > 1048576 /*1048576 = 1MB*/) {
          echo $files->errorMessage(2);
          return;
      }
      if (!in_array($files->getPathInfo()['extension'], $files->getType())) {
          echo $files->errorMessage(91);
          return;
      }

      $number = 1;
      while (file_exists($targetFile)) {
          $targetFile = $uploadDir.$files->getPathInfo()['filename'].'-'.$number.'.'.$files->getPathInfo()['extension'];
          $number++;
      }
      $isUploader = move_uploaded_file($files->getTmpName(), $targetFile);
      echo $isUploader ? $files->errorMessage(0) : $files->errorMessage(4);
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