<template>
    <div class="todo-list">
        <div v-for="task in tasks">
            <div v-if="task.status == 0">
                <div class="todo-item">
                    <div class="checker"><span class=""><input type="checkbox" disabled readonly></span></div>
                    <span>{{task.name}}</span>
                    <span class="pull-right"><a  @click="restore(task.id)" class="btn btn-success">Restore</a></span>
                </div>
            </div>
            <div v-else-if="task.status == 1">
                <div class="todo-item">
                    <div class="checker"><span class=""><input type="checkbox"  checked disabled readonly></span></div>
                    <span>{{task.name}}</span>
                    <span class="pull-right"><a  @click="restore(task.id)" class="btn-success">Restore</a></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'DeletedTasks',
    props: ['apiData'],
    data(){
        return {
            tasks: '',
        }
    },
    mounted() {
        this.getDeletedTasks();
    },
    methods: {
        restore(id) {
            axios.post('retrivedeletedtask/' + id)
            this.tasks = this.tasks.filter(task => {
                return task.id !== id
            });
        },
        getDeletedTasks(){
            axios.get("/getdeletedtasks")
                .then(response => {
                    console.log(response.data.api_data);
                    this.tasks = response.data.api_data;
                });
        },
    }
}
</script>
