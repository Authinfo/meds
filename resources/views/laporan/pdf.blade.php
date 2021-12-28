<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<center>
			<h4>Laporan Klinik Medic-A</h4>
		</center>
		<br/>
		{{-- <a href="/pegawai/cetak_pdf" class="btn btn-primary" target="_blank">CETAK PDF</a> --}}
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>{{ trans('cruds.expenseReport.reports.incomeByCategory') }}</th>
					<th>{{ number_format($incomesTotal, 2) }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($incomesSummary as $inc)
                    <tr>
                        <th>{{ $inc['name'] }}</th>
                        <td>{{ number_format($inc['amount'], 2) }}</td>
                    </tr>
                @endforeach
			</tbody>
		</table>

	</div>

</body>
</html>