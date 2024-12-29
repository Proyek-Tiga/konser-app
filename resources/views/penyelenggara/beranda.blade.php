@include('structure.header')
@include('structure.navbarPenyelenggara')
<!-- gray bg -->
<section class="tm-white-bg section-padding-bottom">
    <div class="container" style="height: 600px;">
        <br><br><br>
        <h2 class="text-center"><b>BERANDA</b></h2>
        <hr>
        <h3 class="text-center"><b>Hello {{ ucwords($name) }} Selamat Datang!</b></h3>
        <h4 class="text-center">Hak akses penyelenggara adalah mengelola menu konser.</h4>

        <!-- Tambahkan tombol tambah request -->
        <div class="text-center mt-4">
            <button id="btnTambahRequest" class="btn btn-primary">Tambah Request</button>
        </div>

        <!-- Modal Tambah Request -->
        <div id="modalTambahRequest" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambahRequest">
                            <div class="form-group">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan lokasi" required>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas">Kapasitas</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Masukkan kapasitas" required>
                            </div>
                            <div class="form-group">
                                <label for="harga" class="d-flex justify-content-between align-items-center">
                                    Pilihan Tiket
                                    <button type="button" class="btn btn-success btn-sm" id="btnTambahTiket">+</button>
                                </label>
                                <div id="pilihanTiketContainer">
                                    <div class="d-flex align-items-center mb-2">
                                        <input type="text" class="form-control" name="tingkatan_tiket[]" placeholder="Masukkan tingkatan tiket" required>
                                        <input type="number" class="form-control ml-2" name="harga_tiket[]" placeholder="Masukkan harga tiket" required>
                                        <button type="button" class="btn btn-danger btn-sm ml-2 btnHapusTiket">-</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" form="formTambahRequest" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('structure.footer')

<!-- Tambahkan script untuk modal -->
<script>
    document.getElementById('btnTambahRequest').addEventListener('click', function () {
        const modal = document.getElementById('modalTambahRequest');
        modal.style.display = 'block';
    });

    document.querySelectorAll('.close, .btn-secondary').forEach(function (closeBtn) {
        closeBtn.addEventListener('click', function () {
            const modal = document.getElementById('modalTambahRequest');
            modal.style.display = 'none';
        });
    });

    document.getElementById('btnTambahTiket').addEventListener('click', function () {
        const container = document.getElementById('pilihanTiketContainer');
        const newTiket = document.createElement('div');
        newTiket.classList.add('d-flex', 'align-items-center', 'mb-2');
        newTiket.innerHTML = `
            <input type="text" class="form-control" name="tingkatan_tiket[]" placeholder="Masukkan tingkatan tiket" required>
            <input type="number" class="form-control ml-2" name="harga_tiket[]" placeholder="Masukkan harga tiket" required>
            <button type="button" class="btn btn-danger btn-sm ml-2 btnHapusTiket">-</button>
        `;
        container.appendChild(newTiket);

        newTiket.querySelector('.btnHapusTiket').addEventListener('click', function () {
            container.removeChild(newTiket);
        });
    });

    document.getElementById('formTambahRequest').addEventListener('submit', function (event) {
        event.preventDefault();
        const data = {
            lokasi: document.getElementById('lokasi').value,
            kapasitas: document.getElementById('kapasitas').value,
            tiket: Array.from(document.querySelectorAll('#pilihanTiketContainer .d-flex')).map(row => {
                return {
                    tingkatan: row.querySelector('[name="tingkatan_tiket[]"]').value,
                    harga: row.querySelector('[name="harga_tiket[]"]').value
                };
            })
        };
        console.log('Form submitted:', data);
        // Tambahkan logika untuk menyimpan data ke server di sini

        // Tutup modal setelah submit
        const modal = document.getElementById('modalTambahRequest');
        modal.style.display = 'none';
    });
</script>
