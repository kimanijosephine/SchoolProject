<template>
  <SponsorLayout>
    <div class="p-6">
      <header class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Sponsor Dashboard</h2>
        <p class="text-gray-600">Welcome back, {{ store.dashboardStats.company_name }}</p>
      </header>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <h3 class="text-sm font-semibold text-gray-400 uppercase mb-2">Total Sponsored</h3>
          <p class="text-4xl font-bold text-blue-600">{{ store.dashboardStats.total_students }}</p>
          <span class="text-xs text-gray-500">Active Students</span>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <h3 class="text-sm font-semibold text-gray-400 uppercase mb-2">Total Budget</h3>
          <p class="text-4xl font-bold text-green-600">
            ${{ Number(store.dashboardStats.total_budget).toLocaleString() }}
          </p>
          <span class="text-xs text-gray-500">Allocated Funds</span>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <h3 class="text-sm font-semibold text-gray-400 uppercase mb-2">Partner Schools</h3>
          <p class="text-4xl font-bold text-purple-600">
            {{ Object.keys(store.dashboardStats.school_breakdown || {}).length }}
          </p>
          <span class="text-xs text-gray-500">Institutions Supported</span>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <h3 class="text-xl font-bold mb-4 text-gray-700">Academic Progression</h3>
          <div class="space-y-3">
            <div v-for="(count, year) in store.dashboardStats.studentsPerYear" :key="year"
              class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <span class="font-medium text-gray-600">Year {{ year }}</span>
              <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-bold text-sm">
                {{ count }} Students
              </span>
            </div>
          </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <h3 class="text-xl font-bold mb-4 text-gray-700">Institutional Distribution</h3>
          <div class="space-y-3">
            <div v-for="(count, school) in store.dashboardStats.school_breakdown" :key="school"
              class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <span class="font-medium text-gray-600">{{ school }}</span>
              <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full font-bold text-sm">
                {{ count }}
              </span>
            </div>
          </div>
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
