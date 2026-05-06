<?php  
session_start();  

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {  
}

require_once 'koneksi.php';

$profil = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT jumlah_guru, jumlah_siswa FROM profil WHERE id=1"));
$jumlah_guru = $profil['jumlah_guru'] ?? 0;
$jumlah_siswa = $profil['jumlah_siswa'] ?? 0;

$berita = [];  
$result = mysqli_query($koneksi, "SELECT judul, isi, gambar FROM berita ORDER BY created_at DESC LIMIT 2");

while ($row = mysqli_fetch_assoc($result)) {
$berita[]=$row;
}

if(empty($berita)){
$berita=[

[
"judul"=>"Operator Enfield memenangkan Tech Tournament",
"isi"=>"Operator muda Enfield berhasil memenangkan kompetisi teknologi Terra",
"gambar"=>"media/berita1.jpg"
],

[
"judul"=>"Industrial Research Program",
"isi"=>"Program riset industri terbaru untuk pengembangan teknologi operator",
"gambar"=>"media/berita2.jpg"
]

];
}

$jumlah_ekstrakurikuler_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM ekstrakulikuler");
$jumlah_ekstrakurikuler_row = mysqli_fetch_assoc($jumlah_ekstrakurikuler_result);
$jumlah_ekstrakurikuler = $jumlah_ekstrakurikuler_row['total'] ?? 0;

$galeri=[];

$result=mysqli_query($koneksi,"SELECT gambar,judul as caption FROM galeri ORDER BY created_at DESC LIMIT 4");

while($row=mysqli_fetch_assoc($result)){
$galeri[]=$row;
}

