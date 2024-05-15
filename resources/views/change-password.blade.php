@extends('layout.main')


@section('title', 'change_password')



@section('content')
    name
    <td><input class="form-control" type="number" name="record[0][rec]" value="{{ old('record.0.rec') }}"/></td>
@endsection
