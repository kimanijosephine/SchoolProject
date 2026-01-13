<template>
  <div class="flex h-screen bg-gray-50 font-sans text-gray-800">

    <div v-if="isSidebarOpen" @click="isSidebarOpen = false"
      class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"></div>

    <aside :class="[
      'fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-xl transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0',
      isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
    ]">
      <div class="flex items-center justify-center h-16 border-b border-gray-100">
        <span class="text-2xl font-bold text-indigo-600">Uni<span class="text-gray-800">Portal</span></span>
      </div>

      <nav class="mt-6 px-4 space-y-2">
        <a v-for="item in navItems" :key="item.name" href="#" @click.prevent="activeTab = item.name" :class="[
          'flex items-center px-4 py-3 rounded-lg transition-colors',
          activeTab === item.name
            ? 'bg-indigo-50 text-indigo-600 font-medium'
            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
        ]">
          <component :is="item.icon" class="w-5 h-5 mr-3" />
          {{ item.name }}
        </a>
      </nav>

      <div class="absolute bottom-0 w-full border-t border-gray-100 p-4">
        <div class="flex items-center gap-3">
          <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Alex" alt="Avatar"
            class="w-10 h-10 rounded-full bg-indigo-100">
          <div>
            <p class="text-sm font-semibold text-gray-700">{{ studentData.name }}</p>
            <p class="text-xs text-gray-500">{{ studentData.regNumber }}</p>
          </div>
        </div>
      </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">

      <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-100">
        <button @click="isSidebarOpen = true" class="p-2 -ml-2 text-gray-600 rounded-md lg:hidden hover:bg-gray-100">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>

        <h2 class="text-xl font-semibold text-gray-800 hidden sm:block">Student Dashboard</h2>

        <div class="flex items-center gap-4">
          <button class="relative p-2 text-gray-400 hover:text-gray-600 transition">
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
              </path>
            </svg>
          </button>
        </div>
      </header>

      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">

        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ studentData.firstName }}! 👋</h1>
          <p class="text-gray-500 mt-1">Here is what’s happening with your academic year.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-500">Academic Year</p>
                <p class="text-2xl font-bold text-gray-800">{{ studentData.currentYear }}</p>
              </div>
              <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
            </div>
            <div class="mt-2 text-xs text-gray-400">Semester 2 in progress</div>
          </div>

          <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-500">Current GPA</p>
                <p class="text-2xl font-bold text-gray-800">{{ studentData.gpa }}</p>
              </div>
              <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                  </path>
                </svg>
              </div>
            </div>
            <div class="mt-2 text-xs text-emerald-600 flex items-center">
              <span>↑ 0.2 from last sem</span>
            </div>
          </div>

          <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-500">Attendance</p>
                <p class="text-2xl font-bold text-gray-800">{{ studentData.attendance }}%</p>
              </div>
              <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
            <div class="mt-2 text-xs text-gray-400">Total classes attended</div>
          </div>

          <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-500">Fee Balance</p>
                <p class="text-2xl font-bold text-red-600">${{ studentData.feeBalance }}</p>
              </div>
              <div class="p-3 bg-red-50 text-red-600 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                  </path>
                </svg>
              </div>
            </div>
            <div class="mt-2 text-xs text-gray-400">Due by: {{ studentData.feeDueDate }}</div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

          <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
              <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Enrolled Units</h3>
                <button class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">View Transcript</button>
              </div>
              <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                  <thead>
                    <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                      <th class="px-6 py-3 font-semibold">Unit Code</th>
                      <th class="px-6 py-3 font-semibold">Unit Name</th>
                      <th class="px-6 py-3 font-semibold">Instructor</th>
                      <th class="px-6 py-3 font-semibold text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-100">
                    <tr v-for="unit in enrolledUnits" :key="unit.code" class="hover:bg-gray-50 transition">
                      <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ unit.code }}</td>
                      <td class="px-6 py-4 text-sm text-gray-600">{{ unit.name }}</td>
                      <td class="px-6 py-4 text-sm text-gray-500">{{ unit.instructor }}</td>
                      <td class="px-6 py-4 text-center">
                        <span :class="[
                          'px-2 py-1 text-xs font-semibold rounded-full',
                          unit.status === 'Ongoing' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700'
                        ]">
                          {{ unit.status }}
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
              <h3 class="text-lg font-bold text-gray-800 mb-4">Registration Details</h3>
              <ul class="space-y-4">
                <li class="flex justify-between text-sm">
                  <span class="text-gray-500">Program</span>
                  <span class="font-medium text-gray-900 text-right">{{ studentData.program }}</span>
                </li>
                <li class="flex justify-between text-sm">
                  <span class="text-gray-500">Registration No</span>
                  <span class="font-medium text-gray-900">{{ studentData.regNumber }}</span>
                </li>
                <li class="flex justify-between text-sm">
                  <span class="text-gray-500">Date Joined</span>
                  <span class="font-medium text-gray-900">{{ studentData.dateJoined }}</span>
                </li>
                <li class="flex justify-between text-sm">
                  <span class="text-gray-500">Status</span>
                  <span class="px-2 py-0.5 rounded text-xs bg-green-100 text-green-700 font-bold">Active</span>
                </li>
              </ul>
            </div>

            <div class="bg-indigo-600 rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
              <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-500 rounded-full opacity-50"></div>

              <h3 class="text-lg font-bold relative z-10">Fee Payment</h3>
              <p class="text-indigo-100 text-sm mt-1 mb-4 relative z-10">Pay your outstanding balance securely.</p>

              <div class="mb-4">
                <div class="flex justify-between text-xs mb-1">
                  <span>Paid: ${{ studentData.feePaid }}</span>
                  <span>Total: ${{ studentData.feeTotal }}</span>
                </div>
                <div class="w-full bg-indigo-800 rounded-full h-2">
                  <div class="bg-white h-2 rounded-full" style="width: 75%"></div>
                </div>
              </div>

              <button
                class="w-full py-2 bg-white text-indigo-600 font-bold rounded-lg hover:bg-indigo-50 transition relative z-10">
                Pay Now
              </button>
            </div>

          </div>
        </div>

      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, h } from 'vue';

// --- State Management ---
const isSidebarOpen = ref(false);
const activeTab = ref('Dashboard');

// --- Types ---
interface Student {
  name: string;
  firstName: string;
  regNumber: string;
  program: string;
  currentYear: string;
  dateJoined: string;
  gpa: number;
  attendance: number;
  feeBalance: number;
  feePaid: number;
  feeTotal: number;
  feeDueDate: string;
}

interface Unit {
  code: string;
  name: string;
  instructor: string;
  status: 'Ongoing' | 'Completed';
}

// --- Mock Data ---
const studentData = ref<Student>({
  name: 'Alex Johnson',
  firstName: 'Alex',
  regNumber: 'CS-2024-4092',
  program: 'BSc. Computer Science',
  currentYear: 'Year 2, Sem 2',
  dateJoined: 'Sept 2023',
  gpa: 3.8,
  attendance: 92,
  feeBalance: 450,
  feePaid: 1350,
  feeTotal: 1800,
  feeDueDate: '30th May 2026'
});

const enrolledUnits = ref<Unit[]>([
  { code: 'CSC 201', name: 'Data Structures & Algorithms', instructor: 'Dr. A. Smith', status: 'Ongoing' },
  { code: 'CSC 204', name: 'Database Management Systems', instructor: 'Prof. M. Okoth', status: 'Ongoing' },
  { code: 'MAT 201', name: 'Linear Algebra II', instructor: 'Dr. Sarah J.', status: 'Ongoing' },
  { code: 'CSC 105', name: 'Web Technologies', instructor: 'Mr. K. West', status: 'Completed' },
]);

// --- Icons Helper (Using simple inline SVGs in template to avoid dependencies) ---
// In a real app, I'd suggest using 'lucide-vue-next' or 'heroicons'

const navItems = [
  { name: 'Dashboard', icon: h('svg', { class: 'w-6 h-6', fill: 'none', viewBox: '0 0 24 24', stroke: 'currentColor', strokeWidth: 2 }, [h('path', { d: 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z' })]) },
  { name: 'My Units', icon: h('svg', { class: 'w-6 h-6', fill: 'none', viewBox: '0 0 24 24', stroke: 'currentColor', strokeWidth: 2 }, [h('path', { d: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253' })]) },
  { name: 'Financials', icon: h('svg', { class: 'w-6 h-6', fill: 'none', viewBox: '0 0 24 24', stroke: 'currentColor', strokeWidth: 2 }, [h('path', { d: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z' })]) },
  { name: 'Profile', icon: h('svg', { class: 'w-6 h-6', fill: 'none', viewBox: '0 0 24 24', stroke: 'currentColor', strokeWidth: 2 }, [h('path', { d: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' })]) },
];
</script>

<style>
/* Assuming Tailwind CSS is installed.
   If not, basic grid/flex styles would need to be written here,
   but for "Very Modern", CSS utility frameworks are highly recommended.
*/

/* Custom scrollbar for better aesthetics */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
</style>
