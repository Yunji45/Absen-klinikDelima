@extends('template.backend.karyawan.layouts.app')
@section('content')
<div class="pagetitle">
      <h1>{{$title}}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              @if (Auth::user()->foto == 'default.jpeg')
                  <img id="image" src="{{ asset('/storage/default.jpeg') }}" alt="" class="rounded-circle">
              @else
                  <img id="image" src="{{ asset(Storage::url(Auth::user()->foto)) }}" alt="{{ Auth::user()->foto }}" class="rounded-circle">
              @endif
              <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
              <h2>{{Auth::user()->name}}</h2>
              <h3>{{Auth::user()->role}}</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-sertifikat">Certificate</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-dokumen">Document</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">Indonesia, Klinik Pratama Mitra Delima</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->role}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">INA</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Saldo Cuti</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->saldo_cuti}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->no_hp}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->email}}</div>
                  </div>

                  <h5 class="card-title">Document Files</h5>
                  <div class="row">
                    <!-- <div class="col-lg-3 col-md-4 label">Email</div> -->
                    <div class="col-lg-9 col-md-8">data dummy</div>
                    <div class="col-lg-9 col-md-8">data dummy</div>
                    <div class="col-lg-9 col-md-8">data dummy</div>
                    <div class="col-lg-9 col-md-8">data dummy</div>
                  </div>

                  <h5 class="card-title">Certificate Files</h5>
                  <div class="row">
                    <!-- <div class="col-lg-3 col-md-4 label">Email</div> -->
                    <div class="col-lg-9 col-md-8">data dummy</div>
                    <div class="col-lg-9 col-md-8">data dummy</div>
                    <div class="col-lg-9 col-md-8">data dummy</div>
                    <div class="col-lg-9 col-md-8">data dummy</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="{{ route('update-profil', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf

                    <!-- <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div> -->
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="file" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="name" value="{{Auth::user()->name}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value="Indonesia, Klinik Pratama Mitra Delima">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="Job" value="{{Auth::user()->role}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" value="INA">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Saldo Cuti</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="{{Auth::user()->saldo_cuti}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="no_hp" type="text" class="form-control" id="no_hp" value="{{Auth::user()->no_hp}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="k.anderson@example.com">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <p class="text-muted" style="font-style: italic; font-size: small;">Note: Pegawai hanya bisa update foto profile, Nama, No Telp, dan Email.</p>
                    </div>
                  </form>
                  <!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="{{ route('update-password', Auth::user()->id) }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password_baru" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="konfirmasi_password" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-sertifikat">
                  <h5 class="card-title">Sertifikat Diklat : </h5>

                  <!-- Change Password Form -->
                  <form action="{{ route('save.dokumen') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>

                    <h5 class="card-title">Sertifikat Keahlian : </h5>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <h5 class="card-title">Lain - Lain : </h5>

                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <p class="text-muted" style="font-style: italic; font-size: small;">Note: Ekstensi yang digunakan PDF dan Maks 5MB.</p>
                    </div>
                  </form>
                  <!-- End Change Password Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-dokumen">
                  <h5 class="card-title">Dokumentasi : </h5>

                  <!-- Change Password Form -->
                  <form action="{{ route('save.sertifikat') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Curiculum Vitae</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">KTP</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ijazah Terakhir</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Transkip Nilai</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Kartu Keluarga</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <h5 class="card-title">Lain - Lain : </h5>

                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <p class="text-muted" style="font-style: italic; font-size: small;">Note: Ekstensi yang digunakan PDF dan Maks 5MB.</p>
                    </div>
                  </form>
                  <!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>
        </div>
      </div>
    </section>
    <script>
    function previewProfileImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('profilePreview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeProfileImage() {
        document.getElementById('profilePreview').src = 'assets/img/profile-img.jpg';
        // Jika perlu, Anda bisa menambahkan logika lain di sini, misalnya mengirimkan permintaan ke server untuk menghapus gambar profil.
    }
</script>

@endsection