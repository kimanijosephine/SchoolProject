<template>
  <SchoolLayout>
    <div>
      <h2 class="text-3xl font-bold mb-6">Campus Dashboard</h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded shadow">
          <h3 class="text-gray-500">Total Students</h3>
          <p class="text-4xl font-bold">{{ store.dashboardStats.total_students }}</p>
        </div>
      </div>

      <div class="bg-white p-6 rounded shadow">
        <h3 class="text-xl font-bold mb-4">Students Per Year</h3>
        <ul>
          <li v-for="(count, year) in store.dashboardStats.studentsPerYear" :key="year"
            class="flex justify-between border-b py-2">
            <span>Year {{ year }}</span>
            <span class="font-bold">{{ count }} Students</span>
          </li>
        </ul>
      </div>
    </div>
  </SchoolLayout>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useSchoolStore } from '@/stores/school'
import SchoolLayout from '@/layouts/SchoolLayout.vue';
const store = useSchoolStore()

onMounted(() => {
  store.fetchDashboardStats()
  console.log(store.dashboardStats);
})
</script>
