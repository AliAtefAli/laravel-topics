const express = require('express'),
    app = express(),
    server = require('http').createServer(app),
    io = require('socket.io')(server, {
        cors: {origin: "*"}
    });
const moment = require('moment');

let mysql = require('mysql'),
    con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: ""
    }),
    users = {},
    dataBaseConnection = connectToDataBase();

// con.connect(function (err) {
//     // if (err) throw err;
//     console.log("Connected!");
// });



io.on('connection', (socket) => {
    console.log('connection!');
    checkDataBaseConnection();

    socket.on("addUser", function (data) {
        // console.log('add user client='+data.client+' conversation='+data.conversation);
        if (!(data.client in users)) {
            // بنفضي الكي بتاع اليورز دا عشان لو فاتح شات تاني
            users[data.client] = {};
            // console.log("in : ", users);
        }
        // console.log("out : ", users);
        users[data.client][data.conversation] = socket;
        socket.user_id = data.client;
        socket.conversation_id = data.conversation;
        // console.log("end : ", users/*, "Socket : ", socket*/);
    });

    socket.on('sendChatToServer', (message) => {
        // io.sockets.emit('sendChatToClient', message);
        // Insert to DB
        insertNewMessageToDatabase();
        // Broadcast
        socket.broadcast.emit('sendChatToClient', message);
        // Private
        users[data.receiver_id][data.conversation_id].emit("message", {
            "conversation_id":data.conversation_id,
            "sender_id":data.sender_id,
            "content":data.content,
            "type":data.type
        });


        console.log(getCreatedAtDate(), message);

    });

    socket.on('disconnect', (socket) => {
        console.log('Disconnect');
    });
});

server.listen(3000, () => {
    console.log('Server is running');
});

function getCreatedAtDate() {
    const date = new Date();
    return moment(date).add(2).format();
}

function insertNewMessageToDatabase() {
    connection.query('INSERT INTO users SET ?', {
        name: 'Ali',
        email: '123kmk',
        phone: 'data.conten,mt',
        email_verified_at: new Date(),
        password: '$2y$12$fC3tXLnmFM6DF4y6l50nJuxE3s4ug9vANtUn2h8nmE8PQLOYdnSKS', // 123456
        remember_token: 'Str::random(10)',
        created_at: new Date()
    }, function (error, results, fields) {
        if (error) throw error;
        // console.log(results.insertId);
    });
}

function connectToDataBase() {
    let connection = mysql.createConnection({
        host: 'localhost',
        user: 'root',
        password: '',
        database: 'laravel_topics',
        charset: 'utf8mb4'
    });
    connection.connect(function (err) {
        // if (err) throw err;
        console.log("Database Connected!");
    });

    return connection;
}

function checkDataBaseConnection() {
    if(dataBaseConnection.state === 'disconnected'){
        connectToDataBase();
    }
}
