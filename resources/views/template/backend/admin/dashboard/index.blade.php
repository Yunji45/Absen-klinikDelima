@extends('template.layout.app.main')

@section('tabel')
<section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12 text-center">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary text-center">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Pegawai</h4>
                  </div>
                  <div class="card-body">
                    {{$JumPegawai}}
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pegawai Baru Bulan Ini</h4>
                  </div>
                  <div class="card-body">
                    5
                  </div>
                </div>
              </div>
            </div> -->
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Statistics Tenaga Kesehatan</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <a href="#" class="btn btn-primary">Week</a>
                      <a href="#" class="btn">Month</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="myChart9" height="182"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Statistics Tenaga Non Kesehatan</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <a href="#" class="btn btn-primary">Week</a>
                      <a href="#" class="btn">Month</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="myChart11" height="182"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Statistics Jenis Kelamin</h4>
                    <div class="card-header-action">
                      <a href="#" class="btn active">Week</a>
                      <a href="#" class="btn">Month</a>
                      <a href="#" class="btn">Year</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart10" height="180"></canvas>
                    <!-- <div class="statistic-details mt-1">
                      <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</div>
                        <div class="detail-value">$243</div>
                        <div class="detail-name">Today</div>
                      </div>
                      <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</div>
                        <div class="detail-value">$2,902</div>
                        <div class="detail-name">This Week</div>
                      </div>
                      <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</div>
                        <div class="detail-value">$12,821</div>
                        <div class="detail-name">This Month</div>
                      </div>
                      <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</div>
                        <div class="detail-value">$92,142</div>
                        <div class="detail-name">This Year</div>
                      </div>
                    </div> -->
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Statistics Kepegawaian</h4>
                    <div class="card-header-action">
                      <a href="#" class="btn active">Week</a>
                      <a href="#" class="btn">Month</a>
                      <a href="#" class="btn">Year</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart7" height="180"></canvas>
                    <!-- <div class="statistic-details mt-1">
                      <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</div>
                        <div class="detail-value">$243</div>
                        <div class="detail-name">Today</div>
                      </div>
                      <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</div>
                        <div class="detail-value">$2,902</div>
                        <div class="detail-name">This Week</div>
                      </div>
                      <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</div>
                        <div class="detail-value">$12,821</div>
                        <div class="detail-name">This Month</div>
                      </div>
                      <div class="statistic-details-item">
                        <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</div>
                        <div class="detail-value">$92,142</div>
                        <div class="detail-name">This Year</div>
                      </div>
                    </div> -->
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Pendidikan</h4>
                </div>
                <div class="card-body">
                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{$S2}}</div>
                    <div class="font-weight-bold mb-1">S2</div>
                    <div class="progress" data-height="8">
                      <div class="progress-bar" role="progressbar" data-width="{{$S2}}%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>                          
                  </div>

                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{$S1_Nakes}}</div>
                    <div class="font-weight-bold mb-1">S1 Kesehatan</div>
                    <div class="progress" data-height="8">
                      <div class="progress-bar" role="progressbar" data-width="{{$S1_Nakes}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{$S1_NonNakes}}</div>
                    <div class="font-weight-bold mb-1">S1 Non Kesehatan</div>
                    <div class="progress" data-height="8">
                      <div class="progress-bar" role="progressbar" data-width="{{$S1_NonNakes}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{$D3_Nakes}}</div>
                    <div class="font-weight-bold mb-1">D3 Kesehatan</div>
                    <div class="progress" data-height="8">
                      <div class="progress-bar" role="progressbar" data-width="{{$D3_Nakes}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{$D3_NonNakes}}</div>
                    <div class="font-weight-bold mb-1">D3 Non Kesehatan</div>
                    <div class="progress" data-height="8">
                      <div class="progress-bar" role="progressbar" data-width="{{$D3_NonNakes}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{$SLTA_Nakes}}</div>
                    <div class="font-weight-bold mb-1">SLTA Kesehatan</div>
                    <div class="progress" data-height="8">
                      <div class="progress-bar" role="progressbar" data-width="{{$SLTA_Nakes}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{$SLTA_NonNakes}}</div>
                    <div class="font-weight-bold mb-1">SLTA Non Kesehatan</div>
                    <div class="progress" data-height="8">
                      <div class="progress-bar" role="progressbar" data-width="{{$SLTA_NonNakes}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{$Dibawah_SLTA}}</div>
                    <div class="font-weight-bold mb-1">Dibawah SLTA</div>
                    <div class="progress" data-height="8">
                      <div class="progress-bar" role="progressbar" data-width="{{$Dibawah_SLTA}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </section>
          <!-- <script src="{{asset('stisla/dist/assets/js/page/components-gender.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/js/page/components-pendidikan.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/js/page/components-pegawai.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/js/page/components-pie.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/js/page/components-pie1.js')}}"></script> -->

@endsection