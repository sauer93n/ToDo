/// <reference path="../typings/index.d.ts"/>
import ToDo from './ToDo.js';

$(() => {
    $.get('http://localhost:3000/microservices/todos', data => {
        let todos = data

        console.log(todos)

        for (let id in todos['content']) {

            $(".task-list-wrapper").append(new ToDo({
                id: todos['content'][id]['id'],
                title: todos['content'][id]['title'],
                body: todos['content'][id]['body']
            }).render())
        }
    }).done(() => {
        $(".task-delete").each((index, el) => {
            $(el).on('click', () => {
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost:3000/microservices/todo/delete?id=' + $(el).children(".task-delete-id").val(),
                    success: result => {
                        console.log(result);
                    },
                    async: true,
                })

                $.get('http://localhost:3000/microservices/todo/delete?id=' + $(el).children(".task-delete-id").val(), data => {
                    console.log(data)
                })
            })
        })
    })

    $('.create-task-wrapper').on('keypress', event => {
        if (event.key === 'Enter') {
            event.preventDefault()
            
            console.log($('.create-task-body').val());

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