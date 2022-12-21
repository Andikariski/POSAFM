{{-- <link href="{{ url('css/app.css') }}"> --}}
<style>
  .styled-table{
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 100%;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
    background-color: #0093ad;
    color: #ffffff;
    text-align: left;
    }

    .styled-table th,
    .styled-table td {
    padding: 12px 15px;
    }

    .styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
    }

    .styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
    }
    p{
      font-family: sans-serif;
      font-size: 20px;
    }
</style>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <p>{{ $title }}</p>
    <div class="table-responsive">
      <table class="styled-table">
          <thead>
              <tr>
                  <th>NO</th>
                  <th>NAMA PELANGGAN</th>
                  <th>ALAMAT</th>
              </tr>
          </thead>
          <tbody>
              @php
                  $no = 1;
              @endphp
              @foreach ($data as $item)    
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $item->nama_pelanggan }}</td>
                  <td>{{ $item->alamat->alamat_detail }}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>