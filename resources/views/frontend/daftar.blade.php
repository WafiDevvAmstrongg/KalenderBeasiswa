@extends('frontend.partials.master')

@section('content')

<style>
    /* Define the color variable */
    :root {
        --test-color: #1c90d9;
    }

    /* Use the color variable */
    .some-element {
        color: var(--test-color);
    }

    .another-element {
        background-color: var(--test-color);
    }
</style>

<div class="container mt-5">
    <h1 class="display-10 mb-10">Daftar Untuk Beasiswa {{ $beasiswa->judul }}</h1>
    <br>
    <form action="#" method="POST">
        @csrf
        <input type="hidden" name="beasiswa_id" value="{{ $beasiswa->id }}">

        <div class="form-group mb-3">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mb-3">
            <label for="phone">Nomer Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <!-- Add any additional fields required for registration -->

        <a href="{{ route('kalender') }}" class="btn btn-outline-primary">Kembali ke kalender</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection