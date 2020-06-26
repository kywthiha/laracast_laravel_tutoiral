<div>
    <div class="card text-left">
        <div class="card-header">
            <div class="row justify-content-between">
                <?php  ?>
                <span class="">Register At (<span
                        class="font-italic text-primary">{{ $register_at() }}</span> )</span>
                @if ($assign_role_at())
                    <span class="">Assign At (<span class="font-italic text-primary">
                            {{ $assign_role_at() }}
                                </span>
                             )</span>
                @endif
            </div>
        </div>

        <div class="card-body align-content-center">
            <h1 class="h3">{{ $user->name }}</h1>
            <h5 class="h5 text-primary">{{ $user->email }}</h5>
            <div>
                <h6 class="h6 text-capitalize" style="margin-top: 30px;">Roles And Abilities</h6>
                @foreach($user->roles as $role)
                    <div class="d-block">
                        <span class="badge badge-primary">{{$role->name}}</span>
                    </div>
                    @foreach($role->abilities as $ability)
                        <p class="badge badge-dark">{{$ability->name}}</p>
                    @endforeach
                @endforeach
                <hr>
                @if($user->assigned_user)
                    <p>Assigned by <a
                            href="{{ route('users.show',$user->assigned_user) }}">{{ $user->assigned_user->name }}</a>
                    </p>

                @endif
                @if($user->articles)
                    <p><a
                            href="{{ route('articles.index',['user'=>$user]) }}">
                            Articles ( {{ $user->articles->count() }} )</a>
                    </p>

                @endif
                <div class="row">

                    <div class="col">

                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-3">
                        <x-change-password-button :user="$user"/>
                    </div>
                    <div class="col-3">
                        <x-assign-role-button :user="$user"/>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
