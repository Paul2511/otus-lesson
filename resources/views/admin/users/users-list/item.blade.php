 <tr class="text-center" id="row{{ $user->id }}">
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->first_name.' '.$user->last_name  }}</td>
        <td>{{ $user->position }}</td>
        <td>{{ __('messages.rolesConst.'.$user->role->name)}}</td>
        <td>{{ __('messages.users.index.statusConst.'.$user->status) }}</td>
        <td>{{ $user->companies->first()->name ?? ''}}</td>
        <td>{{ $user->created_at->format('d.m.Y')}}</td>
        <td>
            <div class="btn-group">
                @can(\App\Policies\Ability::UPDATE, \App\Models\User::class)
                <button href="#" class="btn btn-secondary btn-sm open-modal" title="{{ __('messages.pages.orders.edit')}}" value="{{$user->id}}"> <span class="fa fa-pencil"></span> </button>
                @endcan
                @can(\App\Policies\Ability::DELETE, \App\Models\User::class)
                <button href="#" class="btn btn-danger btn-sm delete-user" title="{{ __('messages.pages.orders.delete')}}" value="{{$user->id}}"> <span class="fa fa-trash"></span> </button>
                @endcan
            </div>
        </td>
    </tr>
