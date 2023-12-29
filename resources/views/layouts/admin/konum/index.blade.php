@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Konum</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addKonumModal">
        Yeni Konum Ekle
    </button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Index</th>
                <th>Konum Adı</th>
                <th>Sil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($konums as $konum)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $konum->konum_adi }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Slide Actions">
                            <form action="{{ route('konum.destroy', $konum->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $konums->links() }}

</div>

<div class="modal fade" id="addKonumModal" tabindex="-1" role="dialog" aria-labelledby="addKonumModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKonumModalLabel">Yeni Konum Ekle</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('konum.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="konum">Konum Adı:</label>
                        <div>
                            <input type="text" class="form-control" id="konum" name="konum">
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
