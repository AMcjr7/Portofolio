<?php
// ===============================
// KONFIGURASI
// ===============================
$tujuan_email = "asepkreatif14@gmail.com"; // GANTI dengan email kamu
$nama_web = "Website Asep Awaludin";

// ===============================
// CEK METHOD
// ===============================
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Akses tidak diizinkan");
}

// ===============================
// AMBIL & AMANKAN DATA
// ===============================
$nama  = htmlspecialchars(trim($_POST["author"] ?? ""));
$email = htmlspecialchars(trim($_POST["email"] ?? ""));
$pesan = htmlspecialchars(trim($_POST["text"] ?? ""));

// ===============================
// VALIDASI
// ===============================
if (empty($nama) || empty($email) || empty($pesan)) {
    die("Data tidak lengkap");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Format email tidak valid");
}

// ===============================
// ISI EMAIL
// ===============================
$subject = "Pesan Kontak dari $nama_web";

$body =_ATTACH:
$body = "Nama   : $nama\n";
$body .= "Email  : $email\n\n";
$body .= "Pesan:\n$pesan\n";

$headers = "From: $nama_web <$tujuan_email>\r\n";
$headers .= "Reply-To: $email\r\n";

// ===============================
// KIRIM EMAIL
// ===============================
if (mail($tujuan_email, $subject, $body, $headers)) {

    // ===============================
    // SIMPAN KE FILE (OPSIONAL)
    // ===============================
    $log = date("Y-m-d H:i:s") . " | $nama | $email | $pesan\n";
    file_put_contents("pesan.txt", $log, FILE_APPEND);

    // ===============================
    // REDIRECT BERHASIL
    // ===============================
    header("Location: ../kontak.html?status=success");
    exit();

} else {
    header("Location: ../kontak.html?status=error");
    exit();
}
?>