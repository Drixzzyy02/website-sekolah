<?php
require_once 'koneksi.php';

$galeri_full = [];
$result = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY created_at DESC");

while ($row = mysqli_fetch_assoc($result)) {
    $galeri_full[] = [
        "judul"=>$row['judul'],
        "deskripsi"=>$row['deskripsi'],
        "image"=>$row['gambar']
    ];
}

if(empty($galeri_full)){
$galeri_full=[

[
"judul"=>"Training Operator Enfield",
"deskripsi"=>"Simulasi strategi dan teknologi operator Enfield Industries",
"image"=>"media/g1.jpg"
],

[
"judul"=>"Research Technology Lab",
"deskripsi"=>"Laboratorium riset teknologi industri Terra",
"image"=>"media/g2.jpg"
],

[
"judul"=>"Command Strategy Room",
"deskripsi"=>"Pusat pelatihan strategi operator masa depan",
"image"=>"media/g3.jpg"
]

];
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Galeri Enfield Industries</title>

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

/* Active nav */
.navbar a.active {
color:var(--gold);
background:rgba(255,204,51,.15);
}

.navbar a:hover{

color:var(--gold);

background:rgba(255,204,51,.1);

}

.page-header{

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

.gallery-grid{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(280px,1fr));

gap:30px;

margin-top:30px;

}

.gallery-item{

background:var(--bg-card);

border-radius:12px;

overflow:hidden;

border:1px solid var(--border);

transition:.3s;

}

.gallery-item:hover{

transform:translateY(-6px);

border:1px solid var(--gold);

box-shadow:0 0 25px rgba(255,204,51,.08);

}

.gallery-item img{

width:100%;

height:200px;

object-fit:cover;

transition:.4s;

}

.gallery-item:hover img{

transform:scale(1.05);

}

.gallery-info{

padding:20px;

}

.gallery-item h3{

margin:0 0 10px;

color:var(--gold);

font-size:17px;

}

.gallery-item p{

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

<div class="navbar">

<div class="navbar-left">

<div class="navbar-logo">

<img src="media/enfieldlogo.png">

</div>

<div class="nav-links">
            <a href="dashboard.php">Dashboard</a> 
            <a href="profil.php">Profil</a>
            <a href="berita.php">Berita</a>
            <a href="ekstrakulikuler.php">Ekstrakulikuler</a>
            <a href="galeri.php" class="active">Galeri</a>
</div>

</div>

<div>


</div>

</div>

<div class="page-header">

<h1>Enfield Industries Gallery</h1>

<p>
Dokumentasi fasilitas pelatihan operator,
riset teknologi,
dan aktivitas industri Enfield.
</p>

</div>

<div class="section">

<p style="color:#7d8391;line-height:1.8;">

Galeri ini menampilkan berbagai aktivitas pelatihan operator,
riset teknologi,
dan pengembangan industri Enfield Industries
dalam membentuk generasi Terra masa depan.

</p>

<div class="gallery-grid">

<?php foreach($galeri_full as $item): ?>

<div class="gallery-item">

<img src="<?php echo $item['image']; ?>">

<div class="gallery-info">

<h3><?php echo $item['judul']; ?></h3>

<p><?php echo $item['deskripsi']; ?></p>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

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