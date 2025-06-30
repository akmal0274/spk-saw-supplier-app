<?php
class Supplier extends Model {
    public function getAll() {
        $result = mysqli_query($this->conn, "SELECT * FROM supplier");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $result = mysqli_query($this->conn, "SELECT * FROM supplier WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }

    public function insert($nama) {
        $nama = mysqli_real_escape_string($this->conn, $nama);

        return mysqli_query($this->conn, "INSERT INTO supplier (nama_supplier) VALUES ('$nama')");
    }

    public function update($id, $nama) {
        $nama = mysqli_real_escape_string($this->conn, $nama);

        return mysqli_query($this->conn, "UPDATE supplier SET nama_supplier='$nama' WHERE id='$id'");
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM supplier WHERE id=$id");
    }
}
