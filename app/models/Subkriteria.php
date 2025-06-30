<?php
class Subkriteria extends Model {
    public function getAll() {
        $result = mysqli_query($this->conn, "SELECT * FROM subkriteria");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $result = mysqli_query($this->conn, "SELECT * FROM subkriteria WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }

    public function insert($nama, $nilai, $id_kriteria) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $nilai = (int)$nilai;

        return mysqli_query($this->conn, "INSERT INTO subkriteria (nama_subkriteria, nilai_subkriteria, id_kriteria) VALUES ('$nama', '$nilai', '$id_kriteria')");
    }

    public function update($id, $nama, $nilai) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $nilai = (int)$nilai;

        return mysqli_query($this->conn, "UPDATE subkriteria SET nama_subkriteria='$nama', nilai_subkriteria='$nilai' WHERE id='$id'");
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM subkriteria WHERE id=$id");
    }
}
