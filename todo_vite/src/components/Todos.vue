<script setup>
function enter(){
  axios({
        method: 'get',
        url: 'http://localhost:8000/api/note/show/notes',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
      })
      .then(res => {
    console.log (res.data.data)

  })
  .catch(error => alert("Что то не так"));
}
enter()


</script>

<template>
  <div class="container">
    <div class="">
      <div></div>
    </div>

  </div>
</template>

<style scoped></style>
