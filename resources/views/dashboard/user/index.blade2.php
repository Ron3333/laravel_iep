@extends('dashboard.layout')
@section('content')
<a class="my-2 btn btn-success" href="{{ route('user.create') }}">Create</a>
<table class="table mb-3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Options</th>
        </tr>
    </thead>
<tbody>
    
@foreach ($users as $u)
<tr>
<td>{{ $u->name }}</td>
<td>{{ $u->email }}</td>
<td>
    <a class="btn btn-primary mt-2" href="{{
    route('user.edit', $u) }}">Edit</a>
    <a class="btn btn-primary mt-2" href="{{
    route('user.show', $u) }}">Show</a>
    <form action="{{ route('user.destroy', $u) }}"
        method="post" style="display:inline-block;">
        @method("DELETE")
        @csrf
        <button class="btn btn-danger mt-2"
        type="submit">Delete</button>
    </form>
</td>
</tr>
@endforeach

</tbody>
</table>

{{ $users->links() }}
@endsection
