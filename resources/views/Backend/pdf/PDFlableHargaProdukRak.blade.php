
<style>
     h2{
        font-family: sans-serif;
        font-size: 30px;
        margin: 10px;
      }
      h5{
        font-family: sans-serif;
        font-size: 12px;
        margin: 10px;
      }
</style>
<!doctype html>
<link href="{{ url('style/dist/css/style.min.css')}}" rel="stylesheet"/>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
  </head>
  <body>
      <table width="100%">
              <tr>
                @foreach ($data as $key =>$item)          
                    <td style="border: 1px solid">
                        <h2>Rp {{ number_format($item->harga_jual_produk)}}</h2>
                        <h5>{{ strtoupper($item->nama_produk) }}</h5>
                    </td>
                    @if ($key %4 == 3)
                        </tr><tr>
                    @endif
                @endforeach
              </tr>
      </table>
  </body>
</html>