@extends('template.backend.karyawan.layouts.app')
@section('content')
<div class="pagetitle">
      <h1>{{$title}}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="index.html">Components</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

              <table class="table table-bordered border-primary">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Pengganti</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Alasan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @php $no =1; @endphp 
                @foreach ($permohonan as $item)
                  <tr>
                    <th scope="row">{{$no++}}.</th>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->permohonan}}</td>
                    <td>{{$item->pengganti}}</td>
                    <td>{{$item->tanggal}}</td>
                    <td>{{$item->alasan}}</td>
                    <td>{{$item->status}}</td>
                    <td>
                                            <a href=""
                                                onclick="return confirm('Anda Bukan Admin Yaa !!')"
                                                class="btn btn-sm @if ($item->status == 'approve') bg-success @else btn-danger @endif">
                                                @if ($item->status == 'approve')
                                                    <i class="bi bi-unlock-alt"></i><strong> Terverifikasi</strong>
                                                @else
                                                    <i class="bi bi-lock"></i><strong> Menunggu Verifikasi</strong>
                                                @endif
                                            </a>
                                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
      </div>
    </section>
@endsection