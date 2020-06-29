<x-master>
    <div class="container">
        <div class="card" style="margin-bottom: 10px;">
            <div class="card-body">
                <div class="card-title">
                    <h3><a href="/articles/{{ $article->id }}">{{ ucwords($article->title) }}</a></h3>
                    <p>
                        @foreach($article->tags as $tag)
                            <a href="{{ route("articles.index",['tag'=>$tag]) }}"
                               class="badge badge-pill badge-primary">{{ $tag->name }}</a>
                        @endforeach
                    </p>
                </div>
                <div class="card-text">
                    <p class="text-black-50"> {{ $article->except }}</p>
                    <p class="text-black-50"> {{ $article->body }}</p>
                </div>
                <div class="row">

                    <x-article-edit-button class="card-link" style="margin-right: 30px;" :article="$article"/>

                    <x-article-delete-button class="card-link" :article="$article"/>

                </div>
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form id="comments_create_form">
                            <div class="form-group">
                                <textarea name="text" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div id="comments">
                </div>

            </div>
            <div class="card-footer">
                <span>Posted by <span class="text-primary">{{ $article->author->name }}</span></span>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>

            window.onload = function () {
                const API = {
                    ROOT_URL: 'http://localhost:8000/article/{{ $article->id }}/comments',
                    HEADERS: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    LIST(article_id = {{ $article->id }}) {
                        return {
                            URL: `${this.ROOT_URL}`,
                            METHOD: 'GET',
                        }
                    },
                    REPLY(id) {
                        return {
                            URL: `${this.ROOT_URL}/${id}`,
                            METHOD: 'POST'
                        };
                    },
                    UPDATE(id) {
                        return {
                            URL: `${this.ROOT_URL}/${id}`,
                            METHOD: 'PUT'
                        };
                    },
                    CREATE(article_id = {{ $article->id }}) {
                        return {
                            URL: `${this.ROOT_URL}`,
                            METHOD: 'POST'
                        };
                    },
                    DELETE(id) {
                        return {
                            URL: `${this.ROOT_URL}/${id}`,
                            METHOD: 'DELETE'
                        };
                    }
                }

                const CommentComponent = ({id, user_name, comment, created_at, comments}) => {
                    const CommentDiv = $("<div></div>", {
                        "class": "media mb-4",
                        on: {
                            touchstart: function (event) {
                                // Do something
                            }
                        }
                    });
                    const ReplyCommentComponent = $(`<div></div>`)

                    if(comments){
                        comments.forEach((comment, index) => {
                            console.log(comment);
                            ReplyCommentComponent.append(CommentComponent({
                                id: comment.id,
                                user_name: comment.user.name,
                                comment: comment.text,
                                created_at: comment.created_at,
                                comments: comment.comments
                            }));
                        })
                    }

                    const UserProfile = $("<img/>", {
                        "class": "d-flex mr-3 rounded-circle",
                        "src": `https://i.pravatar.cc/50?u=${user_name}`,
                        "alt": ""
                    })
                    const CommentBody = $("<div></div>", {
                        class: "media-body",
                    })
                    const CommentAction = $("<div></div>");

                    const DeleteButton = $("<a></a>",
                        {
                            text:"Delete",
                            href:"",
                            on:{
                                click:function (e) {
                                    e.preventDefault();
                                    fetch(API.DELETE(id).URL, {
                                        method: API.DELETE().METHOD,
                                        headers: API.HEADERS,
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if(data.status === 1){
                                                console.log('Success:', data);
                                                fetch(API.LIST().URL).then(response => response.json()).then(data => {
                                                    comments_render(data);
                                                })
                                            }
                                            else{
                                                alert("You don't delete");
                                            }
                                        })
                                        .catch((error) => {
                                            console.error('Error:', error);
                                        });

                                }

                            }
                        }
                        )

                    const ReplyButton = $("<a></a>",{
                        text:"Reply",
                        style: "margin-left:12px",
                        href:"",
                        on:{
                            click:function (e) {
                                e.preventDefault();
                                const reply = prompt("Reply comment");
                                const formData = new URLSearchParams();
                                formData.append('text', reply);
                                fetch(API.REPLY(id).URL, {
                                    method: API.REPLY(id).METHOD,
                                    headers: API.HEADERS,
                                    body: formData,
                                })
                                    .then(response => response.json())
                                    .then(data => {

                                        fetch(API.LIST().URL).then(response => response.json()).then(data => {
                                            comments_render(data);
                                        })
                                    })
                                    .catch((error) => {
                                        console.error('Error:', error);
                                    });
                            }
                        }
                    })

                    const EditButton = $("<a></a>",{
                        text:"Edit",
                        style: "margin-left:12px",
                        href:"",
                        on:{
                            click:function (e) {
                                e.preventDefault();
                                const text = prompt("Edit comment",comment);
                                const formData = new URLSearchParams();
                                formData.append('text', text);
                                fetch(API.UPDATE(id).URL, {
                                    method: API.UPDATE(id).METHOD,
                                    headers: API.HEADERS,
                                    body: formData,
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if(data.status === 1){
                                            console.log('Success:', data);
                                            fetch(API.LIST().URL).then(response => response.json()).then(data => {
                                                comments_render(data);
                                            })
                                        }
                                        else{
                                            alert("You don't edit");
                                        }
                                    })
                                    .catch((error) => {
                                        console.error('Error:', error);
                                    });
                            }
                        }
                    })

                    CommentAction.append(DeleteButton);
                    CommentAction.append(ReplyButton);
                    CommentAction.append(EditButton);

                    const CommentHeader = ({user_name, created_at}) => (`
                    <h5 class="mt-0">${user_name} <span style="font-size: 0.7rem;color:blue;"> ${new Date(created_at).toDateString()}</span></h5>
                    `)
                    CommentBody.append(CommentHeader({
                        user_name,
                        created_at
                    }))

                    CommentBody.append(comment)
                    CommentBody.append(CommentAction)
                    CommentBody.append(ReplyCommentComponent)
                    CommentDiv.append(UserProfile)
                    CommentDiv.append(CommentBody)


                        return CommentDiv;


                }

                const comments_render = (data) => {
                    $('#comments').children().remove();
                    data.forEach((comment, index) => {
                        $('#comments').append(CommentComponent({
                            id: comment.id,
                            user_name: comment.user.name,
                            comment: comment.text,
                            created_at: comment.created_at,
                            comments: comment.comments
                        }));
                    })
                }

                fetch(API.LIST().URL).then(response => response.json()).then(data => {
                    comments_render(data);
                })
                    .catch((error) => {
                        console.error('Error:', error);
                    });


                $('#comments_create_form').submit(function (e) {
                    e.preventDefault();
                    const text = $('textarea[name="text"]').val();
                    const formData = new URLSearchParams();
                    formData.append('text', text);
                    fetch(API.CREATE().URL, {
                        method: API.CREATE().METHOD,
                        headers: API.HEADERS,
                        body: formData,
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Success:', data);
                            $('textarea[name="text"]').val('')
                            fetch(API.LIST().URL).then(response => response.json()).then(data => {
                                comments_render(data);
                            })
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });

                });
            }
        </script>
    @endpush
</x-master>

