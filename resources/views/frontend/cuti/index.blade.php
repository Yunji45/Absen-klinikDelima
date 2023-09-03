<section class="section">
          <div class="section-header">
            <h1>{{$title}}</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
              <div class="card">
                
                  <div class="card-body">
                    <div class="section-title">Tabel {{$title}}</div>
                    <table class="table table-sm table-white">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Jenis Izin</th>
                          <th scope="col">tanggal-mulai</th>
                          <th scope="col">tanggal-berakhir</th>
                          <th scope="col">Alasan</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no =1; @endphp @foreach ($cuti as $item)
                        <tr>
                            <td>{{$no++}}.</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->jenis_izin}}</td>
                            <td>{{$item->tanggal_mulai}}</td>
                            <td>{{$item->tanggal_berakhir}}</td>
                            <td>{{$item->alasan}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                                <a
                                    href="/VerifikasiIzin/{{$item->id}}/berhasil"
                                    onclick="return confirm('Yakin akan Update Data Izin?')"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fas fa-unlock-alt"></i><Strong>Verifikasi</Strong></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                   
                  </div>
                </div>
                
              </div>
              
            </div>
          </div>
        </section>
       
        <style>
            .card-body {
                position: relative;
            }

            .buttons {
                position: absolute;
                top: 10px;
                right: 10px;
            }
        </style>
