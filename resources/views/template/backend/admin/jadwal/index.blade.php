@extends('template.layout.app.main') 
@section('tabel')
<section class="section">
    <div class="section-header">
        <h1>{{$title}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="#">Dashboard</a>
            </div>
            <div class="breadcrumb-item">{{$title}}</div>
        </div>
    </div>
    <div class="section-header">
        <!-- <a href="" class="btn btn-primary" data-toggle="modal" data-target="#kehadiran">
            <i class="fa fa-plus">
                Add</i>
        </a> -->
        <button
            type="button"
            class="btn btn-primary dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="fa fa-plus"></i>
            Add
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" data-toggle="modal" data-target="#kehadiran">Add Normal</a>
            <a class="dropdown-item" data-toggle="modal" data-target="#update">Add Multiple</a>
        </div>
        <a href="{{ route('download.jadwal', ['bulan' => request('bulan', date('Y-m'))]) }}" class="btn btn-danger">
            <i class="fa fa-download"></i> PDF
        </a>
        <a href="" class="btn btn-success">
            <i class="fa fa-download">
                Excel</i>
        </a>
        <div class="section-header-breadcrumb">

            <div class="input-group" style="width: 200px;">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search By Name">
                <div class="input-group-append">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                </div>
            </div>
        </div>

    </div>
    
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}} Table</h4>
                        <div class="card-header-form">
                            <form action="{{route('cari.jadwal')}}" method="get">
                                @csrf
                                <div class="input-group">
                                <input type="month" class="form-control" name="bulan" id="bulan" placeholder="Search Bulan" value="{{ request('bulan',date('Y-m')) }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="table-container table-striped" id="myTable">
                                <table border="1" style="text-align: center;">
                                    <caption>
                                        <p>PERHATIAN !!!</p>
                                        <p>Hijau = Tukar Jaga & Merah = Ganti Jaga</p>
                                    </caption>

                                    <tr>
                                        <th rowspan="2" bgcolor="yellow">NO</th>
                                        <th rowspan="2" bgcolor="yellow">Nama Pegawai</th>
                                        <th colspan="32" bgcolor="#00ff80" style="text-align: center;">JADWAL JAGA KLINIK Mitra Delima</th>
                                    </tr>
                                    <tr>
                                        @for ($i = 1; $i <= 31; $i++)
                                        <th>{{ $i }}</th>
                                        @endfor
                                        <th>Action</th>

                                    </tr>
                                    @php $no =1; @endphp @if($data->isEmpty())
                                    <tr>
                                        <td colspan="34" style="text-align: center; font-size: 14px;">Tidak ada data yang tersedia</td>
                                    </tr>
                                    @else @foreach ($data as $item)
                                    <tr>
                                        <td style="text-align: center; font-size: 14px;">{{$no++}}.</td>
                                        <td style="text-align: center; font-size: 9px;">{{$item->user->name}}</td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 1)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j1}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j1}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j1}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 2)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j2}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j2}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j2}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 3)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j3}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j3}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j3}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                                @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 4)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j4}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j4}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j4}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 5)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j5}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j5}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j5}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 6)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j6}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j6}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j6}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 7)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j7}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j7}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j7}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 8)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j8}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j8}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j8}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 9)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j9}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j9}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j9}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 10)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j10}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j10}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j10}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 11)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j11}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j11}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j11}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;" >
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 12)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j12}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j12}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j12}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 13)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j13}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j13}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j13}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 14)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j14}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j14}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j14}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 15)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j15}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j15}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j15}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 16)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j16}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j16}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j16}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 17)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j17}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j17}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j17}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 18)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j18}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j18}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j18}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 19)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j19}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j19}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j19}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 20)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j20}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j20}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j20}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 21)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j21}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j21}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j21}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 22)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j22}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j22}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j22}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 23)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j23}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j23}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j23}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 24)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j24}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j24}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j24}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 25)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j25}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j25}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j25}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 26)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j26}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j26}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j26}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 27)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j27}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j27}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j27}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 28)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j28}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j28}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j28}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 29)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j29}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j29}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j29}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 30)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j30}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j30}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j30}}
                                        @endif
                                        </td>
                                        <td style="text-align: center; font-size: 14px;">
                                        @php
                                        $hasApproved = false;
                                        @endphp

                                        @foreach ($item->user->permohonan as $permohonan)
                                            @php
                                            $permohonanDate = \Carbon\Carbon::parse($permohonan->tanggal);
                                            $currentDate = \Carbon\Carbon::now();
                                            @endphp

                                            @if ($permohonan->status === 'approve')
                                            @if (($permohonan->permohonan === 'ganti_jaga') || ($permohonan->permohonan === 'tukar_jaga' ))
                                                    @if ($permohonanDate->isSameMonth($currentDate) && $permohonanDate->day === 31)
                                                        @if ($permohonan->permohonan === 'ganti_jaga')
                                                            <span class="bg-merah">{{$item->j31}}</span>
                                                        @elseif ($permohonan->permohonan === 'tukar_jaga')
                                                            <span class="bg-hijau">{{$item->j31}}</span>
                                                        @endif
                                                        @php
                                                        $hasApproved = true;
                                                        break;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach

                                        @if (!$hasApproved)
                                            {{$item->j31}}
                                        @endif
                                        </td>
                                        <td class="button-container">
                                            <a
                                                href="{{route('jadwal.edit',$item->id)}}"
                                                class="btn btn-sm btn-success"
                                                title="{{$title}}"
                                            >
                                                <i class="fas fa-edit">
                                                    </i>
                                            </a>

                                            <a
                                                href="{{ route('jadwal.hapus',$item->id)}}"
                                                class="btn btn-sm btn-danger"
                                                title="{{$title}}"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                <i class="fas fa-trash">
                                                    </i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach @endif

                                </table>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel">Form Input Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('jadwal.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <input type="hidden" name="user_id" value="">
                        <div class="form-group row">
                            <label for="user_id" class="col-form-label col-sm-3">Nama Pegawai </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                    @foreach ($user as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Bulan </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan" id="bulan">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="masa_aktif">
                            <label for="masa_aktif" class="col-form-label col-sm-3">Masa Aktif</label>
                            <div class="col-sm-9">
                                <input type="date" name="masa_aktif" id="masa_aktif" class="form-control @error('masa_aktif') is-invalid @enderror">
                                @error('masa_aktif') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="masa_akhir">
                            <label for="masa_akhir" class="col-form-label col-sm-3">Masa Akhir</label>
                            <div class="col-sm-9">
                                <input type="date" name="masa_akhir" id="masa_akhir" class="form-control @error('masa_akhir') is-invalid @enderror">
                                @error('masa_akhir') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j1" class="col-form-label col-sm-3">Tanggal 1 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j1') is-invalid @enderror" name="j1" id="j1">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j1') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j2" class="col-form-label col-sm-3">Tanggal 2 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j2') is-invalid @enderror" name="j2" id="j2">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j2') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j3" class="col-form-label col-sm-3">Tanggal 3 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j3') is-invalid @enderror" name="j3" id="j3">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j3') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j4" class="col-form-label col-sm-3">Tanggal 4 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j4') is-invalid @enderror" name="j4" id="j4">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j4') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j5" class="col-form-label col-sm-3">Tanggal 5 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j5') is-invalid @enderror" name="j5" id="j5">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j5') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j6" class="col-form-label col-sm-3">Tanggal 6 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j6') is-invalid @enderror" name="j6" id="j6">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j6') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j7" class="col-form-label col-sm-3">Tanggal 7 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j7') is-invalid @enderror" name="j7" id="j7">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j7') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j8" class="col-form-label col-sm-3">Tanggal 8 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j8') is-invalid @enderror" name="j8" id="j8">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j8') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j9" class="col-form-label col-sm-3">Tanggal 9 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j9') is-invalid @enderror" name="j9" id="j9">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j9') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j10" class="col-form-label col-sm-3">Tanggal 10 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j10') is-invalid @enderror" name="j10" id="j10">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j10') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j11" class="col-form-label col-sm-3">Tanggal 11 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j11') is-invalid @enderror" name="j11" id="j11">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j11') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j12" class="col-form-label col-sm-3">Tanggal 12 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j12') is-invalid @enderror" name="j12" id="j12">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j1') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j13" class="col-form-label col-sm-3">Tanggal 13 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j13') is-invalid @enderror" name="j13" id="j13">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j13') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j14" class="col-form-label col-sm-3">Tanggal 14 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j14') is-invalid @enderror" name="j14" id="j14">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j14') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j15" class="col-form-label col-sm-3">Tanggal 15 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j15') is-invalid @enderror" name="j15" id="j15">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j15') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j16" class="col-form-label col-sm-3">Tanggal 16 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j16') is-invalid @enderror" name="j16" id="j16">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j16') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j17" class="col-form-label col-sm-3">Tanggal 17 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j17') is-invalid @enderror" name="j17" id="j17">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j17') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j18" class="col-form-label col-sm-3">Tanggal 18 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j18') is-invalid @enderror" name="j18" id="j18">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j18') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j19" class="col-form-label col-sm-3">Tanggal 19 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j19') is-invalid @enderror" name="j19" id="j19">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j19') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j20" class="col-form-label col-sm-3">Tanggal 20 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j20') is-invalid @enderror" name="j20" id="j20">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j20') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j21" class="col-form-label col-sm-3">Tanggal 21 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j2') is-invalid @enderror" name="j21" id="j21">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j21') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j22" class="col-form-label col-sm-3">Tanggal 22 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j22') is-invalid @enderror" name="j22" id="j22">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j22') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j23" class="col-form-label col-sm-3">Tanggal 23 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j23') is-invalid @enderror" name="j23" id="j23">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j23') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j24" class="col-form-label col-sm-3">Tanggal 24 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j24') is-invalid @enderror" name="j24" id="j24">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j24') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j25" class="col-form-label col-sm-3">Tanggal 25 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j25') is-invalid @enderror" name="j25" id="j25">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j25') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j26" class="col-form-label col-sm-3">Tanggal 26 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j26') is-invalid @enderror" name="j26" id="j26">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j26') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j27" class="col-form-label col-sm-3">Tanggal 27 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j27') is-invalid @enderror" name="j27" id="j27">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j27') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j28" class="col-form-label col-sm-3">Tanggal 28 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j28') is-invalid @enderror" name="j28" id="j28">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j20') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j29" class="col-form-label col-sm-3">Tanggal 29 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j29') is-invalid @enderror" name="j29" id="j29">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j29') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j30" class="col-form-label col-sm-3">Tanggal 30 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j30') is-invalid @enderror" name="j30" id="j30">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j30') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j31" class="col-form-label col-sm-3">Tanggal 31 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j31') is-invalid @enderror" name="j31" id="j31">
                                    <option value="">Pilih</option>
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="PM">PM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j31') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel"> Insert Multiple {{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jadwal.multiple') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Ambil Data</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan" id="bulan">
                                    <option value="">Pilih</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Insert</label>
                            <div class="col-sm-8">
                                <input type="date" name="bulantarget" id="bulantarget" class="form-control @error('name') is-invalid @enderror">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
