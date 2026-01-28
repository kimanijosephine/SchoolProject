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
    
    <FooterComponent />
  </div>
</template>

<style scoped>
</style>
