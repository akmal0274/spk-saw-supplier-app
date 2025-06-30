<?php
class Kriteria extends Model {
    public function getAll() {
        $result = mysqli_query($this->conn, "SELECT * FROM kriteria");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $result = mysqli_query($this->conn, "SELECT * FROM kriteria WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }

    public function insert($nama, $kode, $tipe, $bobot) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $kode = mysqli_real_escape_string($this->conn, $kode);
        $tipe = mysqli_real_escape_string($this->conn, $tipe);
        $bobot = trim($bobot);

        $cekQuery = mysqli_query($this->conn, "SELECT id_kriteria FROM kriteria WHERE kode_kriteria = '$kode'");
        if (mysqli_num_rows($cekQuery) > 0) {
            return false;
        }

        if (strpos($bobot, ',') !== false) {
            $bobot = str_replace(',', '.', $bobot);
        }

        if (!is_numeric($bobot)) {
            return false;
        }
        $bobot = (float)$bobot;
        return mysqli_query($this->conn, "INSERT INTO kriteria (nama_kriteria, kode_kriteria, tipe_kriteria, bobot_kriteria) VALUES ('$nama', '$kode', '$tipe', '$bobot')");
    }

    public function update($id, $nama, $tipe, $bobot) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $tipe = mysqli_real_escape_string($this->conn, $tipe);
        $bobot = trim($bobot);
        
        if (strpos($bobot, ',') !== false) {
            $bobot = str_replace(',', '.', $bobot);
        }

        if (!is_numeric($bobot)) {
            return false;
        }
        $bobot = (float)$bobot;
        return mysqli_query($this->conn, "UPDATE kriteria SET nama_kriteria='$nama', bobot_kriteria='$bobot', tipe_kriteria='$tipe' WHERE id='$id'");
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM kriteria WHERE id=$id");
    }
}
