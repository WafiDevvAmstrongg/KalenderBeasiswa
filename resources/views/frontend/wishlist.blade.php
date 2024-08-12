@extends('frontend.partials.master')

@section('content')
<br>
<br>
<br>
<br>
<br>
<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-9">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <section class="content">
                <!-- Wishlist Articles -->
                <div class="row" id="wishlistArticles">
                    @if ($wishlists->isEmpty())
                        <div class="col-12 text-center">
                            <h2>No Items Found</h2>
                            <p>Your wishlist is currently empty. Add items to your wishlist to view them here.</p>
                        </div>
                    @else
                        @foreach ($wishlists as $wishlist)
                            @if($wishlist->kalenderBeasiswa)
                                <div class="col-lg-6 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                @foreach ($wishlist->kalenderBeasiswa->tingkat_studi as $tingkat)
                                                    <span class="badge bg-primary">{{ $tingkat->nama }}</span>
                                                @endforeach
                                                @foreach ($wishlist->kalenderBeasiswa->negara as $negara)
                                                    <span class="badge bg-success">{{ $negara->nama }}</span>
                                                @endforeach
                                            </div>
                                            
                                            @if(is_array($wishlist->kalenderBeasiswa->jenis_beasiswa))
                                                @foreach ($wishlist->kalenderBeasiswa->jenis_beasiswa as $jenis)
                                                    <p>{{ $jenis == 'full' ? 'Full Scholarship' : 'Partial Scholarship' }}</p>
                                                @endforeach
                                            @elseif(is_string($wishlist->kalenderBeasiswa->jenis_beasiswa))
                                                <p>{{ $wishlist->kalenderBeasiswa->jenis_beasiswa == 'full' ? 'Beasiswa Di Biayai Penuh' : 'Beasiswa Di Biayai Sebagian' }}</p>
                                            @endif
                                            
                                            <h5 class="card-title text-center mt-3">{{ $wishlist->kalenderBeasiswa->judul }}</h5>
                                            <div class="bg-gray p-3 mt-3 rounded">
                                                <div class="d-flex justify-content-between">
                                                    <p><strong>Tanggal Registrasi:</strong></p>
                                                    <p class="date-registrasi">{{ $wishlist->kalenderBeasiswa->tanggal_registrasi }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p><strong>Deadline:</strong></p>
                                                    <p class="date-deadline text-danger">{{ $wishlist->kalenderBeasiswa->deadline }}</p>
                                                </div>
                                            </div>
                                            <a href="{{ route('detail', ['id' => $wishlist->kalenderBeasiswa->id]) }}" class="btn btn-primary mt-3">View Details</a>
                                            <form action="{{ route('wishlist.remove', $wishlist->kalenderBeasiswa->id) }}" method="POST" class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning">Remove from Wishlist</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
