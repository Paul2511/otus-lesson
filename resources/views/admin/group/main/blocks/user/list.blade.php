<div class="row d-flex align-items-stretch">
    @foreach ($users as $user)
        <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
            <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                    {{$group->title}}
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b>{{ $user->name }}</b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small">
                                    <span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: {{ $user->email }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <img src="https://randomuser.me/api/portraits/men/{{ rand(1,100) }}.jpg" alt="пользователь {{ $user->name }}" class="img-circle img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <form class="d-inline" action="{{ route($destroy, ['group' => $group->id, $param => $user->pivot->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm bg-red"><i class="fas fa-user-times"></i></button>
                        </form>
                        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-sm btn-primary" target="_blank">
                            <i class="fas fa-user"></i> Профиль
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
