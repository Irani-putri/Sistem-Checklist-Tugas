@extends('layout')

@section('content')
    <h1>Edit Course</h1>
    <form method="POST" action="{{ route('courses.update', $course) }}">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $course->name }}" required>
        <textarea name="description" required>{{ $course->description }}</textarea>
        <button type="submit">Simpan</button>
    </form>
@endsection
