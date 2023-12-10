<form action="{{ route('update.omset',$omset->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Bulan</label>
                            <div class="col-sm-9">
                                <input type="date" name="bulan" id="bulan" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Total Skor Bulan Ini</label>
                            <div class="col-sm-9">
                                <input type="number" name="skor" id="skor" class="form-control @error('skor') is-invalid @enderror">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div> -->
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Omset Klinik</label>
                            <div class="col-sm-9">
                                <input type="number" name="omset" id="omset" class="form-control @error('name') is-invalid @enderror" value="{{ old('omset', $omset->omset) }}">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Index</label>
                            <div class="col-sm-9">
                            <select class="form-control @error('pendidikan') is-invalid @enderror" name="index" id="index">
                                    <option value="">Pilih</option>
                                    <option value="10.0">10.0</option>
                                    <option value="9.0">9.0</option>
                                    <option value="8.0">8.0</option>
                                    <option value="7.0">7.0</option>
                                    <option value="6.0">6.0</option>
                                    <option value="5.0">5.0</option>
                                    <option value="4.0">4.0</option>
                                    <option value="0">Batas 3.0</option>
                                    <option value="3.9">3.9</option>
                                    <option value="3.8">3.8</option>
                                    <option value="3.7">3.7</option>
                                    <option value="3.6">3.6</option>
                                    <option value="3.5">3.5</option>
                                    <option value="3.4">3.4</option>
                                    <option value="3.3">3.3</option>
                                    <option value="3.2">3.2</option>
                                    <option value="3.1">3.1</option>
                                    <option value="3.0">3.0</option>
                                    <option value="0">Batas 2.0</option>
                                    <option value="2.0">2.0</option>
                                    <option value="1.9">1.9</option>
                                    <option value="1.8">1.8</option>
                                    <option value="1.7">1.7</option>
                                    <option value="1.6">1.6</option>
                                    <option value="1.5">1.5</option>
                                    <option value="1.4">1.4</option>
                                    <option value="1.3">1.3</option>
                                    <option value="1.2">1.2</option>
                                    <option value="1.1">1.1</option>
                                </select>
                                <!-- <input type="number" name="index" id="index" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Bilangan Desimal Untuk Persen">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>