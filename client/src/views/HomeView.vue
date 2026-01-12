<script setup lang="ts">
import { useAuthStore } from '@/stores/auth';
const authStore = useAuthStore();
const logout = () => {
  authStore.logout();
}
</script>

<template>
  <main>
    <h1 class="text-3xl font-bold underline text-blue-600">
      Hello world!
    </h1>
    <button @click="logout" class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
      Logout
    </button>

  </main>
</template>
