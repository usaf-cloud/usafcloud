@extends('app.admin.layout.base')

@section('admin-page-content')

<div class="card">

    <div class="card-header flex justify-content-between align-items-center">
        <span class="text-xl">Manage Permissions</span>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewPermissionModal">
                Create Permission
            </button>
        </div>
    </div>

    <div class="p-4 border-b border-grey-light border-solid">
        <input type="text" placeholder="Search permissions..." class="form-control">
    </div>

    <div class="card-body">

        <ul class="list-group list-group-flush">

            @forelse ($permissions as $permission)
            <li class="list-group-item">
                <div class="flex justify-content-between align-items-center">
                    <div>
                        <p class="text-xl m-0 text-grey-darker">{{ $permission->display_name }}</p>
                        <small class="text-muted">{{ $permission->description }} ({{ $permission->name }})</small>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-primary btn-rounded mr-1" type="button"
                            data-toggle="collapse" data-target="#permission-edit-{{ $permission->id }}"
                            aria-expanded="false">
                            Edit Permission
                        </button>
                        <button class="btn btn-sm btn-outline-primary btn-rounded" type="button" data-toggle="collapse"
                            data-target="#permission-roles-{{ $permission->id }}" aria-expanded="false">
                            View Roles
                        </button>
                    </div>
                </div>
                <div class="collapse mt-3" id="permission-edit-{{ $permission->id }}">
                    <div class="card card-body">

                        <form action="{{ route('app.admin.acl.permissions.update', $permission) }}" method="POST">

                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label class="mr-1">Display Name</label>
                                <input class="form-control form-control-sm mr-3" type="text" name="display_name"
                                    value="{{ $permission->display_name }}" required>
                            </div>

                            <div class="form-group">
                                <label class="mr-1">Name</label>
                                <input class="form-control form-control-sm mr-2" type="text" name="name"
                                    value="{{ $permission->name }}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="mr-1">Description</label>
                                <input class="form-control form-control-sm mr-2" type="text" name="description"
                                    value="{{ $permission->description }}" required>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Update</button>

                        </form>

                    </div>
                </div>
                <div class="collapse mt-3" id="permission-roles-{{ $permission->id }}">
                    <div class="card card-body">
                        <div>
                            @forelse ($permission->roles as $role)
                            <span class="badge badge-secondary font-light p-2">{{ $role->name }}</span>
                            @empty
                            Not Attached to any Roles
                            @endforelse
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <li class="list-group-item">
                No items added yet
            </li>
            @endforelse

        </ul>

    </div>

</div>

@include('app.admin.permissions.partials.add-modal')

@endsection
