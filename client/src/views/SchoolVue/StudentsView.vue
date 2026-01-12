<template>
  <div>
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-3xl font-bold">Student Management</h2>
      <select v-model="selectedYear" @change="loadData" class="border p-2 rounded">
        <option :value="undefined">All Years</option>
        <option :value="1">Year 1</option>
        <option :value="2">Year 2</option>
        <option :value="3">Year 3</option>
        <option :value="4">Year 4</option>
      </select>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">
      <table class="min-w-full leading-normal">
        <thead>
          <tr>
            <th
              class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Reg No</th>
            <th
              class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Name</th>
            <th
              class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Status</th>
            <th
              class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in store.students" :key="student.id">
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              {{ student.registration_number }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              {{ student.name }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <span :class="getStatusBadge(student.status)">
                {{ student.status }}
              </span>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <div class="flex space-x-2">
                <button v-if="student.status !== 'suspended'"
                  @click="store.updateStudentStatus(student.id, 'suspended')"
                  class="text-yellow-600 hover:text-yellow-900 text-xs font-bold">Suspend</button>
                <button v-if="student.status === 'suspended'" @click="store.updateStudentStatus(student.id, 'active')"
                  class="text-green-600 hover:text-green-900 text-xs font-bold">Activate</button>
                <button @click="store.updateStudentStatus(student.id, 'expelled')"
                  class="text-red-600 hover:text-red-900 text-xs font-bold">Expel</button>

                <span class="text-gray-300">|</span>

                <button @click="store.resetStudentMarks(student.id)"
                  class="text-blue-600 hover:text-blue-900 text-xs">Reset Marks</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useSchoolStore } from '@/stores/school'

const store = useSchoolStore()
const selectedYear = ref<number | undefined>(undefined)

const loadData = () => {
  store.fetchStudents(selectedYear.value)
}

const getStatusBadge = (status: string) => {
  const base = "px-2 inline-flex text-xs leading-5 font-semibold rounded-full "
  if (status === 'active') return base + "bg-green-100 text-green-800"
  if (status === 'suspended') return base + "bg-yellow-100 text-yellow-800"
  if (status === 'expelled') return base + "bg-red-100 text-red-800"
  return base + "bg-gray-100 text-gray-800"
}

onMounted(() => {
  loadData()
})
</script>
