@extends('frontend.partials.master')

@section('content')
<br>
<br>
<!-- Inline CSS for styling -->
<style>
    .page-section {
        padding: 4rem 0;
        /* Ensure adequate padding for sections */
    }

    .container {
        padding: 0 2rem;
        /* Increase left and right padding for the entire container */
    }

    body {
        font-family: Arial, sans-serif;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 0.5rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Space between content and button */
        height: 100%;
        /* Ensure the card takes full height */
    }

    .card-body {
        padding: 2rem;
        flex: 1;
        /* Make sure content takes up remaining space */
    }

    .display-4 {
        font-size: 2.5rem;
        /* Adjust as needed for title size */
    }

    .display-5 {
        font-size: 2rem;
        /* Adjust as needed for section headings */
    }

    .list-unstyled {
        padding-left: 0;
        /* Remove default list padding */
    }

    .list-unstyled li {
        margin-bottom: 0.5rem;
        /* Add space between list items */
    }

    .mb-5 {
        margin-bottom: 3rem;
        /* Space between sections */
    }

    .mb-3 {
        margin-bottom: 1.5rem;
        /* Space between elements within a section */
    }

    .btn-register {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: 500;
        color: #fff;
        background-color: #007bff;
        /* Primary color */
        border: none;
        border-radius: 0.375rem;
        transition: background-color 0.3s ease;
        text-align: center;
        margin-top: auto;
        /* Pushes button to the bottom of the card */
    }

    .btn-register:hover {
        background-color: #0056b3;
        /* Darker color on hover */
        text-decoration: none;
    }

    .date-card {
        background-color: #ededed;
        padding: 1rem;
        border-radius: 0.5rem;
    }

    .date-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
</style>

<!-- Detail Kalender Beasiswa -->
<section class="page-section" id="DetailKalenderBeasiswa">
    <div class="container">
        <!-- Title -->
        <div class="text-center mb-5">
            <h1 class="display-4">{{ $data->judul }}</h1>
        </div>

        <!-- Tanggal Registrasi and Deadline Section -->
        <div class="date-card mb-5">
            <div class="date-row">
                <strong>Tanggal Registrasi</strong>
                <strong>Deadline</strong>
            </div>
            <div class="date-row">
                <p class="date-registrasi">{{ $data->tanggal_registrasi }}</p>
                <p class="date-deadline text-danger">
                    {{ $data->deadline }}</p>
            </div>
        </div>

        <!-- Tentang Section -->
        <div class="mb-5">
            <form action="{{ route('wishlist.store') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="id_kbeasiswa" value="{{ $data->id }}">
                <button type="submit" class="btn btn-primary">Add to Wishlist</button>
            </form>
            <h2 class="display-5">Tentang</h2>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Tingkat Studi:</strong>
                        <ul>
                            @foreach ($data->tingkat_studi as $tingkat)
                                <li>{{ $tingkat->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-3">
                        <strong>Negara:</strong>
                        <ul>
                            @foreach ($data->negara as $neg)
                                <li>{{ $neg->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-3">
                        <strong>Deskripsi:</strong> {{ $data->deskripsi }}<br>
                        <strong>Jenis Beasiswa:</strong> {{ $data->jenis_beasiswa }}<br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Keuntungan Section -->
        <div class="mb-5">
            <h2 class="display-5">Keuntungan</h2>
            <div class="card">
                <div class="card-body">
                    <strong>Keuntungan:</strong>
                    <p>{{ $data->keuntungan }}</p>
                </div>
            </div>
        </div>

        <!-- Persyaratan Section -->
        <div>
            <h2 class="display-5">Persyaratan</h2>
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li><strong>Umur:</strong> {{ $data->umur }}</li>
                        <li><strong>GPA:</strong> {{ $data->gpa }}</li>
                        <li><strong>Tes English:</strong> {{ $data->tes_english }}</li>
                        <li><strong>Tes Bahasa Lain:</strong> {{ $data->tes_bahasa_lain }}</li>
                        <li><strong>Tes Standard:</strong> {{ $data->tes_standard }}</li>
                        <li><strong>Dokumen:</strong> {{ $data->dokumen }}</li>
                        <li><strong>Lainnya:</strong> {{ $data->lainnya }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Register Button -->
        <div class="text-center mt-5">
            <a href="{{ route('daftar_beasiswa', ['id' => $data]) }}" class="btn-register">Register Now</a>
        </div>
    </div>
</section>
<!-- /Kalender Beasiswa -->
@endsection