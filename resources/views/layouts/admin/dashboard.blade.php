@extends('layouts.admin.app')

@section('js')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $('#myTable').DataTable();
function fetchRezervasyonlar() {
    fetch('/api/rezervasyon',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    }) // Rezervasyonları getiren bir endpoint kullanın
        .then(response => response.json())
        .then(data => {
            let container = document.querySelector('.container');
            let strongElement = container.querySelector('strong');
            let table = $('#myTable').DataTable();
            table.destroy(); // DataTable'ı yok et ve içeriği temizle
            let existingTable = document.getElementById('myTable');
            if (existingTable) {
            existingTable.remove();
            }
            let newTable = document.createElement('table');
            newTable.setAttribute('id', 'myTable'); // Yeni tablo için id atanması
            newTable.setAttribute('class', 'table table-striped'); // Yeni tablo için id atanması

            container.insertBefore(newTable, strongElement.nextSibling); // Yeni tabloyu strong etiketinden sonra ekleme
            // Tablo başlık ve içeriğini oluştur
            let columns = [
                'Oluşturulma Tarihi', 'İsim', 'Soyisim', 'Telefon', 'Nereden', 'Nereye', 'Yetişkin', 'Çocuk', 'Tarih', 'Saat', 'Para Birimi', 'Fiyat', 'Araç Türü',
            ];

            let thead = '<thead><tr>';
            columns.forEach(column => {
                thead += `<th>${column}</th>`;
            });
            thead += '</tr></thead>';

            $('#myTable').append(thead); // Thead'i tabloya ekle

            let tbody = '<tbody>';
                data.forEach(rezervasyon => {
                    rezervasyon.created_at = new Date(rezervasyon.created_at)
                tbody += '<tr>';
                tbody += `<td>${rezervasyon.created_at.getDate()+ '.'+(rezervasyon.created_at.getMonth()+1)+'.'+rezervasyon.created_at.getFullYear()}</td>`;
                tbody += `<td>${rezervasyon.isim}</td>`;
                tbody += `<td>${rezervasyon.soyisim}</td>`;
                tbody += `<td>${rezervasyon.phone}</td>`;
                tbody += `<td>${rezervasyon.nereden.konum_adi}</td>`;
                tbody += `<td>${rezervasyon.nereye.konum_adi}</td>`;
                tbody += `<td>${rezervasyon.yetiskin}</td>`;
                tbody += `<td>${rezervasyon.cocuk}</td>`;
                tbody += `<td>${rezervasyon.date}</td>`;
                tbody += `<td>${rezervasyon.hour}</td>`;
                tbody += `<td>${rezervasyon.parabirimi}</td>`;
                tbody += `<td>${rezervasyon.fiyat}</td>`;
                tbody += `<td>${rezervasyon.arac_tur.arac_tur_adi}</td>`;
                tbody += '</tr>';
            });
            tbody += '</tbody>';

            $('#myTable').append(tbody); // Tbody'yi tabloya ekle
            $('#myTable').DataTable({
                order: [[0, 'desc']]
            }); // DataTable'ı başlat
            })
        .catch(error => console.error('Fetch hatası:', error));
}

// Her 10 saniyede bir fetch işlemini çağır
setInterval(fetchRezervasyonlar, 10000); // 10000 milisaniye = 10 saniye

</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
<strong>TRANSFER TALEPLERİ</strong>
<table id="myTable"  class="table table-striped">
    <thead>
      <tr>
        <th>VERİLER OLUŞTURULUYOR.</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td>LÜTFEN BEKLEYİN</td>
        </tr>
    </tbody>
  </table>
@endsection
