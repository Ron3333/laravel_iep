@extends('dashboard.layout')
@section('content')

<a href="{{ route("post.create") }}">Create</a>
<table>
 <thead>
    <tr>
        <td>Id</td>
        <td>Title</td>
        <td>Slug</td>
        <td>Posted</td>
        <td>Category</td>
    </tr>
 </thead>
 <tbody>
 @foreach ($posts as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->title }}</td>
        <td>{{ $p->slug }}</td>
        <td>{{ $p->posted }}</td>
        <td>{{ $p->category->title }}</td>
        <td style="padding: 0px 0px 0px 20px;">
            <a href="{{ route('post.edit', $p) }}">Edit</a>
            <a href="{{ route('post.show', $p) }}">Show</a>
        <form action="{{ route('post.destroy', $p) }}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit">Delete</button>
        </form>
 </td>
 </tr>
 @endforeach
 </tbody>
</table>

{{ $posts->links() }}

@endsection
