<?php if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
require_once("db_connect.php");
require_once(__DIR__ . "/../models/sql.php");
require_once("functions.php");

$messageTypes = ["success", "info", "warning", "danger", "dark"];

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/tugas/si_inventaris_sekolah/";
$name_website = "SI Inventaris Sekolah";

$select_auth = "SELECT * FROM auth";
$views_auth = mysqli_query($conn, $select_auth);

$tentang = "SELECT * FROM tentang";
$views_tentang = mysqli_query($conn, $tentang);
$kontak = "SELECT * FROM kontak ORDER BY id_kontak DESC";
$views_kontak = mysqli_query($conn, $kontak);
if (isset($_POST["add_kontak"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (kontak($conn, $validated_post, $action = 'insert', $_POST['pesan']) > 0) {
    $message = "Pesan anda berhasil dikirim.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: kontak");
    exit();
  }
}

if (!isset($_SESSION["project_si_inventaris_sekolah"]["users"])) {
  if (isset($_SESSION["project_si_inventaris_sekolah"]["time_message"]) && (time() - $_SESSION["project_si_inventaris_sekolah"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_si_inventaris_sekolah"]["message_$type"])) {
        unset($_SESSION["project_si_inventaris_sekolah"]["message_$type"]);
      }
    }
    unset($_SESSION["project_si_inventaris_sekolah"]["time_message"]);
  }
  if (isset($_POST["register"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (register($conn, $validated_post, $action = 'insert') > 0) {
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["re_verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (re_verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kode token yang baru telah dikirim ke email anda.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akun anda berhasil di verifikasi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["forgot_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (forgot_password($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Kami telah mengirim link ke email anda untuk melakukan reset kata sandi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["new_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (new_password($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kata sandi anda telah berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["login"])) {
    if (login($conn, $_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION["project_si_inventaris_sekolah"]["users"])) {
  $id_user = valid($conn, $_SESSION["project_si_inventaris_sekolah"]["users"]["id"]);
  $id_role = valid($conn, $_SESSION["project_si_inventaris_sekolah"]["users"]["id_role"]);
  $role = valid($conn, $_SESSION["project_si_inventaris_sekolah"]["users"]["role"]);
  $email = valid($conn, $_SESSION["project_si_inventaris_sekolah"]["users"]["email"]);
  $name = valid($conn, $_SESSION["project_si_inventaris_sekolah"]["users"]["name"]);
  if (isset($_SESSION["project_si_inventaris_sekolah"]["users"]["time_message"]) && (time() - $_SESSION["project_si_inventaris_sekolah"]["users"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_si_inventaris_sekolah"]["users"]["message_$type"])) {
        unset($_SESSION["project_si_inventaris_sekolah"]["users"]["message_$type"]);
      }
    }
    unset($_SESSION["project_si_inventaris_sekolah"]["users"]["time_message"]);
  }
  $select_profile = "SELECT users.*, user_role.role, user_status.status 
                      FROM users
                      JOIN user_role ON users.id_role=user_role.id_role 
                      JOIN user_status ON users.id_active=user_status.id_status 
                      WHERE users.id_user='$id_user'
                    ";
  $view_profile = mysqli_query($conn, $select_profile);
  if (isset($_POST["edit_profil"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (profil($conn, $validated_post, $action = 'update', $id_user) > 0) {
      $message = "Profil Anda berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: profil");
      exit();
    }
  }
  if (isset($_POST["setting"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (setting($conn, $validated_post, $action = 'update') > 0) {
      $message = "Setting pada system login berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: setting");
      exit();
    }
  }

  $select_users = "SELECT users.*, user_role.role, user_status.status 
                    FROM users
                    JOIN user_role ON users.id_role=user_role.id_role 
                    JOIN user_status ON users.id_active=user_status.id_status
                  ";
  $views_users = mysqli_query($conn, $select_users);
  $select_user_role = "SELECT * FROM user_role";
  $views_user_role = mysqli_query($conn, $select_user_role);
  if (isset($_POST["edit_users"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (users($conn, $validated_post, $action = 'update') > 0) {
      $message = "data users berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: users");
      exit();
    }
  }
  if (isset($_POST["add_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Role baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: role");
      exit();
    }
  }
  if (isset($_POST["edit_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'update') > 0) {
      $message = "Role " . $_POST['roleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: role");
      exit();
    }
  }
  if (isset($_POST["delete_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Role " . $_POST['role'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: role");
      exit();
    }
  }

  $select_menu = "SELECT * 
                    FROM user_menu 
                    ORDER BY menu ASC
                  ";
  $views_menu = mysqli_query($conn, $select_menu);
  if (isset($_POST["add_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu");
      exit();
    }
  }
  if (isset($_POST["edit_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'update') > 0) {
      $message = "Menu " . $_POST['menuOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu");
      exit();
    }
  }
  if (isset($_POST["delete_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu");
      exit();
    }
  }

  $select_sub_menu = "SELECT user_sub_menu.*, user_menu.menu, user_status.status 
                        FROM user_sub_menu 
                        JOIN user_menu ON user_sub_menu.id_menu=user_menu.id_menu 
                        JOIN user_status ON user_sub_menu.id_active=user_status.id_status 
                        ORDER BY user_sub_menu.title ASC
                      ";
  $views_sub_menu = mysqli_query($conn, $select_sub_menu);
  $select_user_status = "SELECT * 
                          FROM user_status
                        ";
  $views_user_status = mysqli_query($conn, $select_user_status);
  if (isset($_POST["add_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'insert', $baseURL) > 0) {
      $message = "Sub Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['titleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'delete', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu");
      exit();
    }
  }

  $select_user_access_menu = "SELECT user_access_menu.*, user_role.role, user_menu.menu
                                FROM user_access_menu 
                                JOIN user_role ON user_access_menu.id_role=.user_role.id_role 
                                JOIN user_menu ON user_access_menu.id_menu=user_menu.id_menu
                              ";
  $views_user_access_menu = mysqli_query($conn, $select_user_access_menu);
  $select_menu_check = "SELECT user_menu.* 
                    FROM user_menu 
                    ORDER BY user_menu.menu ASC
                  ";
  $views_menu_check = mysqli_query($conn, $select_menu_check);
  if (isset($_POST["add_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu-access");
      exit();
    }
  }
  if (isset($_POST["edit_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu-access");
      exit();
    }
  }
  if (isset($_POST["delete_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu-access");
      exit();
    }
  }

  $select_user_access_sub_menu = "SELECT user_access_sub_menu.*, user_role.role, user_sub_menu.title
                                FROM user_access_sub_menu 
                                JOIN user_role ON user_access_sub_menu.id_role=.user_role.id_role 
                                JOIN user_sub_menu ON user_access_sub_menu.id_sub_menu=user_sub_menu.id_sub_menu
                              ";
  $views_user_access_sub_menu = mysqli_query($conn, $select_user_access_sub_menu);
  $select_sub_menu_check = "SELECT user_sub_menu.*, user_menu.menu
                              FROM user_sub_menu 
                              JOIN user_menu ON user_sub_menu.id_menu=user_menu.id_menu
                              ORDER BY user_menu.menu ASC
                            ";
  $views_sub_menu_check = mysqli_query($conn, $select_sub_menu_check);
  if (isset($_POST["add_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke sub menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu-access");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu-access");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu-access");
      exit();
    }
  }

  $barang_kategori = "SELECT * FROM barang_kategori";
  $views_barang_kategori = mysqli_query($conn, $barang_kategori);
  if (isset($_POST["add_barang_kategori"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_kategori($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Kategori barang KIB berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kategori-kib");
      exit();
    }
  }
  if (isset($_POST["edit_barang_kategori"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_kategori($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kategori barang KIB berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kategori-kib");
      exit();
    }
  }
  if (isset($_POST["delete_barang_kategori"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_kategori($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Kategori barang KIB berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kategori-kib");
      exit();
    }
  }

  $barang_kib = "SELECT barang_kib.*, users.name, barang_kategori.nama_kategori FROM barang_kib JOIN users ON barang_kib.id_user=users.id_user JOIN barang_kategori ON barang_kib.id_barang_kategori=barang_kategori.id_barang_kategori";
  $views_barang_kib = mysqli_query($conn, $barang_kib);
  if (isset($_POST["add_barang_kib"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_kib($conn, $validated_post, $action = 'insert', $id_user) > 0) {
      $message = "Barang KIB berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-kib");
      exit();
    }
  }
  if (isset($_POST["edit_barang_kib"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_kib($conn, $validated_post, $action = 'update', $id_user) > 0) {
      $message = "Barang KIB berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-kib");
      exit();
    }
  }
  if (isset($_POST["delete_barang_kib"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_kib($conn, $validated_post, $action = 'delete', $id_user) > 0) {
      $message = "Barang KIB berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-kib");
      exit();
    }
  }

  $barang_masuk = "SELECT barang_masuk.*, barang_kib.tahun_perolehan, barang_kategori.nama_kategori FROM barang_masuk JOIN barang_kib ON barang_masuk.id_barang_kib=barang_kib.id_barang_kib JOIN barang_kategori ON barang_kib.id_barang_kategori=barang_kategori.id_barang_kategori";
  $views_barang_masuk = mysqli_query($conn, $barang_masuk);
  if (isset($_POST["add_barang_masuk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_masuk($conn, $validated_post, $action = 'insert', $_POST['keterangan']) > 0) {
      $message = "Barang masuk berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-masuk");
      exit();
    }
  }
  if (isset($_POST["edit_barang_masuk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_masuk($conn, $validated_post, $action = 'update', $_POST['keterangan']) > 0) {
      $message = "Barang masuk berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-masuk");
      exit();
    }
  }
  if (isset($_POST["delete_barang_masuk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_masuk($conn, $validated_post, $action = 'delete', $_POST['keterangan']) > 0) {
      $message = "Barang masuk berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-masuk");
      exit();
    }
  }

  $barang_keluar = "SELECT barang_keluar.*, barang_kategori.nama_kategori, status_barang_keluar.status_bk FROM barang_keluar JOIN barang_kib ON barang_keluar.id_barang_kib=barang_kib.id_barang_kib JOIN barang_kategori ON barang_kib.id_barang_kategori=barang_kategori.id_barang_kategori JOIN status_barang_keluar ON barang_keluar.id_status_bk=status_barang_keluar.id_status_bk";
  $views_barang_keluar = mysqli_query($conn, $barang_keluar);
  $status_barang_keluar = "SELECT * FROM status_barang_keluar WHERE id_status_bk!=1";
  $views_status_bk = mysqli_query($conn, $status_barang_keluar);
  if (isset($_POST["add_barang_keluar"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_keluar($conn, $validated_post, $action = 'insert', $_POST['keterangan']) > 0) {
      $message = "Barang keluar berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-keluar");
      exit();
    }
  }
  if (isset($_POST["ubah_status_barang_keluar"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_keluar($conn, $validated_post, $action = 'update_status', $keterangan = '') > 0) {
      $message = "Status barang keluar berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-keluar");
      exit();
    }
  }
  if (isset($_POST["edit_barang_keluar"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_keluar($conn, $validated_post, $action = 'update', $_POST['keterangan']) > 0) {
      $message = "Barang keluar berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-keluar");
      exit();
    }
  }
  if (isset($_POST["delete_barang_keluar"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (barang_keluar($conn, $validated_post, $action = 'delete', $_POST['keterangan']) > 0) {
      $message = "Barang keluar berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: barang-keluar");
      exit();
    }
  }

  if (isset($_POST["edit_tentang"])) {
    if (tentang($conn, $_POST, $action = 'update') > 0) {
      $message = "Deskripsi tentang berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tentang");
      exit();
    }
  }

  if (isset($_POST["delete_kontak"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kontak($conn, $validated_post, $action = 'delete', $_POST['pesan']) > 0) {
      $message = "Pesan berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kontak");
      exit();
    }
  }

  $select_barang_kib = "SELECT barang_kib.*, users.name, barang_kategori.nama_kategori FROM barang_kib JOIN users ON barang_kib.id_user=users.id_user JOIN barang_kategori ON barang_kib.id_barang_kategori=barang_kategori.id_barang_kategori WHERE barang_kib.stok_barang!='0'";
  $views_select_barang_kib = mysqli_query($conn, $select_barang_kib);
}
