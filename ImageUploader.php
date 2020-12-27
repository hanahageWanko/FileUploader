<?php

class ImageUploader
{
    private $name;
    private $tmpName;
    private $error;
    private $size;
    private $pathInfo;
    private $fileType = ['png','jpg','jpeg','gif'];

    public function __construct($file)
    {
        $this->name = $file['name'];
        $this->tmpName = $file['tmp_name'];
        $this->error = $file['error'];
        $this->size = $file['size'];
        $this->pathInfo = pathinfo($file['name']);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTmpName()
    {
        return $this->tmpName;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getPathInfo()
    {
        return $this->pathInfo;
    }

    public function getType()
    {
        return $this->fileType;
    }

    public function errorMessage($errNumber)
    {
        $errorText = "";
        switch ($errNumber) {
          case 1:
            $errorText = "アップロードされたファイルがupload_max_filesizeを超えています。";
            break;
          case 2:
            $errorText = "アップロードされたファイルが、HTMLフォームで指定されたMAX_FILE_SIZEディレクティブを超えています。";
            break;
          case 3:
            $errorText = "アップロードされたファイルは部分的にしかアップロードされていません。";
            break;
          case 4:
            $errorText = "ファイルはアップロードされませんでした。";
            break;
          case 5:
            $errorText = "一時フォルダーがありません。"; //PHP5.0.3で導入。
            break;
          case 6:
            $errorText = "ファイルをディスクに書き込めませんでした。"; // PHP5.1.0で導入。
            break;
          // case 7:
          //   $errorText = "エラーはありません。ファイルは正常にアップロードされました。";
          //   break;
          case 8:
            $errorText = "PHPがファイルのアップロードを停止しました。";
            break;
          case 90:
            $errorText = "同名のファイルが存在します。";
            break;
          case 91:
            $errorText = "画像ファイルを選択して下さい。";
            break;
          default:
            $errorText = "エラーはありません。ファイルは正常にアップロードされました。";
            break;
          }
        return $errorText;
    }
}
