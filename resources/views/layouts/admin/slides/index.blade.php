@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Slider</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSlideModal">
        Yeni Slide Ekle
    </button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Index</th>
                <th>Resim</th>
                <th>Sil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($slides as $slide)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td><img src="{{ asset($slide->image_url) }}" width="150" class="img-fluid rounded"></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Slide Actions">
                            <form action="{{ route('slider.destroy', $slide->id) }}" method="POST">
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
    {{ $slides->links() }}

</div>

<div class="modal fade" id="addSlideModal" tabindex="-1" role="dialog" aria-labelledby="addSlideModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSlideModalLabel">Yeni Slide Ekle</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="image_url">Resim</label>
                        <div>
                            <input type="file" class="form-control" class="custom-file-input" id="image_url" name="image_url">
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
