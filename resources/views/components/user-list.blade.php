<div id="wrapper">
    <div id="page" class="container">
        <div class="container-fluid">
            <table id="users_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Register at</th>
                    <th>Assigned by</th>
                    <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                @each('users.item', $users, 'user')
                </tbody>
            </table>
        </div>
    </div>
</div>
