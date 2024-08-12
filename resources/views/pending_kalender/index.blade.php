@extends('kalender_beasiswa.partials.master')
@section('content')
    <!-- Content Wrapper -->
    <div class="content-wrapper">

        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Artikel Kalender Beasiswa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Artikel  Kalender Beasiswa</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- Card Header -->
                            <div class="card-header">
                                <h3 class="card-title">Artikel Kalender Beasiswa</h3>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    @php $no = 1; @endphp
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tingkat Studi</th>
                                                <th>Negara</th>
                                                <th>Tanggal Registrasi</th>
                                                <th>Deadline</th>
                                                <th>Judul</th>
                                                <th>Nama Universitas</th>
                                                <th>Deskripsi</th>
                                                <th>Jenis Beasiswa</th>
                                                <th>Keuntungan</th>
                                                <th>Umur</th>
                                                <th>GPA</th>
                                                <th>Tes English</th>
                                                <th>Tes Bahasa Lain</th>
                                                <th>Tes Standard</th>
                                                <th>Dokumen</th>
                                                <th>Lainnya</th>
                                                <th>Status Tampil</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                @if ($item->status_tampil == 0) <!-- Only display items with status_tampil = 0 -->
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>
                                                        @foreach ($item->tingkat_studi as $tingkat)
                                                            {{ $tingkat->nama }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($item->negara as $neg)
                                                            {{ $neg->nama }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_registrasi)) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item->deadline)) }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->deskripsi }}</td>
                                                    <td>{{ $item->jenis_beasiswa }}</td>
                                                    <td>{{ $item->keuntungan }}</td>
                                                    <td>{{ $item->umur }}</td>
                                                    <td>{{ $item->gpa }}</td>
                                                    <td>{{ $item->tes_english }}</td>
                                                    <td>{{ $item->tes_bahasa_lain }}</td>
                                                    <td>{{ $item->tes_standard }}</td>
                                                    <td>{{ $item->dokumen }}</td>
                                                    <td>{{ $item->lainnya }}</td>
                                                    <td>Pending</td> <!-- Show 'Pending' if status_tampil is 0 -->
                                                    <td>
                                                        <!-- Terima Proposal Button -->
                                                        <form action="{{ route('kalender_beasiswa.accept', $item->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menerima proposal ini?')">Terima Artikel</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('Berhasil'))
    Swal.fire({
        icon: 'Berhasil',
        title: 'Berhasil!',
        text: '{{ session('Berhasil') }}',
        timer: 3000,
        showConfirmButton: false
    });
    @endif
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
    });
    @endif
</script>
@endsection
