@extends('frontend.partials.master')

@section('content')
@if (session('message') == 'No articles found')
<script>
    window.onload = function() {
        document.querySelector('#Kalender').scrollIntoView();
    };
</script>
@endif

<style>
    /* Set font to Arial */
    body {
        font-family: Arial, sans-serif;
    }

    .bg-gray {
        background-color: #ededed;
    }
    .badge {
        margin-right: 0.5rem;
    }
</style>

<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="header mb-4">
                <h2>Filter Beasiswa</h2>
            </div>
            <form id="filterForm" method="get" action="{{ route('beasiswa.filter') }}">
                <!-- Tingkat Studi Filter -->
                <div class="form-group mt-4">
                    <label for="option_tingkat_studi">Tingkat Studi</label>
                    <select class="form-control multi-select" name="id_tingkat_studi[]" id="option_tingkat_studi" multiple>
                        @foreach ($tingkat_studi as $i)
                            <option value="{{ $i->id }}" {{ in_array($i->id, request('id_tingkat_studi', [])) ? 'selected' : '' }}>
                                {{ $i->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jenis Beasiswa Filter -->
                <div class="form-group mt-4">
                    <label for="option_jenis_beasiswa">Jenis Beasiswa</label>
                    <select class="form-control multi-select" name="jenis_beasiswa[]" id="option_jenis_beasiswa" multiple>
                        <option value="Partial" {{ in_array('Partial', request('jenis_beasiswa', [])) ? 'selected' : '' }}>Partial</option>
                        <option value="Full" {{ in_array('Full', request('jenis_beasiswa', [])) ? 'selected' : '' }}>Full</option>
                    </select>
                </div>

                <!-- Negara Filter -->
                <div class="form-group mt-4">
                    <label for="option_negara">Negara</label>
                    <select class="form-control multi-select" name="id_negara[]" id="option_negara" multiple>
                        @foreach ($negara as $i)
                            <option value="{{ $i->id }}" {{ in_array($i->id, request('id_negara', [])) ? 'selected' : '' }}>
                                {{ $i->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
                <a href="{{ route('kalender') }}" class="btn btn-warning mt-3">Reset Filters</a>
            </form>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9" id="KalenderBeasiswa">
            <section class="content">
                <div class="header d-flex justify-content-end mb-3">
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="form-group">
                            <label for="LabelDateSort">Urutkan Tanggal</label>
                            <div class="input-group">
                                <select name="sort" id="LabelDateSort" onchange="this.form.submit()" class="form-select">
                                    <option value="desc" {{ $sort === 'desc' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="asc" {{ $sort === 'asc' ? 'selected' : '' }}>Terlama</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Articles -->
                <div class="row" id="articleList">
                    @if ($data->isEmpty())
                        <div class="col-12 text-center">
                            <h2>No Articles Found</h2>
                            <p>Sorry, but no articles matched your criteria. Please try adjusting your filters.</p>
                        </div>
                    @else
                        @foreach ($data as $index => $article)
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <!-- Tingkat Studi -->
                                            @foreach ($article->tingkat_studi as $tingkat)
                                                <span class="badge bg-primary">{{ $tingkat->nama }}</span>
                                            @endforeach
                                            <!-- Negara -->
                                            @foreach ($article->negara as $negara)
                                                <span class="badge bg-success">{{ $negara->nama }}</span>
                                            @endforeach
                                        </div>

                                        <!-- Jenis Pendanaan -->
                                        @foreach ((array) $article->jenis_beasiswa as $jenis)
                                            <p>{{ $jenis == 'full' ? 'Beasiswa di Biayai Penuh' : 'Beasiswa Di Biayai Sebagian' }}</p>
                                        @endforeach

                                        <h5 class="card-title text-center mt-3">{{ $article->judul }}</h5>
                                        <div class="bg-gray p-3 mt-3 rounded">
                                            <div class="d-flex justify-content-between">
                                                <p><strong>Tanggal Registrasi:</strong></p>
                                                <p class="date-registrasi">{{ $article->tanggal_registrasi }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p><strong>Deadline:</strong></p>
                                                <p class="date-deadline text-danger">{{ $article->deadline }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('detail', ['id' => $article->id]) }}#DetailKalenderBeasiswa" class="btn btn-primary mt-3">Detail Beasiswa</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Multi-Select Library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize MultiSelectTag
        new MultiSelectTag('option_tingkat_studi');
        new MultiSelectTag('option_jenis_beasiswa');
        new MultiSelectTag('option_negara');
    });

    // Ensure the URL includes #Kalender when the page loads
    window.onload = function() {
        if (!window.location.hash) {
            window.location.hash = '#Kalender';
        }
    };
</script>
@endsection