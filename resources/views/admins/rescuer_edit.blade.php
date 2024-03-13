@extends('layouts.app')

@section('content')

  <form id="" method="POST" action="{{ route('admins.update', $users->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('auth.partials.form')
    <button type="submit" class="btn btn-custom-submit w-100">
      {{ __('dog.form.button.submit') }}
    </button>
  </form>
@endsection
