<script setup lang="ts">
import { useAuthStore } from '@/stores/auth';
import FooterComponent from '@/components/homePage/FooterComponent.vue';
import HeaderComponent from '@/components/homePage/HeaderComponent.vue';
import HeroSectionComponent from '@/components/homePage/HeroSectionComponent.vue';
import TargetAudienceComponent from '@/components/homePage/TargetAudience.vue';
import ProblemStatementComponent from '@/components/homePage/ProblemStatementComponent.vue';
import OurMissionComponent from '@/components/homePage/OurMissionComponent.vue';

const authStore = useAuthStore();
const logout = () => {
  authStore.logout();
}
</script>

<template >
  <div class=" bg-gray-100 text-black min-h-screen items-center">
    <HeaderComponent />
    <HeroSectionComponent />
    <ProblemStatementComponent />
    <TargetAudienceComponent />
    <OurMissionComponent />
    <!-- <button @click="logout" class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
      Logout
    </button> -->
    <FooterComponent />
  </div>
</template>

<style scoped>

</style>
