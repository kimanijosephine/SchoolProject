<template>
  <div class="flex h-screen bg-gray-100">
    <aside class="w-64 bg-blue-900 text-white flex flex-col">
      <div class="p-4 text-2xl font-bold border-b border-blue-800">
        Campus Admin
      </div>
      <nav class="flex-1 p-4 space-y-2">
        <router-link to="/school-dashboard" class="block p-2 rounded hover:bg-blue-800">
          Dashboard
        </router-link>
        <router-link to="/students" class="block p-2 rounded hover:bg-blue-800">
          Manage Students
        </router-link>
        <router-link to="/uploads" class="block p-2 rounded hover:bg-blue-800">
          Batch Uploads (CSV)
        </router-link>
      </nav>
      <div class="p-4 border-t border-blue-800">
        <div class="text-sm mb-2">User: {{ authStore.getUserName }}</div>
        <button @click="handleLogout" class="w-full bg-red-600 py-1 rounded hover:bg-red-700">
          Logout
        </button>
      </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-8">
      <router-view></router-view>
    </main>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()
const router = useRouter()

const handleLogout = () => {
  authStore.logout()
  router.push('/login')
}
</script>
