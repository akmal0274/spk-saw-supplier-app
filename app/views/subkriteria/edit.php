<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">
                Edit Subkriteria - <?= htmlspecialchars($data['kriteria']['nama_kriteria']) ?>
            </h5>
            <a href="/spk-saw-supplier/subkriteria" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="/spk-saw-supplier/subkriteria/edit/<?= $data['subkriteria']['id'] ?>" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-row">
                    <div class="form-group col-md-6 text-gray-900">
                        <label for="nama_subkriteria">Nama Subkriteria</label>
                        <input 
                            type="text" 
                            id="nama_subkriteria" 
                            name="nama_subkriteria" 
                            class="form-control" 
                            value="<?= htmlspecialchars($data['subkriteria']['nama_subkriteria']) ?>" 
                            required
                        >
                    </div>
                    <div class="form-group col-md-6 text-gray-900">
                        <label for="nilai_subkriteria">Nilai Subkriteria</label>
                        <select id="nilai_subkriteria" name="nilai_subkriteria" class="form-control" required>
                            <option value="">-- Pilih Nilai --</option>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <option value="<?= $i ?>" <?= $data['subkriteria']['nilai_subkriteria'] == $i ? 'selected' : '' ?>>
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
