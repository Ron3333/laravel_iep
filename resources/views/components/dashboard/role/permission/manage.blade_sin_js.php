<div>
    <h3>Assigned Permissions</h3>
    <ul id="permissionListRol">
        @foreach ($permissionsRole as $p)
            <li class="per_{{ $p->id }}">{{ $p->name }}</li>
        @endforeach
    </ul>

    <h3>Assign Permission</h3>
    <select name="permission" id="permissionSelect">
        @foreach ($permissions as $p)
            <option value="{{ $p->id }}">{{ $p->name }}</option>
        @endforeach
    </select>
    <button type="button" id="buttonAssignPermission">Assign</button>
</div>