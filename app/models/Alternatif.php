<?php
class Alternatif extends Model {
    public function getAll()
    {
        $query_supplier = mysqli_query($this->conn, "SELECT * FROM supplier");
        if (!$query_supplier) {
            echo "Query error (supplier): " . mysqli_error($this->conn);
            return [];
        }

        $suppliers = mysqli_fetch_all($query_supplier, MYSQLI_ASSOC);

        foreach ($suppliers as &$supplier) {
            $id_supplier = (int) $supplier['id'];

            $sql_nilai = "
                SELECT 
                    k.nama_kriteria, 
                    k.kode_kriteria,
                    sk.nama_subkriteria, 
                    sk.nilai_subkriteria 
                FROM nilai_alternatif na
                JOIN kriteria k ON na.id_kriteria = k.id
                JOIN subkriteria sk ON na.id_subkriteria = sk.id
                WHERE na.id_supplier = $id_supplier
            ";

            $query_nilai = mysqli_query($this->conn, $sql_nilai);

            if (!$query_nilai) {
                echo "Query error (nilai_alternatif): " . mysqli_error($this->conn) . "<br>";
                echo "SQL: " . $sql_nilai . "<br>";
                $supplier['nilai'] = [];
            } else {
                $supplier['nilai'] = mysqli_fetch_all($query_nilai, MYSQLI_ASSOC);
            }
        }

        return $suppliers;
    }

    public function insert($id_supplier, $id_kriteria, $id_subkriteria){
        $id_supplier = (int)$id_supplier;
        $id_kriteria = (int)$id_kriteria;
        $id_subkriteria = (int)$id_subkriteria;
        return mysqli_query($this->conn, "INSERT INTO nilai_alternatif (id_supplier, id_kriteria, id_subkriteria) VALUES ($id_supplier, $id_kriteria, $id_subkriteria)");
    }
}
