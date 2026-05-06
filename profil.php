<?php
require_once 'koneksi.php';

$query = mysqli_query($koneksi,"SELECT * FROM profil WHERE id=1");
$profil = mysqli_fetch_assoc($query);

if(!$profil){
    $profil = [
        "nama_sekolah"=>"SMK STRADA JAKARTA",
        "npsn"=>"20104082",
        "didirikan"=>"1995",
        "alamat"=>"Jl. Pendidikan No.123 Jakarta",
        "visi"=>"Mencetak lulusan yang kompeten dan siap kerja",
        "misi"=>[
            "Menyelenggarakan pendidikan berbasis industri",
            "Meningkatkan kompetensi praktik siswa",
            "Membentuk karakter disiplin",
            "Mendorong siswa adaptif terhadap teknologi"
        ],
        "jurusan"=>[
            "TKJ",
            "RPL",
            "Teknik Mesin",
            "Otomotif",
            "Manajemen Perkantoran"
        ],
        "telpon"=>"(021) 1234-5678",
        "email"=>"info@enfield-industries.com",
        "website"=>"www.enfield-industries.com"
    ];
}else{

$misiText = $profil['misi'] ?? '';
$profil['misi'] = array_filter(array_map('trim',explode('.',$misiText)));

$jurusanText = $profil['jurusan'] ?? '';
$profil['jurusan'] = array_filter(array_map('trim',explode(',',$jurusanText)));

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Enfield Industries Profile</title>

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
font-family:'Segoe UI',Arial;

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

position:sticky;
top:0;
z-index:99;

}

.navbar-left{

display:flex;

gap:30px;

align-items:center;

}

/* Active nav */
.navbar a.active {
color:var(--gold);
background:rgba(255,204,51,.15);
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

.profile-grid{

display:grid;

grid-template-columns:1fr;

gap:25px;

margin-top:30px;

width:100%;

}

.profile-item{

background:var(--bg-card);

border-radius:12px;

border:1px solid var(--border);

padding:25px;

transition:.3s;

}

.profile-item:hover{

transform:translateY(-6px);

border-color:var(--gold);

box-shadow:0 0 25px rgba(255,204,51,.08);

}

.profile-item h2{

margin:0 0 20px;

color:var(--gold);

font-size:22px;

border-bottom:1px solid var(--border);

padding-bottom:12px;

}

.info-row{

display:flex;

margin-bottom:15px;

padding:8px 0;

border-bottom:1px solid #2a2f36;

}

.info-label{

width:150px;

color:var(--gold);

font-weight:600;

font-size:14px;

}

.info-value{

color:var(--text-soft);

line-height:1.6;

flex:1;

}

.profile-list{

list-style:none;

padding:0;

margin:0;

}

.profile-list li{

padding:12px 0;

padding-left:25px;

position:relative;

color:var(--text-soft);

font-size:14px;

line-height:1.5;

border-bottom:1px solid #2a2f36;

}

.profile-list li:before{

content:"▸";

position:absolute;

left:0;

color:var(--gold);

font-size:16px;

}

.profile-list li:last-child{

border-bottom:none;

}

.intro-text{

color:#7d8391;

line-height:1.8;

margin-bottom:30px;

font-size:15px;

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

.navbar .logout {  /* override for logout */

background: #ff4444;

padding: 8px 18px;

}

.navbar .logout:hover {

background: #ff5757;

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
            <a href="profil.php" class="active">Profil</a>
            <a href="berita.php">Berita</a>
            <a href="ekstrakulikuler.php">Ekstrakulikuler</a>
            <a href="galeri.php">Galeri</a>
</div>

</div>

<div>


</div>

</div>


<div class="page-header">

<h1>Enfield Industries Profile</h1>

<p>Informasi institusional lengkap, visi, misi, dan program pelatihan Siswa di Enfield Industries.</p>

</div>


<div class="section">

<p class="intro-text">

Profil ini menyajikan informasi dasar, visi strategis, misi inti, dan program khusus dari Enfield Industries - mengembangkan siswa teknologi masa depan Terra.

</p>

<div class="profile-grid">

<div class="profile-item">

<h2>Informasi Dasar</h2>

<div class="info-row">

<div class="info-label">Institution</div>

<div class="info-value"><?php echo htmlspecialchars($profil['nama_sekolah']); ?></div>

</div>

<div class="info-row">

<div class="info-label">NPSN</div>

<div class="info-value"><?php echo htmlspecialchars($profil['npsn']); ?></div>

</div>

<div class="info-row">

<div class="info-label">Tahun Berdiri</div>

<div class="info-value"><?php echo htmlspecialchars($profil['didirikan']); ?></div>

</div>

<div class="info-row">

<div class="info-label">Lokasi</div>

<div class="info-value"><?php echo htmlspecialchars($profil['alamat']); ?></div>

</div>

</div>

<div class="profile-item">

<h2>Visi</h2>

<p style="color:var(--text-soft); line-height:1.7;"><?php echo htmlspecialchars($profil['visi']); ?></p>

</div>

<div class="profile-item">

<h2>Misi</h2>

<ul class="profile-list">

<?php foreach($profil['misi'] as $m){ ?>

<li><?php echo htmlspecialchars($m); ?></li>

<?php } ?>

</ul>

</div>

<div class="profile-item">

<h2>Program Jurusan</h2>

<ul class="profile-list">

<?php foreach($profil['jurusan'] as $j){ ?>

<li><?php echo htmlspecialchars($j); ?></li>

<?php } ?>

</ul>

</div>

<div class="profile-item">

<h2>Hubungi Kami</h2>

<div class="info-row">

<div class="info-label">Telepon</div>

<div class="info-value"><?php echo htmlspecialchars($profil['telpon']); ?></div>

</div>

<div class="info-row">

<div class="info-label">Email</div>

<div class="info-value"><?php echo htmlspecialchars($profil['email']); ?></div>

</div>

<div class="info-row">

<div class="info-label">Website</div>

<div class="info-value"><?php echo htmlspecialchars($profil['website']); ?></div>

</div>

</div>

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