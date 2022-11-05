export default class ToDo {
    props = {}

    html = `
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
    <div class="task-actions">
        <div class="task-delete">
            <input type="hidden" class="task-delete-id" value={{id}}>
            <img src="bin-svgrepo-com.svg" alt="delete todo">
        </div>
    </div>
    </div>`

    constructor(props) {
        this.props = props

        this.prepareHtml();
    }

    prepareHtml() {
        for (let [key, value] of Object.entries(this.props)) {
            while (this.html.search(`{{${key}}}`) !== -1) {
                this.html = this.html.replace(`{{${key}}}`, value)
            } 
        }
    }

    render() {
        return this.html
    }
}