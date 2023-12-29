@extends('layouts.admin.app')

@section('js')
<script>
$(".fiyatGuncelle").click(function () {
    $('#transferId').val($(this).data('id'));
    console.log($(this).data('id'));
});
</script>

@endsection

@section('content')
<div class="container">
    <h1>Transfer</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTransferModal">
        Yeni Transfer Ekle
    </button>

    <div class="row gx-5">
    @foreach ($araclar as $arac)
    <div class="col-lg-6 mb-3">

        <div class="card">
            <img src="{{$arac->arac_resim}}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title text-center">{{$arac->arac_tur_adi}}</h5>
            <ul class="list-group list-group-flush">
            @if (count($arac->transfer) > 0)
            @foreach ($arac->transfer as $transfer)
            <li class="list-group-item">{{$transfer->nereden->konum_adi}} <i class="fa-solid fa-arrow-right"></i> {{$transfer->nereye->konum_adi}}
                <span data-id="{{$transfer->id}}"  class="fiyatGuncelle"> <button type="button" class="btn btn-primary" data-id="{{$transfer->id}}" data-bs-toggle="modal" data-bs-target="#updateModal">
                    Fiyat Güncelle
                </button></span>
                <span class="float-end"><i class="fa-solid fa-euro-sign"></i>{{$transfer->fiyat}}</span> </li>

        @endforeach
            @else
                <div class="text-danger">HENÜZ GİRİLMİŞ TRANSFER YOK.</div>
            @endif

            </ul>

            </div>
        </div>
    </div>

    @endforeach
</div>
<div class="modal fade" id="addTransferModal" tabindex="-1" role="dialog" aria-labelledby="addTransferModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTransferModalLabel">Yeni Transfer Ekle</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form action="{{ route('transfer.store') }}" method="POST">

                @csrf

                <div class="form-group mt-3">
                    <label for="nereden">Nereden:</label>
                    <select name="nereden" class="form-control" id="arac">
                        @foreach ($konumlar as $konum)
                            <option value="{{$konum->id}}">{{$konum->konum_adi}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="nereye">Nereye:</label>
                    <select name="nereye" class="form-control" id="arac">
                        @foreach ($konumlar as $konum)
                            <option value="{{$konum->id}}">{{$konum->konum_adi}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="fiyat">Fiyat (Lütfen Euro(€) şeklinde fiyat giriniz):</label>
                    <input type="text" class="form-control" id="fiyat" name="fiyat" required>
                </div>

                <div class="form-group mt-3">
                    <label for="arac">Araç Türü:</label>
                    <select name="arac" class="form-control" id="arac">
                        @foreach ($araclar as $arac)
                            <option value="{{$arac->id}}">{{$arac->arac_tur_adi}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Ekle</button>
                </div>
            </form>
        </div>


        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Transfer Güncelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Güncelleme formu -->
                <form action="{{ route('transfer.update') }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" id="transferId" name="id" value="">
                    <div class="mb-3">
                        <label for="nereden" class="form-label">Yeni Fiyat :</label>
                        <input type="text" class="form-control" id="fiyat" name="fiyat" value="">
                    </div>
                    <!-- Diğer inputlar -->
                    <!-- ... -->
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
