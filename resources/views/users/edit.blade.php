<x-master>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">{{ __('Edit Assign Role') }}</div>

                    <div class="card-body align-content-center">
                        <h1 class="h3">{{ $user->name }}</h1>
                        <h5 class="h5 text-primary">{{ $user->email }}</h5>
                        <form method="POST" action="{{ route('users.update_assign_role',$user) }}">
                            @csrf
                            @method('PUT')
                            <h5 class="h5" style="margin-top: 30px;">Role</h5>
                            <table class="table">
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            <div class="">
                                                <input type="checkbox" name="roles[]" id="{{$role->id}}" {{ $user->roles->contains($role)?'checked':'' }} value="{{$role->id}}">
                                                <label for="{{$role->id}}" class="{{ $user->roles->contains($role)?'badge badge-secondary':'' }}"
                                                       style="margin-left: 10px;">{{$role->name}}</label>
                                            </div>
                                            <div class="modal fade" id="{{$role->name}}_{{$role->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLongTitle">{{$role->name}}
                                                                ( {{$role->id}} )</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach($role->abilities as $ability)
                                                                <div class="badge badge-pill badge-secondary">
                                                                    {{ $ability->name }}
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <a href="{{route('roles.edit',$role)}}" type="button"
                                                               class="btn btn-primary">Edit Ability</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#{{$role->name}}_{{$role->id}}">Detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>


