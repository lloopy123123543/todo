<script setup>
import CreateTodos from "./CreateTodos.vue";
import axios from "axios"
import { ref } from "vue"
const notes = ref()
function enter() {
    axios({
        method: 'get',
        url: 'http://localhost:8000/api/note/show/notes',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
    })
        .then(res => {
            notes.value = res.data.data
            console.log(res.data.data)


        })
        .catch(error => alert("Что то не так"));
}
function delete_card(id) {
    axios({
        method: 'delete',
        url: `http://localhost:8000/api/note/delete/note/${id}`,
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
    })
        .then(res => {


        })
        .catch(error => alert("Что то не так"));
}
function takeDate(date){
    let word = []
    for (let i = 0; i < 10; i++) {
        if(date[i] == "-"){
            word.push(".")
            i++
        }
        word.push(date[i])

        
    }
    word = word.join('')
    word = word.split(".");
    const sec = word[0];
    word[0] = word[2]
    word[2] = sec;
    word = word.join('.')

    return word;
}
enter()

</script>

<template>
    <div>
        <create-todos @vizov="enter()"></create-todos>
        <div class="container  w-full mx-auto p-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

<div v-for="note in notes" :key="note.id" class=" bg-amber-100 m-5">
    <div class="bg-amber-200 p-2 ">
        <div class="text-2xl text-amber-500 flex justify-between">{{ note.title }} <button v-on:click="delete_card(note.id); enter()" class="text-xl"><img src="../assets/icons8-delete.svg" alt="" srcset=""></button></div>
    </div>
    <div class="p-2 text-amber-500">{{ note.text }}</div>
    <div class="text-sm text-amber-500 flex justify-end px-1">{{takeDate(note.created_at) }}</div>


</div>

</div>
    </div>

</template>

<style scoped></style>
