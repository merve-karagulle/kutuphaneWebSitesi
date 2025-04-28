<?php
$conn = new mysqli('localhost', '', '', 'u2077168_kutuphane');
mysqli_set_charset($conn, "utf8mb4");
$sql = "SELECT * FROM kullanıcı_bilgi_tablosu ORDER BY kullanıcı_id ASC";
$result = mysqli_query($conn, $sql); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $kullanıcı_id = $_POST['kullanıcı_id'];
    $kullanıcı_adı = $_POST['kullanıcı_adı'];
    $soyadı = $_POST['soyadı'];
    $email = $_POST['email'];
    $telefon_numarası = $_POST['telefon_numarası'];
    $doğum_tarihi = $_POST['doğum_tarihi'];
    $kullanıcı_tipi = $_POST['kullanıcı_tipi'];
    $aktiflik_durumu = ($_POST['aktiflik_durumu'])? 1: 0;
    $kayıt_tarihi = $_POST['kayıt_tarihi'];

    $insert_sql = "INSERT INTO kullanıcı_bilgi_tablosu (kullanıcı_id,kullanıcı_adı, soyadı, email, telefon_numarası, doğum_tarihi, kullanıcı_tipi, kayıt_tarihi, aktiflik_durumu) 
                   VALUES ('$kullanıcı_id','$kullanıcı_adı', '$soyadı', '$email', '$telefon_numarası', '$doğum_tarihi', '$kullanıcı_tipi', '$kayıt_tarihi', '$aktiflik_durumu')";
    if (mysqli_query($conn, $insert_sql)) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_user'])) {
    $kullanıcı_id = $_GET['delete_user'];

    $delete_sql = "DELETE FROM kullanıcı_bilgi_tablosu WHERE kullanıcı_id = $kullanıcı_id";
    if (mysqli_query($conn, $delete_sql)) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } 
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    $kullanıcı_id = $_POST['kullanıcı_id'];
    $kullanıcı_adı = $_POST['kullanıcı_adı'];
    $soyadı = $_POST['soyadı'];
    $email = $_POST['email'];
    $telefon_numarası = $_POST['telefon_numarası'];
    $doğum_tarihi = $_POST['doğum_tarihi'];
    $kullanıcı_tipi = $_POST['kullanıcı_tipi'];
    $kayıt_tarihi = $_POST['kayıt_tarihi'];
    $aktiflik_durumu = $_POST['aktiflik_durumu'];

    $update_sql = "UPDATE kullanıcı_bilgi_tablosu SET 
                    kullanıcı_adı='$kullanıcı_adı', soyadı='$soyadı', email='$email', telefon_numarası='$telefon_numarası', 
                    doğum_tarihi='$doğum_tarihi', kullanıcı_tipi='$kullanıcı_tipi', kayıt_tarihi='$kayıt_tarihi', aktiflik_durumu='$aktiflik_durumu'
                    WHERE kullanıcı_id='$kullanıcı_id'";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } 
}

