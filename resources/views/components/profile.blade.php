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
            <div style="text-align: center;">
                <label for="user_profile_image">
                    <img style="cursor: pointer;" class="mr-3 rounded-circle"
                         src="{{ $profileImageUrl() }}" height="200" width="200"
                         alt="Profile Image">
                </label>
                <input upload-url="{{ route('images.upload') }}" profile-attach-url="{{ route('user.upload_profile') }}"  type="file" id="user_profile_image" style="display: none;">
                <h1 class="h3">{{ $user->name }}</h1>
                <h5 class="h5 text-primary">{{ $user->email }}</h5>
                @push("scripts")
                    <script>
                        window.onload = function () {
                            const ImageUploadRequest = ({url, image}) => {
                                const formData = new FormData();
                                formData.append('image', image);
                                return fetch(url, {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    },
                                    body: formData
                                })
                            }

                            const ErrorShow = (errors)=>{
                                alert(JSON.stringify(errors));
                            }

                            const ImageUploadEvent = function (callback) {
                                const fileField = document.querySelector('input[type="file"]');
                                ImageUploadRequest({
                                    url: $('#user_profile_image').attr('upload-url'),
                                    image: fileField.files[0]
                                })
                                    .then(response => {
                                        if(response.status === 200){
                                            return response.json();
                                        }else{
                                            return {
                                                errors:"Please Upload"
                                            }
                                        }

                                    })
                                    .then(result => {
                                        console.log('Success:', result);
                                        if(result.errors){
                                            callback(result.errors);
                                            return;
                                        }
                                        if (result.status === 1) {
                                            const formData = new URLSearchParams();
                                            formData.append('image_url', result.path);
                                            fetch($("#user_profile_image").attr("profile-attach-url"), {
                                                method: 'PATCH',
                                                headers: {
                                                    'Content-Type': 'application/x-www-form-urlencoded',
                                                    'Accept': 'application/json',
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                                },
                                                body: formData
                                            }).then(response => {
                                                if(response.status === 200){
                                                    return response.json();
                                                }else{
                                                    return {
                                                        errors:"Please Upload"
                                                    }
                                                }

                                            })
                                                .then(result => {
                                                    console.log("Success",result);
                                                    if(result.errors){
                                                        callback(result.errors);
                                                        return;
                                                    }
                                                    if (result.status === 1) {

                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                });

                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            }

                            const previewImage = ({preview, file}) => {
                                const reader = new FileReader();
                                reader.addEventListener("load", function () {
                                    ImageUploadEvent(ErrorShow);
                                    preview.src = reader.result;
                                }, false);

                                if (file) {
                                    reader.readAsDataURL(file);
                                }
                            }

                            const previewImageEvent = function () {
                                const preview = document.querySelector('img');
                                const file = document.querySelector('input[type=file]').files[0];
                                previewImage({
                                    preview,
                                    file
                                })
                            }

                            $("#user_profile_image").change(previewImageEvent);

                        }
                    </script>
                @endpush
            </div>
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
