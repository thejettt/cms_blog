<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo "Session tidak ada";
    exit();
} else {
    echo "Session ada: " . $_SESSION['email'];
}
$email = $_SESSION['email'];

// Koneksi ke database
include('../includes/db.php');
$message = "";
$edit_state = false;
$category_id = 0;

// Ambil user_id dari tabel users berdasarkan email
$user_query = "SELECT id FROM users WHERE email='$email'";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);
$user_id = $user['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['save'])) {
        $category_name = $_POST['category_name'];
        $image = $_FILES['image']['name'];
        $target = __DIR__ . "/../uploads/" . basename($image);

        // Cek apakah kategori sudah ada
        $check_query = "SELECT * FROM categories WHERE name='$category_name'";
        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $message = "Kategori dengan nama yang sama sudah ada.";
        } else {
            if (!empty($category_name) && move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $query = "INSERT INTO categories (name, image, user_id) VALUES ('$category_name', '$image', '$user_id')";
                if (mysqli_query($conn, $query)) {
                    $message = "Kategori berhasil ditambahkan.";
                } else {
                    $message = "Gagal menambahkan kategori.";
                }
            } else {
                $message = "Nama kategori tidak boleh kosong dan gambar harus diupload.";
            }
        }
    } elseif (isset($_POST['update'])) {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $image = $_FILES['image']['name'];
        $target = __DIR__ . "/../uploads/" . basename($image);

        if (!empty($category_name) && (!empty($image) && move_uploaded_file($_FILES['image']['tmp_name'], $target))) {
            $query = "UPDATE categories SET name='$category_name', image='$image' WHERE id=$category_id";
            if (mysqli_query($conn, $query)) {
                $message = "Kategori berhasil diupdate.";
            } else {
                $message = "Gagal mengupdate kategori.";
            }
        } elseif (!empty($category_name)) {
            $query = "UPDATE categories SET name='$category_name' WHERE id=$category_id";
            if (mysqli_query($conn, $query)) {
                $message = "Kategori berhasil diupdate.";
            } else {
                $message = "Gagal mengupdate kategori.";
            }
        } else {
            $message = "Nama kategori tidak boleh kosong.";
        }
    }
}

if (isset($_GET['edit'])) {
    $category_id = $_GET['edit'];
    $edit_state = true;
    $rec = mysqli_query($conn, "SELECT * FROM categories WHERE id=$category_id");
    $record = mysqli_fetch_array($rec);
    $category_name = $record['name'];
    $category_image = $record['image'];
}

if (isset($_GET['del'])) {
    $category_id = $_GET['del'];
    mysqli_query($conn, "DELETE FROM categories WHERE id=$category_id");
    $message = "Kategori berhasil dihapus.";
}

// Mengambil kategori hanya milik user yang sedang login
$result = mysqli_query($conn, "SELECT * FROM categories WHERE user_id = '$user_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="images/logo.png" href="images/logo.png">
    <title>Category</title>
    <style>
        .form-container {
            background-color: #4a627a;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 40px;
        }

        .form-container h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #ffffff;
        }

        .form-container label {
            display: block;
            margin-top: 10px;
            color: #ffffff;
        }

        .form-container input, .form-container textarea, .form-container select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #27374E;
            color: #fff;
            border: none;
            border-radius: 4px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .form-container button:hover {
            background-color: #9CB2BF;
        }

        .message {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: <?php echo empty($message) ? 'none' : 'block'; ?>;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #4a627a;
            color: white;
        }

        td img {
            max-width: 100px;
            height: auto;
        }

        .btn-edit {
            background-color: #28a745;
            /* Hijau */
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
        }

        .btn-delete {
            background-color: #dc3545;
            /* Merah */
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="logo-container">
                <img src="../images/logo.png" alt="Logo" class="logo">
                <h2 class="site-title">JuaraJawara</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php"><span class="icon"><i class="fas fa-tachometer-alt"></i></span> Dashboard</a></li>
                    <li><a href="category.php" class="active"><span class="icon"><i class="fas fa-folder-plus"></i></span> Category</a></li>
                    <li><a href="article.php"><span class="icon"><i class="fas fa-file-alt"></i></span> Article</a></li>
                </ul>
            </nav>
            <div class="logout-section">
                <a href="../admin/logout.php"><span class="icon"><i class="fas fa-sign-out-alt"></i></span> Log Out</a>
                <p>Login as : <?php echo $_SESSION['email']; ?></p>
            </div>
        </div>
        <div class="admin-main">
            <h2>Category</h2>
            <p>Lorem ipsum dolor sit amet consectetur.</p>
            <div class="message"><?php echo $message; ?></div>
            <div class="form-container">
                <h2><?php echo $edit_state ? 'Edit Kategori' : 'Tambah Kategori Baru'; ?></h2>
                <form action="category.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                    <label for="category_name">Nama Kategori:</label>
                    <input type="text" id="category_name" name="category_name" value="<?php echo $edit_state ? $category_name : ''; ?>" required>
                    <label for="image">Upload Gambar:</label>
                    <input type="file" id="image" name="image" <?php echo $edit_state ? '' : 'required'; ?>>
                    <button type="submit" name="<?php echo $edit_state ? 'update' : 'save'; ?>"><?php echo $edit_state ? 'Update' : 'Tambah'; ?> Kategori</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><img src="../uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>"></td>
                            <td>
                                <div class="actions">
                                    <a href="category.php?edit=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="category.php?del=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Hapus</a>
                                </div>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
