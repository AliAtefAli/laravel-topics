<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>chat app - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/chat/style.css') }}">
</head>
<body>

<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div id="plist" class="people-list">
                    <!-- Search Input -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <!-- Users List -->
                    <ul class="list-unstyled chat-list mt-2 mb-0 users-list">
                        @include('chat.users-list')
                    </ul>
                </div>
                <div class="chat">
                    <!-- Chat Header -->
                    <div class="chat-header clearfix">
                        <div class="row">
                            @include('chat.chat-header')
                        </div>
                    </div>
                    <!-- Chat Body -->
                    <div class="chat-history">
                        <ul class="m-b-0 messages-list">
                            @include('chat.messages-list')
                        </ul>
                    </div>
                    <!-- Chat Footer -->
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-send"></i></span>
                            </div>
                            <input type="text" class="form-control chat-input" placeholder="Enter text here...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>

<script>
    // $(".chat-message input").keyup(function (e) {
    //     if ($(this).val() == '')
    //         $(this).removeAttr('good');
    //     else
    //         $(this).attr('good', '');
    // });
    let ENDPOINT = "{{ route('api.users.index') }}",
        page = 1,
        url,
        authId = "{{ auth()->id() }}",
        authAvatar = "{{ auth()->fullImage }}",
        q = '';
    loadUsersWithSearch();

    $(function() {
        let ip_address = '127.0.0.1',
            socket_port = '3000',
            socket = io(ip_address + ':' + socket_port),
            chatInput = $('#chatInput'),
            data = {
                'client': "{{ auth()->id() }}",
                'conversation': 2
            };

        socket.emit('addUser', data);

        $('#send-btn').keypress(function(e) {
            let message = $(this).val();
            console.log(message);
            if(e.which === 13 && !e.shiftKey) {
                socket.emit('sendChatToServer', message);
                chatInput.html('');
                return false;
            }
        });

        socket.on('sendChatToClient', (message) => {
            $('.chat-content ul').append(`<li>${message}</li>`);
        });
    });

    $(function() {
        $(document).on('click', '.user-box', function() {
            let userId = $(this).data('user-id');
            $.ajax({
                url: "{{ route('api.messages.index') }}" + "/" + userId,
                datatype: "json",
                data: {q},
                success: function(response) {
                    response.data.forEach(user => {
                        appendUser(user);
                    });
                },
            });

            console.log();
        });
    })

    function loadUsersWithSearch(page, q) {
        page = 1;
        if (q == '' || q == 'undefined') {
            url = ENDPOINT + "/?page=" + page ;
        } else if (page == '' || page == 'undefined') {
            url = ENDPOINT + "/?page=" + 1 ;
        }
        else {
            url = ENDPOINT + "/?page=" + page ;
        }

        $.ajax({
            url: url,
            datatype: "json",
            data: {q},
            success: function(response) {
                $("#images-table .table-body").empty();
                if (response.data.length  === 0) {
                    // noDataMessage();
                } else {
                    // $(".no-data").remove();
                }
                console.log(response);
                response.data.forEach(user => {
                    appendUser(user);
                });
            },
        });
    }

    function appendUser(user) {
        var userName = user['name'];
            userImagePath = '{{asset('assets/uploads/users/')}}' + '/' + user['image'];

        $(".users-list").append(`
                    <li class="clearfix user-box" data-user-id="`+user['id']+`">
                        <img src="` + userImagePath + `" alt="avatar">
                        <div class="about">
                            <div class="name">` + userName + `</div>
<!--                            <div class="name">Vincent Porter</div>-->
                        </div>
                    </li>
                    `);
    }

    function appendMessages(message) {
        var userName = message['name'];
            userImagePath = '{{asset('assets/uploads/users/')}}' + '/' + message['image'];

            if (message['sender_id'] == authId ){
                $(".messages").append(`
                    <!-- Right message -->
                    <li class="clearfix">
                        <div class="message-data text-right">
                            <img src="`+ authAvatar +`" alt="avatar">
                        </div>
                        <div class="message other-message float-right"> `+ message.message +`</div>
                    </li>
                    `);
            } else {
                $(".messages").append(`
                    <!-- Left message -->
                    <li class="clearfix">
                        <div class="message-data">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                        </div>
                        <div class="message my-message"> `+ message.message +`</div>
                    </li>

                    `);
            }
    }
</script>

</body>
</html>
