<template>
    <div>
    <form @submit.prevent="create">
        <div >
            <div><input  v-model="newTask.name" type="text" class="form-control add-task" name="name" placeholder="New Task..."></div>

            <br>
            <button type="submit" class="btn btn-info">Create</button>
        </div>
    </form>
        <br>
        <VueNestable v-model="tasks" @input="input" >
            <VueNestableHandle slot-scope="{ item }" :item="item">
                <span v-if="item.status == 0">
                    <input type="checkbox" @click="complete(item.id)">
                </span>
                <span v-else-if="item.status == 1">
                    <input type="checkbox" @click="pending(item.id)" checked>
                </span>

                {{ item.name }}
                <button type="submit" @click="deleteTask(item.id)" class="btn-danger pull-right">Delete</button>
            </VueNestableHandle>
        </VueNestable>
    </div>
</template>

<script>
import Vue from "vue";
import {VueNestable, VueNestableHandle} from "vue-nestable";
import axios from "axios";
import ComponentExample from "./ComponentExample";

Vue.use(VueNestable);
Vue.use(VueNestableHandle);
export default {
    name: 'Tasks',
    components: {
        ComponentExample,
        VueNestable,
        VueNestableHandle,
    },
    props: {
        apiData: {
            type: Array,
        },
    },
    data () {
        return {
            newTask: {
                name: '',
            },
            tasks: this.apiData,
        }
    },
    mounted() {

    },
    methods: {
        complete(id) {
            axios.post('completetask/' + id);
            this.tasks = this.tasks.filter(task => {
                if (task.id === id) {
                    task.status === "1";
                    return task;
                }
                else
                    return task;
            });
        },
        pending(id) {
            axios.post('pendingtask/' + id);
            this.tasks = this.tasks.filter(task => {
                if (task.id === id ) {
                    task.status === "0";
                    return task;
                }
                else
                    return task;
            });
        },
        create () {

            axios.post('/createtask',{name: this.newTask.name})
                .then(( response ) => {
                    this.newTask.name="";
                    this.tasks.push(response.data);
                })
        },
        getAllTask(){
            axios.get("/gettasks")
                .then(response => {
                    this.tasks = response.data;
                });
        },
        deleteTask(id){
            axios.delete('softdelete/' + id);
            this.tasks = this.tasks.filter(task => {
                return task.id !== id
            });
        },
        input(value){
            console.log("Abc");
            axios.post('/nested',{nested: value})
                .then(( response ) => {

                })
        },
    }
}
</script>

<style scoped>
@import "assets/tasks.css";
</style>
