<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">
                Tambah Data Alternatif
            </h5>
            <a href="/spk-saw-supplier/alternatif" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="/spk-saw-supplier/alternatif/tambah" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <div class="form-group text-gray-900">
                        <label for="nama_supplier">Pilih Supplier</label>
                        <select id="nama_supplier" name="id_supplier" class="form-control" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php foreach ($data['supplier'] as $supplier) : ?>
                                <option value="<?= $supplier['id'] ?>"><?= $supplier['nama_supplier'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php foreach ($data['kriteria'] as $kriteria): ?>
                    <div class="form-group text-gray-900">
                        <label for="kriteria_<?= $kriteria['id'] ?>">
                            <?= htmlspecialchars($kriteria['nama_kriteria']) ?>
                        </label>
                        <select 
                            id="kriteria_<?= $kriteria['id'] ?>" 
                            name="subkriteria[<?= $kriteria['id'] ?>]" 
                            class="form-control" 
                            required
                        >
                            <option value="">-- Pilih Subkriteria --</option>
                            <?php foreach ($data['subkriteria'] as $sub): ?>
                                <?php if ($sub['id_kriteria'] == $kriteria['id']): ?>
                                    <option value="<?= $sub['id'] ?>">
                                        <?= htmlspecialchars($sub['nama_subkriteria']) ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endforeach; ?>
                    

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
