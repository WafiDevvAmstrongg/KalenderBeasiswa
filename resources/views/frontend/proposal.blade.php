@extends('frontend.partials.master')

@section('content')
<br>
<br>
<br>

<!-- Form to Create a New Scholarship Calendar Proposal -->
<div class="container mt-20">
    <section class="proposal">
        <form id="proposal-form" action="{{ route('proposal.store') }}" method="post">
            @csrf

            <!-- Kategori Section -->
            <div class="form-section mb-4">
                <h1 class="mb-5"><b>Kategori</b></h1>

                <!-- Negara Select -->
                <div class="form-group mb-4">
                    <label for="option_negara" class="mb-2">Negara</label>
                    <select class="form-control" name="id_negara[]" id="option_negara" multiple required>
                        @foreach ($negara as $i)
                            <option value="{{ $i->id }}">{{ $i->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tingkat Studi Select -->
                <div class="form-group mb-5">
                    <label for="option_tingkat_studi" class="mb-2">Tingkat Studi</label>
                    <select class="form-control" name="id_tingkat_studi[]" id="option_tingkat_studi" multiple required>
                        @foreach ($tingkat_studi as $i)
                            <option value="{{ $i->id }}">{{ $i->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tentang Section -->
            <div class="form-section mb-5 mt-5">
                <h1 class="mt-5"><b>Tentang</b></h1>

                <!-- Form Fields -->
                <div class="form-group mb-4 mt-5">
                    <label for="tanggal_registrasi" class="mb-2">Tanggal Registrasi</label>
                    <input type="date" class="form-control" name="tanggal_registrasi" id="tanggal_registrasi" required>
                </div>

                <div class="form-group mb-4">
                    <label for="deadline" class="mb-2">Deadline</label>
                    <input type="date" class="form-control" name="deadline" id="deadline" required>
                </div>

                <div class="form-group mb-4">
                    <label for="judul" class="mb-2">Judul</label>
                    <input type="text" class="form-control" name="judul" id="judul" required>
                </div>

                <div class="form-group mb-4">
                    <label for="nama" class="mb-2">Nama Universitas</label>
                    <input type="text" class="form-control" name="nama" id="nama" required>
                </div>

                <div class="form-group mb-4">
                    <label for="deskripsi" class="mb-2">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi" cols="15" rows="10" required></textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="jurusan" class="mb-2">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" id="jurusan" required>
                </div>

                <div class="form-group mb-4">
                    <label for="jenis_beasiswa" class="mb-2">Jenis Beasiswa</label>
                    <select name="jenis_beasiswa" class="form-control" id="jenis_beasiswa" required>
                        <option value="">Pilih Jenis Beasiswa</option>
                        <option value="full">Full</option>
                        <option value="partial">Partial</option>
                    </select>
                </div>
            </div>

            <!-- Keuntungan Section -->
            <div class="form-section mb-4">
                <h1>Keuntungan</h1>
                <div class="form-group">
                    <label for="keuntungan">Keuntungan</label>
                    <textarea name="keuntungan" class="form-control" id="keuntungan" cols="15" rows="10" required></textarea>
                </div>
            </div>

            <!-- Persyaratan Section -->
            <div class="form-section mb-4">
                <h1>Persyaratan</h1>

                <!-- Persyaratan Fields -->
                <div class="form-group">
                    <label for="umur">Umur</label>
                    <input type="text" class="form-control" name="umur" id="umur" required>
                </div>

                <div class="form-group">
                    <label for="gpa">GPA</label>
                    <input type="text" class="form-control" name="gpa" id="gpa" required>
                </div>

                <div class="form-group">
                    <label for="tes_english">Tes English</label>
                    <input type="text" class="form-control" name="tes_english" id="tes_english" required>
                </div>

                <div class="form-group">
                    <label for="tes_bahasa_lain">Tes Bahasa Lain</label>
                    <input type="text" class="form-control" name="tes_bahasa_lain" id="tes_bahasa_lain" required>
                </div>

                <div class="form-group">
                    <label for="tes_standard">Tes Standard</label>
                    <input type="text" class="form-control" name="tes_standard" id="tes_standard" required>
                </div>

                <div class="form-group">
                    <label for="dokumen">Dokumen</label>
                    <input type="text" class="form-control" name="dokumen" id="dokumen" required>
                </div>

                <div class="form-group">
                    <label for="lainnya">Lainnya</label>
                    <input type="text" class="form-control" name="lainnya" id="lainnya" required>
                </div>

                <input type="hidden" name="status_tampil" value="0">
            </div>

            <!-- Submit Button -->
            <div class="form-footer mt-4">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </section>
</div>

<!-- JavaScript for Multi-Select -->
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new MultiSelectTag('option_negara'); // id
        new MultiSelectTag('option_tingkat_studi'); // id
    });

    document.getElementById('proposal-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        Swal.fire({
            title: 'Success!',
            text: 'Your scholarship proposal has been submitted successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form programmatically
                event.target.submit();
            }
        });
    });
</script>

@endsection
