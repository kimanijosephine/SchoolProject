<script setup lang="ts">
import { useAuthStore } from '@/stores/auth';
import FooterComponent from '@/components/homePage/FooterComponent.vue';
import HeaderComponent from '@/components/homePage/HeaderComponent.vue';
const authStore = useAuthStore();
const logout = () => {
  authStore.logout();
}
</script>

<template>
  <div>
    <HeaderComponent />
    <button @click="logout" class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
      Logout
    </button>
    <FooterComponent />
  </div>
</template>

<style scoped>
.home {
  padding: 80px 20px;
  text-align: center;
}

.home h1 {
  font-size: 2.4rem;
  margin-bottom: 15px;
}

.home p {
  font-size: 1.1rem;
  color: #555;
  max-width: 600px;
  margin: auto;
}
</style>
