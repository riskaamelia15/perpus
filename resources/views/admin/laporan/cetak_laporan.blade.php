<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <ce>
        <div class="card-body">
            <div class="table-responsive">
              
<br><br>
      <center>
                    <h2>LAPORAN PEMINJAMAN</h2>
                </center>
        <center>
                <table class="table" border="1">
                    <thead>
                        <center>
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjaman</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>denda</th>
                            </tr>
                        </center>
                    </thead>
                    
                        <tbody>
                        @php $no=1; @endphp
                        @foreach ($pinjam as $data)
                            <center>
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $data->anggotas->nama_anggota }}</td>
                              <td>{{ $data->Bukus->judul_buku }}</td>
                              <td>{{ $data->tanggal_pinjam }}</td>
                              <td>{{ $data->tanggal_kembali }}</td>
                              
                            <th>

                                <?php
                                $datetime2 = strtotime($data->tanggal_kembali) ;
                                $datenow = strtotime(date("Y-m-d"));
                                $durasi = ($datetime2 - $datenow) / 86400 ;
                            ?>                                @if ($durasi < 0)
                                    <?php $denda = abs($durasi) * 1500 ; ?>
                                    {{ $denda }}
                                @else
                                    0
                                @endif
                            </th>
                                </tr>
                            </center>
                            @endforeach
                        
            
                </table>

</center>
        <center>
            <script>
                window.print();
            </script>
            </center>
</body>

</html>