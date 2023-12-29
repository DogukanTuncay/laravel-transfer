@extends('layouts.admin.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h1 class="">Araç Türleri</h1>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAracModal">
                <i class="fas fa-add"></i>  Yeni Araç Türü Ekle
            </button>
            <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#deleteAracModal">
                <i class="fas fa-trash-can"></i> Araç Türü Sil
            </button>
        </div>
       <div class="col-md-6">
        <h1 class="">Araç Özellikleri</h1>
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAracOzellikModal">
           <i class="fas fa-add"></i> Yeni Araç Özelliği Ekle
        </button>
        <button type="button" class="btn btn-danger mb-3 " data-bs-toggle="modal" data-bs-target="#deleteAracOzellikModal">
           <i class="fas fa-trash-can"></i> Araç Özelliği Sil
        </button>
       </div>

    </div>

    <table class="table table-striped table-responsive table-hover table-bordered">
        <thead>

            <tr>
                <th>Index</th>
                <th>Araç Tür Adı</th>
                <th>Araç Koltuk Sayısı</th>
                <th>Araç Resmi</th>
                <th>Özellikler</th>
            </tr>

        </thead>
        <tbody>
             @foreach ($araclar as $arac)
                <tr class="">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $arac->arac_tur_adi }}</td>
                    <td>{{ $arac->koltuk_sayisi }}</td>
                    <td><img src="{{ asset($arac->arac_resim) }}" width="150" class="img-fluid rounded"></td>
                    <td>
                        <div class="mw-75">
                            @foreach ($arac->ozellikler as $key =>  $ozellik)
                            <span class=" badge text-bg-success badge-pill">{{$ozellik->ozellik}}</span>
                            @if((($key+1) % 3) == 0)
                            <br>
                            @endif
                        @endforeach
                        </div>
                       </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="modal fade" id="addAracModal" tabindex="-1" role="dialog" aria-labelledby="addAracModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAracModalLabel">Yeni Araç Türü Ekle</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('aracTuru.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="arac_tur_adi">Araç Türü Adı:</label>
                        <div >
                            <input type="text" class="form-control" id="arac_tur_adi" name="arac_tur_adi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="koltuk_sayisi">Koltuk Sayısı</label>
                        <div>
                            <input type="number" class="form-control" id="koltuk_sayisi" name="koltuk_sayisi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Resim</label>
                        <div >
                            <input type="file" class="form-control" id="image_url" name="image_url">
                        </div>
                    </div>
                </div>
                <!-- ... Diğer form alanları ... -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Ekle</button>
                </div>
            </form>


        </div>
    </div>
</div>

<div class="modal fade" id="addAracOzellikModal" tabindex="-1" role="dialog" aria-labelledby="addAracOzellikModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAracOzellikModalLabel">Yeni Araç Özelliği Ekle</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('aracTuru.ozellik.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="arac_id">Araç Türü Adı:</label>
                        <div>
                           <select name="arac_id" class="form-control" id="">
                            @foreach ($araclar as  $arac)
                                <option value="{{$arac->id}}">{{$arac->arac_tur_adi}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label for="ozellik">Özellik</label>
                        <div>
                            <input type="text" class="form-control" id="ozellik" name="ozellik">
                        </div>
                    </div>
                </div>

                <!-- ... Diğer form alanları ... -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Ekle</button>
                </div>
            </form>


        </div>
    </div>

</div>


<div class="modal fade" id="deleteAracModal" tabindex="-1" role="dialog" aria-labelledby="deleteAracModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAracModalLabel">Araç Türü Sil</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('aracTuru.destroy') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="aracDeleteId">Silinecek Aracı Seçin:</label>
                        <div >
                            <select name="aracDeleteId" id="aracDeleteId" class="form-control">
                                @foreach ($araclar as $arac)
                                    <option value="{{$arac->id}}">{{$arac->arac_tur_adi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- ... Diğer form alanları ... -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-danger">Sil</button>
                </div>
            </form>


        </div>
    </div>

</div>


<div class="modal fade" id="deleteAracOzellikModal" tabindex="-1" role="dialog" aria-labelledby="deleteAracOzellikModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAracOzellikModalLabel">Araç Türü Sil</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('aracTuru.ozellik.destroy') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="aracSelectId">Aracı Seçin:</label>
                        <div>
                            <select name="arac_id" id="aracSelectId" class="form-control">
                            <option value="0">Araç Seçin</option>

                                @foreach ($araclar as $arac)
                                    <option value="{{$arac->id}}">{{$arac->arac_tur_adi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="aracOzellik">Araca Ait Özelliği Seçin:</label>
                        <div>
                            <select name="ozellik_id" id="aracOzellik" class="form-control">

                            </select>
                        </div>
                    </div>
                </div>
                <!-- ... Diğer form alanları ... -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-danger">Sil</button>
                </div>
            </form>


        </div>
    </div>

</div>


@endsection
