
<style>
     h2{
        font-family: sans-serif;
        font-size: 30px;
        margin: 10px;
        margin-left: 10px;
      }
      h5{
        font-family: sans-serif;
        font-size: 12px;
        margin: 10px;
      }
      h3{
        font-family: sans-serif;
        font-size: 20px;
        position: relative;
        top: 50px;
        margin-left: 18px;
      }
      body{
        margin: -10px;
      }
      .hr1{
        height: 7px;
        background-color: #00b503;
        border: none;
        position: relative;
        top: 23px;
      }
      .hr2{
        height: 7px;
        background-color: #e03f00;
        border: none;
       
      }
      img{
        margin: 5px;
        position: relative;
        left: 140px;
      }
      td{
        margin-top: 50;
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
    {{-- <img src="{{ public_path('style/image/fanuris.png') }}" width="20px" class="text-center" alt=""/> --}}
    <table>
      <tr>
        @foreach ($data as $key =>$item)          
        <td style="border: 1px solid; width:200px ; height: 20px">
                        {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('style/image/Lunas.png'))) }}" width="50px"> --}}
                        {{-- <h5 style="text-align: right;">Andika Maros</h5> --}}
                        <h2>Rp {{ number_format($item->harga_jual_produk)}}</h2>
                        <h5>{{ strtoupper($item->nama_produk) }}</h5>
                        {{-- <h3>Rp</h3> --}}
                        <hr class="hr1">
                        <hr class="hr2">
                    </td>
                    @if ($key %5 == 4)
                        </tr><tr>
                    @endif
                @endforeach
              </tr>
      </table>
  </body>
</html>