<script>
    function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Ganti angka 1 dengan indeks kolom yang sesuai
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }
    }
    }

</script>

<style>
.card-body {
    position: relative;
}

.buttons {
    position: absolute;
    top: 10px;
    right: 10px;
}
table {
            font-family: verdana, arial, sans-serif;
            font-size: 11px;
            color: #333333;
            border-width: 1px;
            border-color: #FFA800;
            border-collapse: collapse;
        }
        table th {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #FFA800;
            background-color: skyblue;
            color: #ffffff;
        }
        table tr:hover td {
            cursor: pointer;
        }
        table tr:nth-child(even) td{
            background-color: skyblue;
        }
        table td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #FFA800;
            background-color: #ffffff;
        }

.table-container {
    width: 100%;
    overflow-x: auto; /* Membuat tabel responsif jika terlalu lebar */
    margin: 0 auto; /* Pusatkan tabel secara horizontal */
}

table {
    width: 100%; /* Lebar tabel mengisi wadah */
    border-collapse: collapse;
}

th, td {
    padding: 2px; /* Atur padding sel header dan sel data */
}

th {
    background-color: yellow;
}

tr:nth-child(even) {
    background-color: #f2f2f2; /* Atur latar belakang baris ganjil */
}
.button-container {
    display: flex;
    justify-content: space-between; /* Mengatur jarak antara tombol-tombol */
}
/* Untuk latar belakang merah */
.bg-merah {
    background-color: rgba(255, 0, 0, 0.5); /* Transparansi diatur ke 0.5 (50%) */
}
.bg-hijau {
    background-color: rgba(0, 255, 0, 0.5); /* Warna hijau dengan transparansi 50% */
}

/* Untuk latar belakang transparan */
.bg-transparan {
    background-color: transparent;
}
.Note {
    margin-bottom: -20px; /* Atur jarak bawah sesuai kebutuhan Anda */
}

p {
    font-size: 12px;
    font-style: italic;
}

</style>
@endsection