if(empty($galeri)){

$galeri=[

[
"gambar"=>"media/g1.jpg",
"caption"=>"Training Room"
],

[
"gambar"=>"media/g2.jpg",
"caption"=>"Research Lab"
],

[
"gambar"=>"media/g3.jpg",
"caption"=>"Operator Simulation"
],

[
"gambar"=>"media/g4.jpg",
"caption"=>"Enfield Facility"
]

];

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Dashboard</title>

<style>

*{
box-sizing:border-box;
}

html,body{
margin:0;
font-family:Arial;
background:#0e0e0e;
color:#fefefe;
}

/* NAVBAR */

.navbar{
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
position:fixed;
left:0;
right:0;
top:0;
background:rgba(0,0,0,0.5);
backdrop-filter:blur(10px);
z-index:1000;
}

.navbar a{
color:#ffcc33;
text-decoration:none;
padding:8px 15px;
background:rgba(255,255,255,0.08);
border-radius:6px;
transition:.3s;
}

.navbar a:hover{
background:rgba(255,204,51,0.15);
}

/* HERO */

.hero{
height:500px;
background:url('media/depan.jpeg');
background-size:cover;
background-position:center;
display:flex;
justify-content:center;
align-items:center;
position:relative;
margin-top:70px;   /* FIX NAVBAR TABRAKAN */
}

.overlay{
position:absolute;
width:100%;
height:100%;
background:rgba(0,0,0,0.6);
}

.hero-content{
position:relative;
z-index:2;
text-align:center;
}

.menu{
display:flex;
gap:30px;
justify-content:center;
margin-top:20px;
}

.menu a{
color:white;
text-decoration:none;
}

/* SECTION */

.section{
padding:50px;
}

.stats{
display:flex;
justify-content:center;
gap:30px;
margin-top:40px;
flex-wrap:wrap;
}

.stat-card{
background:#16181d;
padding:30px;
width:320px;
text-align:center;
border-radius:12px;
border:1px solid #262a33;
transition:.3s;
}

.stat-card h1{
color:#ffcc33;
font-size:42px;
margin:0;
}

.stat-card p{
color:#aeb4c2;
}

.stat-card:hover{
transform:translateY(-5px);
border:1px solid #ffcc33;
}

/* BERITA */

.card{
background:#16181d;
padding:20px;
border-radius:12px;
border:1px solid #262a33;
margin-bottom:25px;
}

.card h3{
color:#ffcc33;
}

.berita{
display:flex;
gap:20px;
align-items:center;
flex-wrap:wrap;
}

.berita img{
width:200px;
border-radius:10px;
}

.berita p{
color:#b8bcc8;
line-height:1.7;
}

/* GALLERY */

.gallery{
display:flex;
gap:40px;
flex-wrap:wrap;
justify-content:center;
margin-top:30px;
}

.gallery-item img{
width:250px;
height:160px;
object-fit:cover;
border-radius:10px;
transition:.3s;
border:1px solid #262a33;
}

.gallery-item img:hover{
transform:scale(1.05);
border:1px solid #ffcc33;
}

.gallery-item p{
margin-top:10px;
color:#aeb4c2;
}

/* FOOTER */

.footer{

background:#07080b;
padding:60px 20px;
text-align:center;
border-top:1px solid #262a33;
margin-top:60px;

}

.footer h3{

color:#ffcc33;
margin-bottom:15px;

}

.footer p{

color:#aeb4c2;
max-width:600px;
margin:auto;
line-height:1.7;

}

.footer-links{

display:flex;
justify-content:center;
gap:25px;
margin-top:25px;
flex-wrap:wrap;

}

.footer-links a{

color:#8d93a1;
text-decoration:none;
transition:.3s;

}

.footer-links a:hover{

color:#ffcc33;

}

.copyright{

margin-top:30px;
font-size:12px;
color:#6f7580;

}

/* SCROLLBAR HIDE */

body::-webkit-scrollbar{
display:none;
}

</style>

</head>

<body>

<div class="navbar">

<div class="navbar-logo">

<img src="media/enfieldlogo.png" height="40">

</div>

<div>

<?php if(!empty($_SESSION['user'])){ ?>

<a href="adminpanel.php">Admin Panel</a>

<a href="logout.php">Logout</a>

<?php }else{ ?>

<a href="login.php">Login</a>

<?php } ?>

</div>

</div>

<div class="hero">

<div class="overlay"></div>

<div class="hero-content">

<img src="media/enfieldlogo.png" style="width:150px;">

<h1>Enfield School Industries</h1>

<div class="menu">

<a href="ekstrakulikuler.php">Estrakulikuler</a>

<a href="galeri.php">Galeri</a>

<a href="profil.php">Profil</a>

<a href="berita.php">Berita</a>

</div>

</div>

</div>

<div class="section">

<h2>Informasi Operator</h2>

<div class="stats">

<div class="stat-card">

<h1><?php echo $jumlah_guru; ?></h1>

<p>Instuktur</p>

</div>

<div class="stat-card">

<h1><?php echo $jumlah_siswa; ?></h1>

<p>Siswa</p>

</div>

<div class="stat-card">

<h1><?php echo $jumlah_ekstrakurikuler; ?></h1>

<p>Ekstrakurikuler</p>

</div>

</div>

</div>

<div class="section">

<h2>Berita Enfield</h2>

<?php foreach($berita as $b){ ?>

<div class="card">

<div class="berita">

<img src="<?php echo $b['gambar']; ?>">

<div>

<h3><?php echo $b['judul']; ?></h3>

<p><?php echo $b['isi']; ?></p>

</div>

</div>

</div>

<?php } ?>

</div>

<div class="section">

<h2>Fasilitas Enfield</h2>

<div class="gallery">

<?php foreach($galeri as $g){ ?>

<div class="gallery-item">

<img src="<?php echo $g['gambar']; ?>">

<p><?php echo $g['caption']; ?></p>

</div>

<?php } ?>

</div>

</div>

<div class="footer">

<h3>Enfield School Industries</h3>

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

<a href="#">Arsip Data</a>

</div>

<p class="copyright">

© Enfield Industries Technology Division

</p>

</div>

</body>

</html>