@extends('admin.template-induk')

@section('title', 'Pengurusan Pengguna')
@section('page-title', 'Pengurusan Pengguna')

@section('content')
<div class="card">
    <div class="card-header">
        Senarai Pengguna
    </div>
    <div class="card-body">

    @include('alert')
    
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
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info">Kemaskini</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Adakah anda pasti untuk memadam pengguna ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Padam</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection