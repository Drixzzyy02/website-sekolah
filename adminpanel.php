<?php
session_start();

// Autentikasi sederhana (harus sudah login)
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once 'koneksi.php';

// Enable error reporting for debugging (remove in production)
if (isset($_GET['debug'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

$uploadDir = 'media/';

define('FLASH_SUCCESS', 'success');
define('FLASH_ERROR', 'error');

function uploadImage($file, $uploadDir)
{
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            return null;
        }
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '', $file['name']);
        $path = $uploadDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $path)) {
            return $path;
        }
    }
    return null;
}

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? '';
$id = intval($_GET['id'] ?? 0);

function flash($type, $message)
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

// Processing forms
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($page === 'profil') {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama_sekolah'] ?? '');
        $npsn = mysqli_real_escape_string($koneksi, $_POST['npsn'] ?? '');
        $didirikan = mysqli_real_escape_string($koneksi, $_POST['didirikan'] ?? '');
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat'] ?? '');
        $visi = mysqli_real_escape_string($koneksi, $_POST['visi'] ?? '');
        $misi = mysqli_real_escape_string($koneksi, $_POST['misi'] ?? '');
        $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan'] ?? '');
        $telpon = mysqli_real_escape_string($koneksi, $_POST['telpon'] ?? '');
        $email = mysqli_real_escape_string($koneksi, $_POST['email'] ?? '');
        $website = mysqli_real_escape_string($koneksi, $_POST['website'] ?? '');
        $jumlah_siswa = intval($_POST['jumlah_siswa'] ?? 0);
        $jumlah_guru = intval($_POST['jumlah_guru'] ?? 0);

        $cek = mysqli_query($koneksi, "SELECT id FROM profil LIMIT 1");
        if (mysqli_num_rows($cek) > 0) {
            mysqli_query($koneksi, "UPDATE profil SET nama_sekolah='$nama', npsn='$npsn', didirikan='$didirikan', alamat='$alamat', visi='$visi', misi='$misi', jurusan='$jurusan', telpon='$telpon', email='$email', website='$website', jumlah_siswa=$jumlah_siswa, jumlah_guru=$jumlah_guru WHERE id=1");
        } else {
            mysqli_query($koneksi, "INSERT INTO profil (id, nama_sekolah, npsn, didirikan, alamat, visi, misi, jurusan, telpon, email, website, jumlah_siswa, jumlah_guru) VALUES (1, '$nama', '$npsn', '$didirikan', '$alamat', '$visi', '$misi', '$jurusan', '$telpon', '$email', '$website', $jumlah_siswa, $jumlah_guru)");
        }

        flash(FLASH_SUCCESS, 'Profil berhasil disimpan.');
        header('Location: adminpanel.php?page=profil');
        exit;
    }

    if ($page === 'berita') {
        $judul = mysqli_real_escape_string($koneksi, $_POST['judul'] ?? '');
        $isi = mysqli_real_escape_string($koneksi, $_POST['isi'] ?? '');
        $gambar = uploadImage($_FILES['gambar'] ?? null, $uploadDir);

        if ($action === 'edit' && $id > 0) {
            $set = "judul='$judul', isi='$isi'";
            if ($gambar) {
                $set .= ", gambar='$gambar'";
            }
            $result = mysqli_query($koneksi, "UPDATE berita SET $set WHERE id=$id");
            if ($result) {
                flash(FLASH_SUCCESS, 'Berita diperbarui.');
            } else {
                flash(FLASH_ERROR, 'Gagal memperbarui berita: ' . mysqli_error($koneksi));
            }
        } else {
            if (!$gambar) {
                flash(FLASH_ERROR, 'Silakan unggah gambar berita.');
            } else {
                $result = mysqli_query($koneksi, "INSERT INTO berita (judul, isi, gambar, created_at) VALUES ('$judul', '$isi', '$gambar', NOW())");
                if ($result) {
                    flash(FLASH_SUCCESS, 'Berita ditambahkan.');
                } else {
                    flash(FLASH_ERROR, 'Gagal menambahkan berita: ' . mysqli_error($koneksi));
                }
            }
        }

        header('Location: adminpanel.php?page=berita');
        exit;
    }

    if ($page === 'ekstrakulikuler') {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama'] ?? '');
        $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi'] ?? '');
        $gambar = uploadImage($_FILES['gambar'] ?? null, $uploadDir);

        if ($action === 'edit' && $id > 0) {
            $set = "nama='$nama', deskripsi='$deskripsi'";
            if ($gambar) {
                $set .= ", gambar='$gambar'";
            }
            $result = mysqli_query($koneksi, "UPDATE ekstrakulikuler SET $set WHERE id=$id");
            if ($result) {
                flash(FLASH_SUCCESS, 'Data ekstrakurikuler diperbarui.');
            } else {
                flash(FLASH_ERROR, 'Gagal memperbarui ekstrakurikuler: ' . mysqli_error($koneksi));
            }
        } else {
            if (!$gambar) {
                flash(FLASH_ERROR, 'Silakan unggah gambar.');
            } else {
                $result = mysqli_query($koneksi, "INSERT INTO ekstrakulikuler (nama, deskripsi, gambar, created_at) VALUES ('$nama', '$deskripsi', '$gambar', NOW())");
                if ($result) {
                    flash(FLASH_SUCCESS, 'Data ekstrakurikuler ditambahkan.');
                } else {
                    flash(FLASH_ERROR, 'Gagal menambahkan ekstrakurikuler: ' . mysqli_error($koneksi));
                }
            }
        }

        header('Location: adminpanel.php?page=ekstrakulikuler');
        exit;
    }

    if ($page === 'galeri') {
        $judul = mysqli_real_escape_string($koneksi, $_POST['judul'] ?? '');
        $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi'] ?? '');
        $gambar = uploadImage($_FILES['gambar'] ?? null, $uploadDir);

        if ($action === 'edit' && $id > 0) {
            $set = "judul='$judul', deskripsi='$deskripsi'";
            if ($gambar) {
                $set .= ", gambar='$gambar'";
            }
            $result = mysqli_query($koneksi, "UPDATE galeri SET $set WHERE id=$id");
            if ($result) {
                flash(FLASH_SUCCESS, 'Galeri diperbarui.');
            } else {
                flash(FLASH_ERROR, 'Gagal memperbarui galeri: ' . mysqli_error($koneksi));
            }
        } else {
            if (!$gambar) {
                flash(FLASH_ERROR, 'Silakan unggah gambar.');
            } else {
                $result = mysqli_query($koneksi, "INSERT INTO galeri (judul, deskripsi, gambar, created_at) VALUES ('$judul', '$deskripsi', '$gambar', NOW())");
                if ($result) {
                    flash(FLASH_SUCCESS, 'Galeri ditambahkan.');
                } else {
                    flash(FLASH_ERROR, 'Gagal menambahkan galeri: ' . mysqli_error($koneksi));
                }
            }
        }

        header('Location: adminpanel.php?page=galeri');
        exit;
    }
}

// Handle delete actions
if ($action === 'delete' && $id > 0) {
    if ($page === 'berita') {
        mysqli_query($koneksi, "DELETE FROM berita WHERE id=$id");
        flash(FLASH_SUCCESS, 'Berita dihapus.');
    }
    if ($page === 'ekstrakulikuler') {
        mysqli_query($koneksi, "DELETE FROM ekstrakulikuler WHERE id=$id");
        flash(FLASH_SUCCESS, 'Ekstrakurikuler dihapus.');
    }
    if ($page === 'galeri') {
        mysqli_query($koneksi, "DELETE FROM galeri WHERE id=$id");
        flash(FLASH_SUCCESS, 'Galeri dihapus.');
    }

    header("Location: adminpanel.php?page=$page");
    exit;
}

// Load data
$profilData = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT * FROM profil WHERE id=1'));
$beritaList = mysqli_query($koneksi, 'SELECT * FROM berita ORDER BY created_at DESC');
$ekstraList = mysqli_query($koneksi, 'SELECT * FROM ekstrakulikuler ORDER BY created_at DESC');
$galeriList = mysqli_query($koneksi, 'SELECT * FROM galeri ORDER BY created_at DESC');

$currentEdit = null;
if ($action === 'edit' && $id > 0) {
    if ($page === 'berita') {
        $currentEdit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM berita WHERE id=$id"));
    }
    if ($page === 'ekstrakulikuler') {
        $currentEdit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM ekstrakulikuler WHERE id=$id"));
    }
    if ($page === 'galeri') {
        $currentEdit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM galeri WHERE id=$id"));
    }
}

