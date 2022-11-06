
export default class ToDo {
    props = {}

    deleteBtn = $(`
        <div class="task-delete">
            <input type="hidden" class="task-delete-id" value={{id}} />
            <img src="bin-svgrepo-com.svg" alt="delete todo" />
        </div>
    `)

    taskActions = $(`
        <div class="task-actions">
            <div class="task-delete">
                <input type="hidden" class="task-delete-id" value={{id}} />
                <img src="bin-svgrepo-com.svg" alt="delete todo" />
            </div>
        </div>
    `)

    html = $(`
    <div class="task-wrapper">
    <div class="task-check">
        <input type="checkbox" name="task-done" id="task{{id}}-done">
        <label for="task{{id}}-done"></label>
    </div>
    <div class="task-info">
        <div class="task-title">
            <h4>{{title}}</h4>
        </div>
        <div class="task-body">
            {{body}}
        </div>
    </div>
    </div>`)

    constructor(props) {
        this.props = props

        this.prepareHtml()
    }

    prepareHtml() {
        
        // this.taskActions.append(this.deleteBtn)
        
        $(document).on('click', ".task-delete", (e) => {
            let clickedId = $(e.currentTarget).find(".task-delete-id").val()

            if (clickedId == this.props['id']) {
                console.log(this.props['id'])
                this.delete()
            }
        })

        this.html.append(this.taskActions)

        this.html = this.html[0].outerHTML

        for (let [key, value] of Object.entries(this.props)) {
            while (this.html.search(`{{${key}}}`) !== -1) {
                this.html = this.html.replace(`{{${key}}}`, value)
            } 
        }
    }

    render() {
        return this.html
    }

    delete() {
        console.log(this.props['id'])

        $.ajax({
            type: 'GET',
            url: 'http://localhost:3000/microservices/todo/delete?id=' + this.props['id'],
            success: data => {
                console.log(data);
            },
        })
    }
}