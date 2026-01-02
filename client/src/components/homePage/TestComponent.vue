<template>
  <div>
    <p>Checking server connection...</p>
    <p>Server Response: {{ serverResponse }}</p>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'
import axios from 'axios'
const API_URL = import.meta.env.VITE_API_URL;
const serverResponse = ref('')

const testServer = async () => {
  try {
    const response = await axios.get(`${API_URL}/status`)
    console.log('Server response:', response.data)
    serverResponse.value = response.data.status;
  } catch (error) {
    console.error('Error connecting to server:', error)
  }
}

// This hook triggers as soon as the component is added to the DOM
onMounted(() => {
  testServer()
})
</script>
