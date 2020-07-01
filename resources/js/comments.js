window.onload = function () {
    const app = $("#comments");
    const API = {
        ROOT_URL: `http://localhost:8000/article/${app.attr('article_id')}/comments`,
        HEADERS: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        LIST() {
            return `${this.ROOT_URL}`;
        },
        REPLY(id) {
            return `${this.ROOT_URL}/${id}`;
        },
        UPDATE(id) {
            return `${this.ROOT_URL}/${id}`;
        },
        CREATE() {
            return `${this.ROOT_URL}`;
        },
        DELETE(id) {
            return `${this.ROOT_URL}/${id}`;
        }
    }

    const CreateRequest = function ({text}) {
        const formData = new URLSearchParams();
        formData.append('text', text);
        return fetch(API.CREATE(), {
            method: 'POST',
            headers: API.HEADERS,
            body: formData,
        })
    }

    const CreateEvent = function () {
        return function (e) {
            e.preventDefault();
            const commentInput = $('textarea[name="text"]');
            const text = commentInput.val();
            CreateRequest({text})
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    commentInput.val('')
                    getComments();
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    }

    const DeleteRequest = function (id) {
        return fetch(API.DELETE(id), {
            method: "DELETE",
            headers: API.HEADERS,
        })
    }

    const DeleteEvent = function (id) {
        return function (e) {
            e.preventDefault();
            DeleteRequest(id).then(response => response.json())
                .then(data => {
                    if (data.status === 1) {
                        console.log('Success:', data);
                        getComments();
                    } else {
                        alert("You don't delete");
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    };

    const ReplyRequest = function ({id, text}) {
        const formData = new URLSearchParams();
        formData.append('text', text);
        return fetch(API.REPLY(id), {
            method: 'POST',
            headers: API.HEADERS,
            body: formData,
        })
    }

    const ReplyEvent = function (id) {
        return function (e) {
            e.preventDefault();
            const reply = prompt("Reply comment");
            ReplyRequest({id, text: reply})
                .then(response => response.json())
                .then(data => {
                    getComments();
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

    };

    const EditRequest = function ({id, text}) {
        const formData = new URLSearchParams();
        formData.append('text', text);
        return fetch(API.UPDATE(id), {
            method: "PUT",
            headers: API.HEADERS,
            body: formData,
        })
    }

    const EditEvent = function ({id, oldComment}) {
        return function (e) {
            e.preventDefault();
            const text = prompt("Edit comment", oldComment);
            EditRequest({id, text})
                .then(response => response.json())
                .then(data => {
                    if (data.status === 1) {
                        console.log('Success:', data);
                        getComments();
                    } else {
                        alert("You don't edit");
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    };


    const CommentComponent = ({id, user_name, comment, created_at, comments}) => {
        const CommentDiv = $("<div></div>", {
            "class": "media mb-4",
        });

        const ReplyCommentComponent = $(`<div></div>`)

        if (comments) {
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
                text: "Delete",
                href: "",
                on: {
                    click: DeleteEvent(id)

                }
            }
        )

        const ReplyButton = $("<a></a>", {
            text: "Reply",
            style: "margin-left:12px",
            href: "",
            on: {
                click: ReplyEvent(id),
            }
        })

        const EditButton = $("<a></a>", {
            text: "Edit",
            style: "margin-left:12px",
            href: "",
            on: {
                click: EditEvent({id, oldComment: comment})
            }
        })

        CommentAction.append(DeleteButton);
        CommentAction.append(ReplyButton);
        CommentAction.append(EditButton);

        const CommentHeader = (`
                    <h5 class="mt-0">${user_name} <span style="font-size: 0.7rem;color:blue;"> ${new Date(created_at).toDateString()}</span></h5>
                    `)

        CommentBody.append(CommentHeader)
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

    const getComments = () => {
        fetch(API.LIST())
            .then(response => response.json())
            .then(data => {
                comments_render(data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    getComments();
    $('#comments_create_form').submit(CreateEvent());

}
