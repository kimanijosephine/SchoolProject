<template>
  <SchoolLayout>
    <div class="max-w-4xl mx-auto">
      <h2 class="text-3xl font-bold mb-6">Batch Operations</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white p-6 rounded shadow">
          <h3 class="text-xl font-semibold mb-4">1. Import Students</h3>
          <p class="text-sm text-gray-600 mb-4">Upload a CSV containing: Name, RegNo, Year</p>

          <input type="file" ref="studentFile" accept=".csv, .xlsx" class="mb-4 w-full text-sm text-slate-500
          file:mr-4 file:py-2 file:px-4
          file:rounded-full file:border-0
          file:text-sm file:font-semibold
          file:bg-violet-50 file:text-violet-700
          hover:file:bg-violet-100" />

          <button @click="handleUpload('students')" :disabled="store.isLoading"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50">
            {{ store.isLoading ? 'Uploading...' : 'Upload Student List' }}
          </button>
        </div>

        <div class="bg-white p-6 rounded shadow">
          <h3 class="text-xl font-semibold mb-4">2. Import Marks</h3>
          <p class="text-sm text-gray-600 mb-4">Upload a CSV containing: RegNo, Subject, Mark</p>

          <input type="file" ref="marksFile" accept=".csv, .xlsx" class="mb-4 w-full text-sm text-slate-500
          file:mr-4 file:py-2 file:px-4
          file:rounded-full file:border-0
          file:text-sm file:font-semibold
          file:bg-green-50 file:text-green-700
          hover:file:bg-green-100" />

          <button @click="handleUpload('marks')" :disabled="store.isLoading"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 disabled:opacity-50">
            {{ store.isLoading ? 'Uploading...' : 'Upload Marks' }}
          </button>
        </div>

      </div>

      <div v-if="message"
        :class="`mt-4 p-4 rounded ${isSuccess ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`">
        {{ message }}
      </div>
    </div>
  </SchoolLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useSchoolStore } from '@/stores/school'
import SchoolLayout from '@/layouts/SchoolLayout.vue'
const store = useSchoolStore()
const studentFile = ref<HTMLInputElement | null>(null)
const marksFile = ref<HTMLInputElement | null>(null)
const message = ref('')
const isSuccess = ref(false)

const handleUpload = async (type: 'students' | 'marks') => {
  const inputRef = type === 'students' ? studentFile.value : marksFile.value
  const file = inputRef?.files?.[0]

  if (!file) {
    message.value = "Please select a file first."
    isSuccess.value = false
    return
  }

  const result = await store.uploadData(file, type)
  message.value = result.message
  isSuccess.value = result.success

  // Reset input
  if (result.success && inputRef) inputRef.value = ''
}
</script>
