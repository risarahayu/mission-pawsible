@extends('layouts.app')

@section('content')
<div class="container mt-5">
        <h2>Welcome to the Adoption Form</h2>
        <p>Are you from Indonesia?</p>

        <form action="{{ route('adoptions.nationality_check') }}" method="post">
            @csrf
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_indonesian" id="yes" value="1">
                    <label class="form-check-label" for="yes">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_indonesian" id="no" value="0">
                    <label class="form-check-label" for="no">No</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Continue</button>
        </form>
    </div>
@endsection