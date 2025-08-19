@extends('pemohon.template-induk')

@section('page-title')
Senarai Permohonan
@endsection

@section('content')        
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No. KP</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($senaraiPermohonan as $item)
            <tr>
                <td><?php echo htmlspecialchars($item['id']); ?></td>
                <td>{{ $item['nama'] }}</td>
                <td>{!! htmlspecialchars($item['no_kp']) !!}</td>

                <td>
                    <div class="btn-group" role="group">
                        <a href="" class="btn btn-info btn-sm">Lihat</a>
                        <a href="" class="btn btn-warning btn-sm">Edit</a>
                        <button type="button" class="btn btn-danger btn-sm" 
                                onclick="if(confirm('Adakah anda pasti?')) document.getElementById('delete-form-<?php echo htmlspecialchars($item['id']); ?>').submit()">
                            Padam
                        </button>
                        <form id="delete-form-<?php echo htmlspecialchars($item['id']); ?>" 
                                action="" 
                                method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection