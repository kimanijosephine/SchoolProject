<template>
  <SponsorLayout>
    <div class="p-6">
      <h1 class="text-3xl font-bold mb-4">Sponsor Dashboard</h1>

      <div v-if="store.isLoading" class="text-blue-500 text-lg">
        Loading dashboard data...
      </div>

      <div v-else-if="store.error" class="text-red-500 mb-4">
        {{ store.error }}
      </div>

      <div v-else>
        <p class="mb-6">Welcome to your dashboard! Here you can manage your sponsorships.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="bg-white p-4 rounded-lg shadow border">
            <h2 class="text-gray-500 text-sm font-semibold uppercase">Total Students</h2>
            <p class="text-2xl font-bold">{{ store.dashboardStats.total_students }}</p>
          </div>

          <div class="bg-white p-4 rounded-lg shadow border">
            <h2 class="text-gray-500 text-sm font-semibold uppercase">Wallet Balance</h2>
            <p class="text-2xl font-bold text-green-600">
              ${{ store.dashboardStats.wallet_balance || 0 }}
            </p>
          </div>
        </div>

        <div class="mt-8">
          <h3 class="text-xl font-semibold mb-2">Students Per Year</h3>
          <ul class="list-disc pl-5">
            <li v-for="(count, year) in store.dashboardStats.studentsPerYear" :key="year">
              Year {{ year }}: {{ count }} students
            </li>
          </ul>
        </div>
      </div>
    </div>
  </SponsorLayout>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useSponsorStore } from '@/stores/sponsor'
import SponsorLayout from '@/layouts/SponsorLayout.vue'

// Initialize the store
const store = useSponsorStore()

onMounted(async () => {
  await store.fetchDashboardStats()
  console.log('Stats loaded:', store.dashboardStats)
})
</script>
