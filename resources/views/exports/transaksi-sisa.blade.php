<table>
  <thead>
    <tr>
      <td colspan="4"> Laporan Sisa Stock {{$sisa_stock[0]->nama_barang}} pada Outlet {{$sisa_stock[0]->nama_outlet}}</td>
    </tr>
    <tr>

    </tr>
    <tr>
      <th>No</th>
      <th>Kode SN</th>
      <th>Waktu Masuk</th>
      <th>Catatan</th>
    </tr>
  </thead>
  <tbody>
    @if(count($sisa_stock)>0)
    @foreach($sisa_stock as $stk_sisa)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$stk_sisa->sn}}</td>
        <td>{{$stk_sisa->waktu_masuk}}</td>
        <td>{{$stk_sisa->catatan}}</td>
      </tr>
    @endforeach
    @endif
  </tbody>
</table>
