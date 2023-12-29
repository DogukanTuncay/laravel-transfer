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

        </tbody>
    </table>
    {{ $rezervasyonlar->links() }}

</div>

@endsection
