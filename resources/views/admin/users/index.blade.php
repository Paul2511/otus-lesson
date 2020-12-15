@extends('admin.layouts.master')

@section('title', Str::ucfirst(__('messages.users.index.users')))

@section('style')
@endsection

@section('breadcrumb-title', __('messages.users.index.users') )
@section('breadcrumb-item')
    <li class="breadcrumb-item active">{{ __('messages.users.index.users')}}</li>
@endsection
{{-- Add new User button starts --}}
@section('bookmark')
    <div class="col">
        <div class="bookmark pull-right">
            @can(\App\Policies\Ability::CREATE, \App\Models\User::class)
            <button class="btn btn-success btn m-2" id="btn-add" name="btn-add">
                <span class="fa fa-plus"></span> {{ __('messages.pages.users.add')}}
            </button>
            @endcan
        </div>
    </div>
@endsection
{{-- Add new User button ends --}}
@section('body')
    @include('admin.users.modal.usermodal')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            {{-- Order list starts --}}
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ trans_choice('messages.users.index.usersFound', $users->total())}}
                            : {{$users->total()}}</h5>
                    </div>
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div id="users-table" class="table-responsive">
                                <table class="table table-hover">
                                    @include('admin.users.header.show')
                                    <tbody>
                                    @forelse ($users as $user)
                                        @include('admin.users.users-list.item',$users)
                                    @empty
                                        <p>{{ __('messages.users.index.noUsers') }}</p>
                                    @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- Order list ends --}}
            {{-- Paginator starts--}}
            <div class="col-12 pb-2">
                {{ $users->links('vendor.pagination.custom') }}
            </div>
            {{-- Paginator ends--}}
        </div>

    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/admin-users-crud.js')}}"></script>
@endsection
