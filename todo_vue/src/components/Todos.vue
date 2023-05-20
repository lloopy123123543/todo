<script setup>
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
enter()

</script>

<template>
    <div class="container  w-full mx-auto p-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 space-x-5">
        <div v-for="note in notes" :key="note.id" class="w-3/4 bg-amber-100">
            <div class="bg-amber-200 p-2">
                <div class="text-2xl text-amber-500 flex justify-between">{{ note.title }} <button v-on:click="delete_card(note.id); enter()" class="text-xl">Готово</button></div>
            </div>
            <div class="p-2 text-amber-500">{{ note.text }}</div>


        </div>

    </div>
</template>

<style scoped></style>
