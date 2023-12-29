@extends('layouts.admin.app')


@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <th>Index</th>
            <th>Name</th>
            <th>Phone</th>
            <th>E-mail</th>
            <th>Kupon</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>@if ($user->kupon->isNotEmpty())
                        @foreach ($user->kupon as $kupon)
                            <span class="badge badge-pill bg-success">%{{ $kupon->indirimYuzde}}</span>
                        @endforeach
                @else
                    Kullanıcıya ait kupon bulunamadı.
                @endif</td>
                <td>
                    <div class="btn-group" role="group" aria-label="User Actions">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Kullanıcıyı silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </div>
                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" id="kupon" data-bs-toggle="modal" data-id="{{$user->id}}" data-bs-target="#kuponModal"> Kullanıcıya Kupon Ekle </button>


                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
<!-- Modal -->
<div class="modal fade" id="kuponModal" tabindex="-1" role="dialog" aria-labelledby="kuponModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kuponModalLabel">Modal title</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form  action="{{route('kupon.store')}}" method="post">
            @csrf
                <input type="hidden" id="user_id" name="user_id">
                <label for="kuponYuzde" class="form-label">% Kaç İndirim Yapmak İstersiniz ?</label>
                <input class="form-control" type="number" id="kuponYuzde" name="kuponYuzde">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kupon Ekle</button>
                  </div>
          </form>
        </div>

      </div>
    </div>
  </div>

@endsection


@section('js')
<script>

    $('#kupon').on("click", function () {
         var Id = $(this).data('id');
         $("#user_id").val( Id );
    });

      </script>
@endsection

