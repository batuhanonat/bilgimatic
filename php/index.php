<?php
// 1. Yazım hatası düzeltildi: $_POST['gonder'] parantez eksikti
if (isset($_POST['gonder'])) {
    
    // 2. HTML'deki 'name' öznitelikleriyle eşleştiğinden emin olun
    // HTML'de name="ad_soyad", name="email", name="konu", name="message" kullandık
    $ad_soyad = htmlspecialchars($_POST['ad_soyad']);
    $mailFrom = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $konu     = htmlspecialchars($_POST['konu']);
    $mesaj    = htmlspecialchars($_POST['message']);

    // 3. Basit bir güvenlik kontrolü
    if (!filter_var($mailFrom, FILTER_VALIDATE_EMAIL)) {
        die("Geçersiz e-posta adresi.");
    }

    $mailTo = "bilgimatikiletisim@outlook.com";
    
    // 4. Header yapısını düzeltin (Daha güvenli ve spam filtrelerine takılmaması için)
    $headers = "From: " . $mailFrom . "\r\n" .
               "Reply-To: " . $mailFrom . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    $txt = "Yeni bir mesajınız var!\n\n" .
           "İsim: " . $ad_soyad . "\n" .
           "Konu: " . $konu . "\n\n" .
           "Mesaj:\n" . $mesaj;

    // 5. Mail fonksiyonunu çalıştır
    if (mail($mailTo, $konu, $txt, $headers)) {
        header("Location: index.html?mailsend=success");
    } else {
        echo "Mesaj gönderilirken bir hata oluştu.";
    }
}
?>
