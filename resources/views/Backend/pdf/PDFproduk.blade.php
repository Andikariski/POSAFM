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
      <title>{{ $title }}</title>
    </head>
    <body>
      <p>{{ $header }}</p>
      <div class="table-responsive">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KODE PRODUK</th>
                    <th>NAMA PRODUK</th>
                    <th>HARGA BELI</th>
                    <th>HARGA JUAL</th>
                    <th>STOK</th>
                    <th>TEMPAT PRODUK</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $item)    
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->barcode_produk }}</td>
                    <td>{{ strtoupper($item->nama_produk) }}</td>
                    <td style="color: red">{{ number_format($item->harga_beli_produk) }}</td>
                    <td style="color: rgb(0, 204, 7)">{{ number_format($item->harga_jual_produk) }}</td>
                    <td>{{ $item->stok_produk }}</td>
                    <td>{{ $item->tempatproduk->kode_rak }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </body>
  </html>