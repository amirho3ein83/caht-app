
<script setup>
import { ref, computed, onMounted } from "vue";

    const users = ref(null);


    const fetchData =()=> {
    return axios.get('users').then(response => {
        users.value = response.data;
    });
    }

    onMounted(() => {
      fetchData();
    });
</script>

<template>
  <h1>all users</h1>

  <ul>
    <li v-for="user in users" :key="user.id">
{{ user.username }}
    </li>
  </ul>
</template>