$kullanıcı_to_update = null;
if (isset($_GET['update_user'])) {
    $kullanıcı_id = $_GET['update_user'];
    $select_sql = "SELECT * FROM kullanıcı_bilgi_tablosu WHERE kullanıcı_id = $kullanıcı_id";
    $kullanıcı_to_update = $conn->query($select_sql)->fetch_assoc();
    /* bu sorguyu $result = mysqli_query($conn, $select_sql);
$kullanıcı_to_update = mysqli_fetch_assoc($result); şeklinde de yazabiliriz*/
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcılar Tablosu</title>
    <style>

        body {
            font-family: Arial;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            height: auto;
            min-height: 100vh;
        }

        table {
            width: 90%;
            max-width: 1200px;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
        }

        td {
            background-color: #fff;
            font-size: 14px;
            color: #333;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) td {
            background-color: #e8f5e9;
        }

        tr:hover td {
            background-color: #d7ffd6;
        }

        caption {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        button, a.button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 12px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            text-decoration: none;
            display: inline-block;
            width: 100%;
        }

        button:hover, a.button:hover {
            background-color: #45a049;
        }

        .delete-button {
            background-color: #FF6347;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            border: 2px solid #FF6347;
            width: 48%;
            display: inline-block;
            margin-bottom: 5px;
        }

        .delete-button:hover {
            background-color: #FF4500;
            border-color: #FF4500;
        }

        .update-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            border: 2px solid #4CAF50;
            width: 48%;
            display: inline-block;
            margin-bottom: 5px;
        }

        .update-button:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .guncelle-button{
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            border: 2px solid #4CAF50;
            width: 45%;
            display: inline-block;
            margin-bottom: 5px;
        }
        .guncelle-button:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .close-button {
            background-color: #FF6347;
            color: white;
            padding: 12px 12px;
            text-decoration: none;
            border: 2px solid black;
            border-radius: 5px;
            font-size: 18px;
            display: inline-block;
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }

        .close-button:hover {
            background-color: #FF4500;
            border:2px solid black;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin-top: 20px;
        }

        form input[type="text"], form input[type="number"] {
            width: 98%;
            padding: 10px;
            height:15px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
        }

        .form-buttons button, .form-buttons a {
            flex: 1;
            margin: 0 5px;
        }

        button[type="submit"] {
            font-size: 18px;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

      
        .peru-button {
            background-color: #CD853F; /* Peru rengi */
            color: white;
            padding: 12px 12px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            text-decoration: none;
            display: inline-block;
            width: 100%;
        }

        .peru-button:hover {
            background-color: #D2691E; 
        }
        .date{
            width: 98%;
            height:14px;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .select{
            width: 102%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            height:36px;
            border-radius: 4px;
        }

    </style>
</head>
<body>
    <form method="get" action="tablosecim.php">
        <button type="submit" class="peru-button">Tablo Seçim Sayfasına Git</button>
    </form>
    <form method="get" action="">
        <button type="submit" name="show_add_form" value="1">Kullanıcı Ekle</button>
    </form>
<?php
if (isset($_GET['show_add_form']) && $_GET['show_add_form'] == 1) {
    echo '
    <div class="form-container" id="form-container">
        <h3 style="text-align:center;">Kullanıcı Ekle</h3>
        <form method="post">
            <input type="hidden" id="kullanıcı_id" name="kullanıcı_id" required>

            <div>
                <label for="kullanıcı_adı">Kullanıcı Adı:</label>
                <input type="text" name="kullanıcı_adı" id="kullanıcı_adı" placeholder="User Name" required>
            </div>

            <div>
                <label for="soyadı">Soyadı:</label>
                <input type="text" name="soyadı" id="soyadı" placeholder="Surname" required>
            </div>

            <div>
                <label for="text">E-Posta:</label>
                <input type="text" name="email" id="email" placeholder="example@gmail.com" required>
            </div>

            <div>
                <label for="telefon_numarası">Telefon Numarası:</label>
                <input type="text" name="telefon_numarası" id="telefon_numarası" placeholder="5054440044" required>
            </div>

            <div>
                <label for="doğum_tarihi">Doğum Tarihi:</label>
                <input type="date" class="date" name="doğum_tarihi" id="doğum_tarihi" placeholder="Doğum Tarihi" required>
            </div>

            <div>
                <label for="kullanıcı_tipi">Kullanıcı Tipi:</label>
                <select name="kullanıcı_tipi" id="kullanıcı_tipi" class="select" required>
                    <option value="Admin">Admin</option>
                    <option value="Normal">Normal</option>
                    <option value="Misafir">Misafir</option>
                </select>
            </div>

            <div>
                <label for="aktiflik_durumu">Aktiflik Durumu:</label>
                <select name="aktiflik_durumu" id="aktiflik_durumu" class="select" required>
                   <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                </select>
            </div>

            <div>
                <label for="kayıt_tarihi">Kayıt Tarihi:</label>
                <input type="date" class="date" name="kayıt_tarihi" id="kayıt_tarihi" placeholder="Kayıt Tarihi" required>
            </div>

            <div class="form-buttons">
                <button type="submit" name="add_user">Kullanıcı Ekle</button>
                <a href="?show_add_form=0" class="close-button">Kapat</a>
            </div>
        </form>
    </div>';
}
?>

    
<?php
if ($kullanıcı_to_update) {
    echo '
    <div class="form-container">
        <h3>Kullanıcı Güncelle</h3>
        <form method="post" action="">
            <input type="hidden" name="kullanıcı_id" value="'.$kullanıcı_to_update['kullanıcı_id'].'">
            
            <div>
                <label for="kullanıcı_adı">Kullanıcı Adı:</label>
                <input type="text" name="kullanıcı_adı" id="kullanıcı_adı" value="'.$kullanıcı_to_update['kullanıcı_adı'].'" placeholder="Kullanıcı Adı" required>
            </div>
            
            <div>
                <label for="soyadı">Soyadı:</label>
                <input type="text" name="soyadı" id="soyadı" value="'.$kullanıcı_to_update['soyadı'].'" placeholder="Soyadı" required>
            </div>
            
            <div>
                <label for="text">E-Posta:</label>
                <input type="text" name="email" id="email" value="'.$kullanıcı_to_update['email'].'" placeholder="Email ornegın@gmail.com" required>
            </div>
            
            <div>
                <label for="telefon_numarası">Telefon Numarası:</label>
                <input type="text" name="telefon_numarası" id="telefon_numarası" value="'.$kullanıcı_to_update['telefon_numarası'].'" placeholder="Telefon Numaranız" required>
            </div>
            
            <div>
                <label for="doğum_tarihi">Doğum Tarihi:</label>
                <input type="date" class="date" name="doğum_tarihi" id="doğum_tarihi" value="'.$kullanıcı_to_update['doğum_tarihi'].'" placeholder="Doğum Tarihiniz" required>
            </div>
            
            <div>
                <label for="kullanıcı_tipi">Kullanıcı Tipi:</label>
              <select name="kullanıcı_tipi" id="kullanıcı_tipi" class="select" required>
            <option value="Admin" '.($kullanıcı_to_update['kullanıcı_tipi'] == 'Admin' ? 'selected' : '').'>Admin</option>
         <option value="Normal" '.($kullanıcı_to_update['kullanıcı_tipi'] == 'Normal' ? 'selected' : '').'>Normal</option>
         <option value="Misafir" '.($kullanıcı_to_update['kullanıcı_tipi'] == 'Misafir' ? 'selected' : '').'>Misafir</option>
              </select>
             </div>
            
            <div>
                <label for="aktiflik_durumu">Aktiflik Durumu:</label>
                <select name="aktiflik_durumu" id="aktiflik_durumu" class="select" required>
                    <option value="1" '.($kullanıcı_to_update['aktiflik_durumu'] == '1' ? 'selected' : '').'>Aktif</option>
                    <option value="0" '.($kullanıcı_to_update['aktiflik_durumu'] == '0' ? 'selected' : '').'>Pasif</option>
                </select>
            </div>
            
            <div>
                <label for="kayıt_tarihi">Kayıt Tarihi:</label>
                <input type="date"  class="date" name="kayıt_tarihi" id="kayıt_tarihi" value="'.$kullanıcı_to_update['kayıt_tarihi'].'" placeholder="Kayıt Tarihiniz" required>
            </div>

            <div class="form-buttons">
                <button type="submit" name="update_user" class=guncelle-button">Güncelle</button>
                <a href="?" class="close-button">İptal</a>
            </div>
        </form>
    </div>';
}
?>
    <table>
        <caption>Kullanıcılar</caption>
        <thead>
            <tr>
                <th>Kullanıcı ID</th>
                <th>Kullanıcı Adı</th>
                <th>Soyadı</th>
                <th>Email</th>
                <th>Telefon Numarası</th>
                <th>Doğum Tarihi</th>
                <th>Kullanıcı Tipi</th>
                <th>Aktiflik Durumu</th>
                <th>Kayıt Tarihi</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                // Satırları döngü ile listele
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["kullanıcı_id"] . "</td>";
                    echo "<td>" . $row["kullanıcı_adı"] . "</td>";
                    echo "<td>" . $row["soyadı"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["telefon_numarası"] . "</td>";
                    echo "<td>" . $row["doğum_tarihi"] . "</td>";
                    echo "<td>" . $row["kullanıcı_tipi"] . "</td>";
                    echo "<td>" . ($row["aktiflik_durumu"] == 1 ? "Aktif" : "Pasif") . "</td>";
                    echo "<td>" . $row["kayıt_tarihi"] . "</td>";
                    echo "<td>
                            <a href='?update_user=" . $row["kullanıcı_id"] . "' class='update-button'>Güncelle</a>
                            <a href='?delete_user=" . $row["kullanıcı_id"] . "' class='delete-button'>Sil</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Kayıt bulunamadı</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
