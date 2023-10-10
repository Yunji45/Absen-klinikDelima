@extends('template.layout.app.main')

@section('tabel')
<section class="section">
          <div class="section-header">
            <h1>{{$title}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">{{$title}}</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
              <div class="card">
                
                  <div class="card-body">
                    <div class="section-title">Tabel {{$title}}</div>
                    <div class="buttons">
                      <a href="" class="btn btn-primary" >Tambah {{$title}}</a>
                    </div>
                    
                    <table class="table table-sm table-white">
                        <form method="post" action="{{ route('kpi.save') }}">
                            @csrf
                            <div class="form-group">
                            <label>Select2 Multiple</label>
                            <select class="form-control select2" multiple="">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                                <option>Option 6</option>
                            </select>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Aspek Kinerja</th>
                                        <th>(0)</th>
                                        <th>(1)</th>
                                        <th>(2)</th>
                                        <th>(3)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>pendaftaran</td>
                                        <td><input type="checkbox" name="daftar[]" value="0" /></td>
                                        <td><input type="checkbox" name="daftar[]" value="1" /></td>
                                        <td><input type="checkbox" name="daftar[]" value="2" /></td>
                                        <td><input type="checkbox" name="daftar[]" value="3" /></td>
                                    </tr>
                                    <tr>
                                        <td>Poli</td>
                                        <td><input type="checkbox" name="poli[]" value="0" /></td>
                                        <td><input type="checkbox" name="poli[]" value="1" /></td>
                                        <td><input type="checkbox" name="poli[]" value="2" /></td>
                                        <td><input type="checkbox" name="poli[]" value="3" /></td>
                                    </tr>
                                    <tr>
                                        <td>Farmasi</td>
                                        <td><input type="checkbox" name="farmasi[]" value="0" /></td>
                                        <td><input type="checkbox" name="farmasi[]" value="1" /></td>
                                        <td><input type="checkbox" name="farmasi[]" value="2" /></td>
                                        <td><input type="checkbox" name="farmasi[]" value="3" /></td>
                                    </tr>
                                    <tr>
                                        <td>Kasir</td>
                                        <td><input type="checkbox" name="kasir[]" value="0" /></td>
                                        <td><input type="checkbox" name="kasir[]" value="1" /></td>
                                        <td><input type="checkbox" name="kasir[]" value="2" /></td>
                                        <td><input type="checkbox" name="kasir[]" value="3" /></td>
                                    </tr>

                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                            <input type="submit" value="Simpan Data">
                        </form>
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
@endsection   
