<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Tambah Kriteria</h5>
            <a href="/spk-saw-supplier/kriteria" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="/spk-saw-supplier/kriteria/tambah" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-row">
                    <div class="form-group col-md-6 text-gray-900">
                        <label for="kode_kriteria">Kode Kriteria</label>
                        <input type="text" id="kode_kriteria" name="kode_kriteria" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 text-gray-900">
                        <label for="nama_kriteria">Nama Kriteria</label>
                        <input type="text" id="nama_kriteria" name="nama_kriteria" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 text-gray-900">
                        <label for="tipe_kriteria">Tipe Kriteria</label>
                        <select id="tipe_kriteria" name="tipe_kriteria" class="form-control" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 text-gray-900">
                        <label for="bobot_kriteria">Bobot Kriteria</label>
                        <input type="text" id="bobot_kriteria" name="bobot_kriteria" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
