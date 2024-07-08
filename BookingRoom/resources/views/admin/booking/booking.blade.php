@extends('layouts.admin')

@section('title', 'Đặt phòng')

@section('content')
    <h3>Đặt phòng</h3>
    <hr>
    <livewire:admin.booking.booking :orderRoom='$room'/>
@endsection
