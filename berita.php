<?php
require_once 'koneksi.php';

$berita = [];
$result = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY created_at DESC");

while ($row = mysqli_fetch_assoc($result)) {
    $berita[] = [
        "judul" => $row['judul'],
        "isi" => $row['isi'],
        "image" => $row['gambar']
    ];
}

if(empty($berita)){
$berita=[
    [
        "judul"=>"Juara Lomba Programming",
        "isi"=>"Siswa memenangkan lomba coding tingkat nasional dengan performa yang luar biasa. Prestasi ini membuktikan dedikasi siswa dalam bidang teknologi informatika.",
        "image"=>"media/berita1.jpg"
    ],
    [
        "judul"=>"Kegiatan Bakti Sosial",
        "isi"=>"Sekolah mengadakan kegiatan sosial untuk masyarakat sekitar. Ribuan siswa terlibat dalam program pemberdayaan dan edukasi untuk komunitas lokal.",
        "image"=>"media/berita2.jpg"
    ],
    [
        "judul"=>"Peluncuran Lab Komputer Baru",
        "isi"=>"Fasilitas laboratorium komputer terbaru telah resmi diluncurkan dengan teknologi tercanggih untuk mendukung pembelajaran praktik siswa.",
        "image"=>"media/berita3.jpg"
    ],
    [
        "judul"=>"Kerjasama dengan Industri",
        "isi"=>"Sekolah menjalin kerjasama strategis dengan perusahaan teknologi terkemuka untuk program magang dan pembelajaran praktik industri.",
        "image"=>"media/berita4.jpg"
    ]
];
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Berita Enfield Industries</title>

<style>
:root{
--bg-main:#0b0c10;
--bg-card:#15171c;
--bg-nav:rgba(10,10,15,0.8);
--gold:#ffcc33;
--text-main:#ffffff;
--text-soft:#aeb4c2;
--border:#262a33;
}

body{
margin:0;
font-family:Segoe UI,Arial;
background:var(--bg-main);
color:var(--text-main);
}

.navbar{
padding:15px 40px;
display:flex;
justify-content:space-between;
align-items:center;
background:var(--bg-nav);
border-bottom:1px solid var(--border);
position:fixed;
top:0;
left:0;
right:0;
z-index:1000;
}

.navbar-left{
display:flex;
gap:30px;
align-items:center;
}

.navbar-logo img{
height:40px;
}

.nav-links{
display:flex;
gap:20px;
}

.navbar a{
color:var(--text-soft);
text-decoration:none;
padding:8px 14px;
border-radius:6px;
transition:.3s;
font-size:14px;
}

.navbar a:hover{
color:var(--gold);
background:rgba(255,204,51,.1);
}

/* Active nav */
.navbar a.active {
color:var(--gold);
background:rgba(255,204,51,.15);
}

.page-header{
margin-top:80px;
padding:60px 20px;
text-align:center;
background:linear-gradient(180deg,#11131a,#0b0c10);
border-bottom:1px solid var(--border);
}

.page-header h1{
margin:0;
color:var(--gold);
font-size:38px;
}

.page-header p{
color:var(--text-soft);
margin-top:10px;
}

.section{
max-width:1200px;
margin:auto;
padding:50px 30px;
}

.berita-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:30px;
margin-top:30px;
}

.berita-card{
background:var(--bg-card);
border-radius:12px;
overflow:hidden;
border:1px solid var(--border);
transition:.3s;
}

.berita-card:hover{
transform:translateY(-6px);
border:1px solid var(--gold);
box-shadow:0 0 25px rgba(255,204,51,.08);
}

.berita-card img{
width:100%;
height:200px;
object-fit:cover;
transition:.4s;
}

.berita-card:hover img{
transform:scale(1.05);
}

.berita-info{
padding:20px;
}

.berita-card h3{
margin:0 0 10px;
color:var(--gold);
font-size:17px;
}

.berita-card p{
margin:0;
color:var(--text-soft);
font-size:13px;
line-height:1.6;
}

.footer{
background:#07080b;
padding:60px 20px;
text-align:center;
border-top:1px solid var(--border);
margin-top:60px;
}

.footer h2{
color:var(--gold);
margin-bottom:15px;
}

.footer{
background:#07080b;
padding:60px 20px;
text-align:center;
border-top:1px solid var(--border);
margin-top:60px;
}

.footer h2{
color:var(--gold);
margin-bottom:15px;
}

.footer p{
color:var(--text-soft);
max-width:600px;
margin:auto;
line-height:1.7;
}

.footer-links{
display:flex;
justify-content:center;
gap:25px;
margin-top:25px;
}

.footer-links a{
color:#8d93a1;
text-decoration:none;
font-size:14px;
transition:.3s;
}

.footer-links a:hover{
color:var(--gold);
}

.copyright{
margin-top:30px;
font-size:12px;
color:#6f7580;
}
</style>

</head>

<body>

<!-- Navigation Bar -->
<div class="navbar">
    <div class="navbar-left">
        <div class="navbar-logo">
            <img src="media/enfieldlogo.png" alt="Logo">
        </div>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="profil.php">Profil</a>
            <a href="berita.php" class="active">Berita</a>
            <a href="ekstrakulikuler.php">Ekstrakulikuler</a>
            <a href="galeri.php">Galeri</a>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="page-header">
    <h1>Berita Terkini</h1>
    <p>Informasi terbaru dari Enfield Industries</p>
</div>

<!-- Main Content -->
<div class="section">
    <div class="berita-grid">
        <?php foreach($berita as $item): ?>
        <div class="berita-card">
            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['judul']; ?>">
            <div class="berita-info">
                <h3><?php echo $item['judul']; ?></h3>
                <p><?php echo substr($item['isi'], 0, 120); ?>...</p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->
<div class="footer">

<h2>Enfield School Industries</h2>

<p>

Institusi pendidikan teknologi dan strategi

yang berfokus pada pengembangan operator Enfield

untuk menghadapi tantangan dunia Terra.

</p>

<p>

Membangun masa depan melalui inovasi,

riset industri,

dan disiplin teknologi.

</p>

<div class="footer-links">

<a href="#">Kontak Operator</a>

<a href="#">Lokasi Terra</a>

<a href="#">Rekrutmen</a>

<a href="#">Data Arsip</a>

</div>

<p class="copyright">

© Enfield Industries Technology Division

</p>

</div>

</body>

</html>
