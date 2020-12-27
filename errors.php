<?php
class ErrorMessage {
  public function error($int) {
    $errorText = "";
    switch($int) {
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

?>