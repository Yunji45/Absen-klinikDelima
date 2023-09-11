<!DOCTYPE html>
<html>
<head>
	<title>Laporan Presensi Klinik Delima Per Hari Ini</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Presensi Klinik Delima Per User</h4>
		<h6><a target="_blank" href="https://klinikmitradelima.com/">www.klinimitrakdelima.com</a></h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Nama</th>
				<th>Jam Masuk</th>
				<th>Jam Keluar</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($presents as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->tanggal}}</td>
				<td>{{$p->user->name}}</td>
				<td>{{$p->jam_masuk}}</td>
				<td>{{$p->jam_keluar}}</td>
                <td>{{$p->keterangan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>