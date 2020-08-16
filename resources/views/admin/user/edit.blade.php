@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Users</div>

                <div class="card-body">
                    <form action="{{route('admin.user.update', $user)}}" method="POST">
                        @csrf
                        {{method_field('PUT')}}

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right ">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right ">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roles" class="col-md-2 col-form-label text-md-right ">{{ __('Roles') }}</label>
                            <div class="col-md-6">
                                @foreach ($roles as $item)
                                    <div class="form-check">
                                        <input type="checkbox" name="roles[]" value="{{$item->id}}" @if($user->roles->contains($item->id)) checked=checked @endif >
                                        <label>{{$item->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-4">
                            <a class="btn btn-secondary float-right" href="{{route('admin.user.index')}}" role="button">Back</a>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