// Flash message data
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

function navItem($name, $target, $page)
{
    $active = ($page === $target) ? 'nav-active' : '';
    return "<a class='$active' href='adminpanel.php?page=$target'>$name</a>";
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endmin Panel - Endfield School Industries</title>
    <style>
        * { box-sizing: border-box; }
        body { margin:0; font-family: Arial, sans-serif; background:#0e0e0e; color:#fefefe; }
        .navbar { display:flex; justify-content:space-between; align-items:center; padding:12px 24px; background:rgba(0,0,0,0.35); backdrop-filter: blur(10px); position:fixed; width:100%; top:0; z-index:10; }
        .navbar div { display:flex; align-items:center; }
        .navbar a { color:#d7d7d7; margin-right:14px; text-decoration:none; padding:8px 12px; border-radius:6px; }
        .navbar a:first-child { color:#ffdd57; font-weight:600; }
        .navbar a.nav-active, .navbar a:hover { background:#ffdd57; color:#111; }
        .content { max-width:1200px; margin:100px auto 60px; padding:0 24px; }
        .card { background:#1a1a1a; border:1px solid #333; border-radius:12px; padding:24px; margin-bottom:24px; }
        .card h2 { margin-top:0; margin-bottom:16px; color:#ffdd57; }
        .flash { margin-bottom:18px; }
        .button { display:inline-block; margin:6px 4px; padding:8px 14px; background:#ffdd57; color:#111; border:none; border-radius:8px; text-decoration:none; font-weight:600; cursor:pointer; }
        .button:hover { background:#f2c900; }
        .input, .textarea { width:100%; padding:10px; border:1px solid #444; border-radius:8px; background:#111; color:#fefefe; }
        .input:focus, .textarea:focus { border-color:#ffdd57; outline:none; box-shadow:0 0 0 2px rgba(255,221,87,0.2); }
        table { width:100%; border-collapse: collapse; margin-top:14px; }
        th, td { border:1px solid #333; padding:8px; text-align:left; }
        th { background:#222; }
        tr:nth-child(even) { background:#161616; }
        .flash { padding:10px 12px; border-radius:8px; margin-bottom:14px; }
        .flash.success { background:#1f491a; color:#c7f0c9; }
        .flash.error { background:#4a1a1a; color:#f5b4b4; }
        .img-preview { max-width:150px; display:block; margin-top:6px; border-radius:8px; }
    </style>
</head>
<body>
<div class="navbar">
    <div>
        <a href="dashboard.php">← Dashboard Utama</a>
        <?= navItem('Dashboard', 'dashboard', $page) ?>
        <?= navItem('Profil', 'profil', $page) ?>
        <?= navItem('Berita', 'berita', $page) ?>
        <?= navItem('Ekstrakurikuler', 'ekstrakulikuler', $page) ?>
        <?= navItem('Galeri', 'galeri', $page) ?>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="content">
    <?php if (!empty($flash) && !empty($flash['type']) && !empty($flash['message'])): ?>
        <div class="flash <?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['message']) ?></div>
    <?php endif; ?>

    <?php if ($page === 'dashboard'): ?>
        <div class="card"><h2>Selamat datang, <?= htmlspecialchars($_SESSION['user']) ?></h2><p>Kelola profil, berita, ekstrakurikuler, dan galeri sekolah dari halaman ini.</p></div>
    <?php elseif ($page === 'profil'): ?>
        <div class="card">
            <h2>Profil Sekolah</h2>
            <form method="post" action="adminpanel.php?page=profil">
                <label>Nama Sekolah</label><input class="input" type="text" name="nama_sekolah" value="<?= htmlspecialchars($profilData['nama_sekolah'] ?? '') ?>" required>
                <label>NPSN</label><input class="input" type="text" name="npsn" value="<?= htmlspecialchars($profilData['npsn'] ?? '') ?>" required>
                <label>Tahun Didirikan</label><input class="input" type="text" name="didirikan" value="<?= htmlspecialchars($profilData['didirikan'] ?? '') ?>" required>
                <label>Alamat</label><input class="input" type="text" name="alamat" value="<?= htmlspecialchars($profilData['alamat'] ?? '') ?>" required>
                <label>Visi</label><textarea class="textarea" name="visi" rows="3"><?= htmlspecialchars($profilData['visi'] ?? '') ?></textarea>
                <label>Misi</label><textarea class="textarea" name="misi" rows="4"><?= htmlspecialchars($profilData['misi'] ?? '') ?></textarea>
                <label>Jurusan (pisahkan koma)</label><textarea class="textarea" name="jurusan" rows="3"><?= htmlspecialchars($profilData['jurusan'] ?? '') ?></textarea>
                <label>Jumlah Siswa</label><input class="input" type="number" name="jumlah_siswa" value="<?= htmlspecialchars($profilData['jumlah_siswa'] ?? 0) ?>">
                <label>Jumlah Guru</label><input class="input" type="number" name="jumlah_guru" value="<?= htmlspecialchars($profilData['jumlah_guru'] ?? 0) ?>">
                <label>Telepon</label><input class="input" type="text" name="telpon" value="<?= htmlspecialchars($profilData['telpon'] ?? '') ?>"><label>Email</label><input class="input" type="email" name="email" value="<?= htmlspecialchars($profilData['email'] ?? '') ?>"><label>Website</label><input class="input" type="text" name="website" value="<?= htmlspecialchars($profilData['website'] ?? '') ?>">
                <button class="button" type="submit">Simpan Profil</button>
            </form>
        </div>
    <?php elseif ($page === 'berita'): ?>
        <div class="card">
            <h2>Form Berita</h2>
            <form method="post" action="adminpanel.php?page=berita<?= ($action==='edit' && $id ? '&action=edit&id='.$id : '') ?>" enctype="multipart/form-data">
                <label>Judul</label><input class="input" type="text" name="judul" value="<?= htmlspecialchars($currentEdit['judul'] ?? '') ?>" required>
                <label>Isi</label><textarea class="textarea" name="isi" rows="4" required><?= htmlspecialchars($currentEdit['isi'] ?? '') ?></textarea>
                <label>Gambar (<?= (!empty($currentEdit) && !empty($currentEdit['gambar'])) ? 'opsional' : 'wajib' ?>)</label><input type="file" name="gambar" accept="image/*" class="input">
                <?php if (!empty($currentEdit) && !empty($currentEdit['gambar'])): ?><img class="img-preview" src="<?= htmlspecialchars($currentEdit['gambar']) ?>" alt="Preview"><?php endif; ?>
                <button class="button" type="submit"><?= $currentEdit ? 'Update' : 'Tambah' ?></button>
                <?php if ($currentEdit): ?> <a class="button" href="adminpanel.php?page=berita">Batal</a><?php endif; ?>
            </form>
        </div>

        <div class="card">
            <h2>Daftar Berita</h2>
            <table><thead><tr><th>ID</th><th>Judul</th><th>Gambar</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>
                <?php while ($row = mysqli_fetch_assoc($beritaList)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['judul']) ?></td>
                        <td><?php if ($row['gambar']): ?><img style="height:50px; max-width:100px;" src="<?= htmlspecialchars($row['gambar']) ?>"><?php endif; ?></td>
                        <td><?= $row['created_at'] ?></td>
                        <td>
                            <a class="button" href="adminpanel.php?page=berita&action=edit&id=<?= $row['id'] ?>">Edit</a>
                            <a class="button" href="adminpanel.php?page=berita&action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Hapus berita ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody></table>
        </div>
    <?php elseif ($page === 'ekstrakulikuler'): ?>
        <div class="card">
            <h2>Form Ekstrakurikuler</h2>
            <form method="post" action="adminpanel.php?page=ekstrakulikuler<?= ($action==='edit' && $id ? '&action=edit&id='.$id : '') ?>" enctype="multipart/form-data">
                <label>Nama</label><input class="input" name="nama" value="<?= htmlspecialchars($currentEdit['nama'] ?? '') ?>" required>
                <label>Deskripsi</label><textarea class="textarea" name="deskripsi" rows="4" required><?= htmlspecialchars($currentEdit['deskripsi'] ?? '') ?></textarea>
                <label>Gambar (<?= (!empty($currentEdit) && !empty($currentEdit['gambar'])) ? 'opsional' : 'wajib' ?>)
                </label><input type="file" name="gambar" accept="image/*" class="input">
                <?php if (!empty($currentEdit) && !empty($currentEdit['gambar'])): ?><img class="img-preview" src="<?= htmlspecialchars($currentEdit['gambar']) ?>" alt="Preview"><?php endif; ?>
                <button class="button" type="submit"><?= $currentEdit ? 'Update' : 'Tambah' ?></button>
                <?php if ($currentEdit): ?> <a class="button" href="adminpanel.php?page=ekstrakulikuler">Batal</a><?php endif; ?>
            </form>
        </div>

        <div class="card">
            <h2>Daftar Ekstrakurikuler</h2>
            <table><thead><tr><th>ID</th><th>Nama</th><th>Gambar</th><th>Aksi</th></tr></thead><tbody>
                <?php while ($row = mysqli_fetch_assoc($ekstraList)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?php if ($row['gambar']): ?><img style="height:50px; max-width:100px;" src="<?= htmlspecialchars($row['gambar']) ?>"><?php endif; ?></td>
                        <td>
                            <a class="button" href="adminpanel.php?page=ekstrakulikuler&action=edit&id=<?= $row['id'] ?>">Edit</a>
                            <a class="button" href="adminpanel.php?page=ekstrakulikuler&action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Hapus ekstra ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody></table>
        </div>
    <?php elseif ($page === 'galeri'): ?>
        <div class="card">
            <h2>Form Galeri</h2>
            <form method="post" action="adminpanel.php?page=galeri<?= ($action==='edit' && $id ? '&action=edit&id='.$id : '') ?>" enctype="multipart/form-data">
                <label>Judul</label><input class="input" name="judul" value="<?= htmlspecialchars($currentEdit['judul'] ?? '') ?>" required>
                <label>Deskripsi</label><textarea class="textarea" name="deskripsi" rows="3" required><?= htmlspecialchars($currentEdit['deskripsi'] ?? '') ?></textarea>
                <label>Gambar (<?= (!empty($currentEdit) && !empty($currentEdit['gambar'])) ? 'opsional' : 'wajib' ?>)</label><input type="file" name="gambar" accept="image/*" class="input">
                <?php if (!empty($currentEdit) && !empty($currentEdit['gambar'])): ?><img class="img-preview" src="<?= htmlspecialchars($currentEdit['gambar']) ?>" alt="Preview"><?php endif; ?>
                <button class="button" type="submit"><?= $currentEdit ? 'Update' : 'Tambah' ?></button>
                <?php if ($currentEdit): ?> <a class="button" href="adminpanel.php?page=galeri">Batal</a><?php endif; ?>
            </form>
        </div>

        <div class="card">
            <h2>Daftar Galeri</h2>
            <table><thead><tr><th>ID</th><th>Judul</th><th>Gambar</th><th>Aksi</th></tr></thead><tbody>
                <?php while ($row = mysqli_fetch_assoc($galeriList)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['judul']) ?></td>
                        <td><?php if ($row['gambar']): ?><img style="height:50px; max-width:100px;" src="<?= htmlspecialchars($row['gambar']) ?>"><?php endif; ?></td>
                        <td>
                            <a class="button" href="adminpanel.php?page=galeri&action=edit&id=<?= $row['id'] ?>">Edit</a>
                            <a class="button" href="adminpanel.php?page=galeri&action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Hapus galeri ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody></table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
