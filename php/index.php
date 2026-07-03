<?php

if (isset($_POST['gonder')) {
  $ad_soyad = $_POST['ad_soyad'];
  $mailFrom = $_POST['e_posta'];
  $konu = $_POST['konu'];
  $mesajınız = $_POST['mesajınız'];

  $mailTo = "bilgimatikiletisim@outlook.com";
  $headers = "From:".$mailFrom;
  $txt = "You have received an e-mail from ".$ad_soyad.".\n\n".$mesajınız;

  mail($mailTo, $konu, $txt, $headers);
  header("Location: index.php?mailsend");
}
