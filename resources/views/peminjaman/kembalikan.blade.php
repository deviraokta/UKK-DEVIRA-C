<div class="form-group">
    <label>Denda Telat</label>
    <input type="text" class="form-control"
           value="Rp {{ number_format($dendaDefault, 0, ',', '.') }}" readonly>
</div>

<div class="form-group">
    <label>Denda Hilang</label>
    <input type="text" class="form-control"
           value="Rp {{ number_format($setting->denda_hilang, 0, ',', '.') }}" readonly>
</div>