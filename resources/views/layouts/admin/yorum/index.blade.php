@extends('layouts.admin.app')


@section('content')
<h1 class="">Kullanıcı Yorumları</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Index</th>
            <th>Kullanıcı </th>
            <th>Yorumu</th>
            <th>Değerlendirmesi</th>
            <th>Tarihi</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($yorums as $yorum)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$yorum->user->name}}</td>
            <td>{{$yorum->yorum}}</td>
            <td>@for ($i =0 ; $i < $yorum->rating ; $i++)
                <span class="fas fa-star text-warning"></span>
            @endfor</td>
            <td>{{$yorum->created_at->format('d/m/Y')}}</td>
            <td><div class="btn-group" role="group" aria-label="User Actions">
                <form action="{{ route('yorum.destroy', $yorum->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yorumu silmek istediğinize emin misiniz?')">Sil</button>
                </form>
            </div></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $yorums->links() }}

@endsection

