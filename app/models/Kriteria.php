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

        // Cek kode duplikat
        $cekQuery = mysqli_query($this->conn, "SELECT id FROM kriteria WHERE kode_kriteria = '$kode'");
        if (mysqli_num_rows($cekQuery) > 0) {
            return ['status' => false, 'message' => 'Kode kriteria sudah ada'];
        }

        // Ubah koma menjadi titik
        if (strpos($bobot, ',') !== false) {
            $bobot = str_replace(',', '.', $bobot);
        }

        // Validasi numeric
        if (!is_numeric($bobot)) {
            return ['status' => false, 'message' => 'Bobot harus berupa angka'];
        }
        $bobot = (float)$bobot;

        // Cek total bobot
        $totalQuery = mysqli_query($this->conn, "SELECT COALESCE(SUM(bobot_kriteria),0) as total FROM kriteria");
        $row = mysqli_fetch_assoc($totalQuery);
        $totalBobot = (float)$row['total'];

        if ($totalBobot + $bobot > 1) {
            return ['status' => false, 'message' => 'Gagal menambahkan kriteria! Total bobot melebihi 1'];
        }

        // Insert data
        $insert = mysqli_query(
            $this->conn,
            "INSERT INTO kriteria (nama_kriteria, kode_kriteria, tipe_kriteria, bobot_kriteria) 
            VALUES ('$nama', '$kode', '$tipe', '$bobot')"
        );

        if ($insert) {
            return ['status' => true, 'message' => 'Data berhasil ditambahkan'];
        } else {
            return ['status' => false, 'message' => 'Gagal menyimpan data'];
        }
    }


    public function update($id, $nama, $tipe, $bobot) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $tipe = mysqli_real_escape_string($this->conn, $tipe);
        $bobot = trim($bobot);

        // Ubah koma jadi titik
        if (strpos($bobot, ',') !== false) {
            $bobot = str_replace(',', '.', $bobot);
        }

        // Validasi numeric
        if (!is_numeric($bobot)) {
            return ['status' => false, 'message' => 'Bobot harus berupa angka'];
        }
        $bobot = (float)$bobot;

        // Cek total bobot (kecuali id yang sedang diupdate)
        $totalQuery = mysqli_query(
            $this->conn,
            "SELECT COALESCE(SUM(bobot_kriteria),0) as total 
            FROM kriteria 
            WHERE id != '$id'"
        );
        $row = mysqli_fetch_assoc($totalQuery);
        $totalBobot = (float)$row['total'];

        if ($totalBobot + $bobot > 1) {
            return ['status' => false, 'message' => 'Gagal memperbarui data! Total bobot melebihi 1'];
        }

        // Update data
        $update = mysqli_query(
            $this->conn,
            "UPDATE kriteria 
            SET nama_kriteria='$nama', 
                tipe_kriteria='$tipe', 
                bobot_kriteria='$bobot' 
            WHERE id='$id'"
        );

        if ($update) {
            return ['status' => true, 'message' => 'Data berhasil diperbarui'];
        } else {
            return ['status' => false, 'message' => 'Gagal memperbarui data'];
        }
    }


    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM kriteria WHERE id=$id");
    }
}
