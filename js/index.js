/// <reference path="../typings/index.d.ts"/>
import ToDo from './ToDo.js';

$(() => {
    $.ajax({
        type: 'get',
        url: 'http://localhost:3000/microservices/todos',
        success: data => {
            let todos = data

            for (let id in todos['content']) {
                $(".task-list-wrapper").append(new ToDo({
                    id: todos['content'][id]['id'],
                    title: todos['content'][id]['title'],
                    body: todos['content'][id]['body']
                }).render())
            }
        },
        async: true,
    })


    $('.create-task-wrapper').on('keypress', event => {
        if (event.key === 'Enter') {
            event.preventDefault()

            let data = {
                "title": "\"Task\"",
                "body": "\"" + $('.create-task-body').val() + "\"",
                "user_id": 5,
            }

            console.log(data)

            $.post('http://localhost:3000/microservices/todo/add', data).done(answer => {
                console.log(answer);
            })
        }
    })
})