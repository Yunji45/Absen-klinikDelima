@extends('layouts.app')

@section('title')
Jadwal Shift - Klinik Mitra Delima
@endsection
@section('content')
<div class="container">
        <div class="row">

            <div class="col-md-12 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">{{$title}}</h5>
                        <form class="float-right d-inline-block" action="{{route('download.jadwal')}}" method="get">
                            <input type="hidden" name="bulan" value="{{ request('bulan',date('Y-m')) }}">
                            <button title="Download" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="{{route('cari.jadwal.user')}}" class="mb-3" method="get">
                            <div class="form-group row mb-3 ">
                                <label for="bulan" class="col-form-label col-sm-2">Bulan</label>
                                <div class="input-group col-sm-10">
                                    <input type="month" class="form-control" name="bulan" id="bulan" value="{{ request('bulan',date('Y-m')) }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="mb-3">
                            <h5 class="m-0 pt-1 font-weight-bold float-left">Tahun : 2023 </h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>17</th>
                                        <th>18</th>
                                        <th>19</th>
                                        <th>20</th>
                                        <th>21</th>
                                        <th>22</th>
                                        <th>23</th>
                                        <th>24</th>
                                        <th>25</th>
                                        <th>26</th>
                                        <th>27</th>
                                        <th>28</th>
                                        <th>29</th>
                                        <th>30</th>
                                        <th>31</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no =1; @endphp 
                                @if($data->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data yang tersedia</td>
                                    </tr>
                                @else
                                    @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->j1}}</td>
                                    <td>{{$item->j2}}</td>
                                    <td>{{$item->j3}}</td>
                                    <td>{{$item->j4}}</td>
                                    <td>{{$item->j5}}</td>
                                    <td>{{$item->j6}}</td>
                                    <td>{{$item->j7}}</td>
                                    <td>{{$item->j8}}</td>
                                    <td>{{$item->j9}}</td>
                                    <td>{{$item->j10}}</td>
                                    <td>{{$item->j11}}</td>
                                    <td>{{$item->j12}}</td>
                                    <td>{{$item->j13}}</td>
                                    <td>{{$item->j14}}</td>
                                    <td>{{$item->j15}}</td>
                                    <td>{{$item->j16}}</td>
                                    <td>{{$item->j17}}</td>
                                    <td>{{$item->j18}}</td>
                                    <td>{{$item->j19}}</td>
                                    <td>{{$item->j20}}</td>
                                    <td>{{$item->j21}}</td>
                                    <td>{{$item->j22}}</td>
                                    <td>{{$item->j23}}</td>
                                    <td>{{$item->j24}}</td>
                                    <td>{{$item->j25}}</td>
                                    <td>{{$item->j26}}</td>
                                    <td>{{$item->j27}}</td>
                                    <td>{{$item->j28}}</td>
                                    <td>{{$item->j29}}</td>
                                    <td>{{$item->j30}}</td>
                                    <td>{{$item->j31}}</td>
                                </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="float-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection