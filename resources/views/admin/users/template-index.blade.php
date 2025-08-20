@extends('admin.template-induk')

@section('title', 'Pengurusan Pengguna')
@section('page-title', 'Pengurusan Pengguna')

@section('content')
<div class="card">
    <div class="card-header">
        Senarai Pengguna
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>Nama</th>
                    <th>Emel</th>
                    <th>Telefon</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($senaraiUsers as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <a href="#" class="btn btn-info">Kemaskini</a>
                        <a href="#" class="btn btn-danger">Padam</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection