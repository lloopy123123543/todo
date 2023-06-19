<script setup>
import axios from "axios"
import { ref } from "vue"
const TITLE = ref('')
const TEXT = ref('')
function create() {
    if(TITLE == "" || TEXT == "" ){
        alert("Поле логина или пароля пустые")
    }
    axios({
        method: 'post',
        url: 'http://localhost:8000/api/note/create',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        data: {
          title: TITLE.value,
          text: TEXT.value
        },
    })
        .then(res => {

            console.log(res.data.data)


        })
        .catch(error => (alert("поля логина и пароля пустые")));
}


</script>

<template>
<div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
	<div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
        <div class="mb-4">
            <h1 class="text-grey-darkest ">Добавить цель</h1>
            <div class="flex mt-4 ">
                <input v-model="TITLE" class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" placeholder="Название">
                <input v-model="TEXT" class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" placeholder="Текст">
                <button v-on:click="create();$emit('vizov')" class="flex-no-shrink p-2 border-2 rounded text-teal border-teal hover:bg-teal">Add</button>
            </div>
            
        </div>
        <div>

        </div>
    </div>
</div>
</template>

<style scoped></style>
