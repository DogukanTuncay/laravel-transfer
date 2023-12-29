@extends('layouts.admin.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h1 class="">Resim Portföy</h1>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addPortfoyModal">
                <i class="fas fa-add"></i>  Yeni Resim Ekle
            </button>
        </div>
       <div class="col-md-6">
        <h1 class="">Resim Kategorileri</h1>
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addPortfoyCategoryModal">
           <i class="fas fa-add"></i> Yeni Resim Kategorisi Ekle
        </button>
       </div>

    </div>
    <div class="badge bg-primary text-wrap mb-2">KATEGORİLER</div>
    <table class="table table-striped table-responsive table-hover table-bordered">
        <thead>

            <tr>
                <th>Index</th>
                <th>Kategori Adı</th>
                <th>İşlemler</th>
            </tr>

        </thead>
        <tbody>
             @foreach ($categories as $category)
                <tr class="">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Portfolio Actions">
                            <form action="{{ route('portfoy.kategori.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Kategoriyi silmek istediğinize emin misiniz? KATEGORİYE BAĞLI RESİMLER DE SİLİNECEKTİR.')">Sil</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="badge bg-primary text-wrap mb-2">RESİMLER</div>

    <table class="table table-striped table-responsive table-hover table-bordered">
        <thead>

            <tr>
                <th>Index</th>
                <th>Resim Açıklaması</th>
                <th>Resim</th>
                <th>Resim Kategorisi</th>
                <th>İşlemler</th>
            </tr>

        </thead>
        <tbody>
             @foreach ($portfolios as $portfolio)
                <tr class="">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $portfolio->description }}</td>
                    <td><img src="{{asset($portfolio->image_url)}}" width="150" class="img-fluid rounded"></td>
                    <td>{{$portfolio->category->name}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Portfolio Actions">
                            <form action="{{ route('portfoy.destroy', $portfolio->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Resmi silmek istediğinize emin misiniz?')">Sil</button>
                            </form>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $portfolios->links() }}

</div>

<div class="modal fade" id="addPortfoyModal" tabindex="-1" role="dialog" aria-labelledby="addPortfoyModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPortfoyModalLabel">Yeni Resim Ekle</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('portfoy.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="description">Resim Açıklaması :</label>
                        <div >
                            <input type="text" class="form-control" id="arac_tur_adi" name="description">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Resim Kategorisi (Resim Hangi Kategoriye Ait ?)</label>
                        <div>
                            @if(count($categories) > 0)

                            <select class="form-control" name="category_id" id="">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @else
                            <div class="badge badge-pill bg-danger">LÜTFEN ÖNCE KATEGORİ EKLEYİN.</div>
                            @endif
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
                    <button type="submit" {{count($categories) > 0 ? '' : 'disabled'}} class="btn btn-primary">Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>

 <div class="modal fade" id="addPortfoyCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addPortfoyCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPortfoyCategoryModalLabel">Yeni Resim Kategorisi Ekle</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('portfoy.kategori.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="name">Kategori Adı</label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name">
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

@endsection
