<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alalım
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Boş alan kontrolü
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Hata mesajını göster
        echo "Lütfen tüm alanları doldurun ve geçerli bir e-posta adresi girin.";
        exit;
    }

    // Alıcı e-posta adresi
    $to = "sizinemail@example.com"; // Buraya kendi e-posta adresinizi girin

    // E-posta başlığı
    $email_subject = "Yeni mesaj: $subject";

    // E-posta içeriği
    $email_content = "İsim: $name\n";
    $email_content .= "E-posta: $email\n\n";
    $email_content .= "Mesaj:\n$message\n";

    // E-posta başlıkları
    $email_headers = "From: $name <$email>";

    // E-postayı gönder
    if (mail($to, $email_subject, $email_content, $email_headers)) {
        // Başarılı gönderim mesajı
        echo "Mesajınız başarıyla gönderildi.";
    } else {
        // Hata mesajı
        echo "Mesaj gönderilirken bir hata oluştu.";
    }
} else {
    echo "Formu doldurup tekrar deneyin.";
}
?>
