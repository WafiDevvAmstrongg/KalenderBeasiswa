@extends('kalender_beasiswa.partials.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data User</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah User</button>
                                <!--Button To Page Soft Delete-->
                                <a href="{{ route('user_soft_delete') }}" type="button" class="btn btn-warning ml-auto">Lihat Soft Delete</a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('user.store') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            id="nama" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            id="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" class="form-control"
                                                            id="password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Retype Password</label>
                                                        <input type="password" name="password_confirmation" class="form-control"
                                                            id="password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="id_level_user">Level User</label>
                                                        <select class="form-control" name="id_level_user">
                                                            <option value="">Pilih Level User</option>
                                                            @foreach ($level_user as $i)
                                                                <option value="{{ $i->id }}">{{ $i->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nomer_telepon">Nomer Telepon</label>
                                                        <input type="text" name="nomer_telepon" class="form-control"
                                                            id="nomer_telepon">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea name="alamat" class="form-control" id="alamat"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                                        <input type="date" name="tanggal_lahir" class="form-control"
                                                            id="tanggal_lahir">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Table --}}
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Level User</th>
                                            <th>Nomer Telepon</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" value="******" id="password_{{ $item->id }}" readonly>
                                                        <input type="hidden" class="form-control" value="{{ $item->password }}" id="real_password_{{ $item->id }}">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('{{ $item->id }}')">Show</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ isset($item->level_user) ? $item->level_user->nama : 'No Level User' }}
                                                </td>
                                                <td>{{ $item->nomer_telepon }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->tanggal_lahir }}</td>
                                                <td>
                                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <!-- Edit Button -->
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#editModal{{ $item->id }}"
                                                            class="btn btn-warning">Update</a>
                                                        <!-- Delete Button -->
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Data Ini Akan Disimpan Di Soft Delete Selama 30 Hari')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- /Table --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{-- Edit Modals --}}
    @foreach ($data as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Update User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.update', $item->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama"
                                    value="{{ $item->nama }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ $item->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="id_level_user">Level User</label>
                                <select class="form-control" name="id_level_user">
                                    <option value="">Pilih Level User</option>
                                    @foreach ($level_user as $i)
                                        <option value="{{ $i->id }}"
                                            {{ $i->id == $item->id_level_user ? 'selected' : '' }}>
                                            {{ $i->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomer_telepon">Nomer Telepon</label>
                                <input type="text" name="nomer_telepon" class="form-control" id="nomer_telepon"
                                    value="{{ $item->nomer_telepon }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat">{{ $item->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                    value="{{ $item->tanggal_lahir }}">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function togglePassword(userId) {
            var passwordField = document.getElementById('password_' + userId);
            var realPasswordField = document.getElementById('real_password_' + userId);
            var buttonText = passwordField.type === 'password' ? 'Hide' : 'Show';
            var newType = passwordField.type === 'password' ? 'text' : 'password';

            passwordField.type = newType;
            passwordField.value = newType === 'password' ? '******' : realPasswordField.value;
            passwordField.readOnly = newType === 'password';

            var buttonElement = passwordField.nextElementSibling.querySelector('button');
            buttonElement.textContent = buttonText;
        }
    </script>

@endsection
