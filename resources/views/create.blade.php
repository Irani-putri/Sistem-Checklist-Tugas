@extends('layout')

@section('content')
    <h1>Tambah Course</h1>
    <form method="POST" action="{{ route('courses.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Nama Course" required>
        <textarea name="description" placeholder="Deskripsi" required></textarea>
        <button type="submit">Simpan</button>
    </form>
@endsection
