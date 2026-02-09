<template lang="html">
  <section class="bg-white py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
          Who Participates in <span class="text-blue-600">EDU</span>
        </h2>
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
          Our ecosystem connects three core stakeholders in a seamless, transparent loop.
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div
          class="relative group bg-white border border-gray-200 rounded-3xl p-8 transition-all hover:border-blue-500 hover:shadow-2xl hover:shadow-blue-500/10">
          <div class="flex items-center gap-4 mb-8">
            <div
              class="p-3 bg-blue-100 rounded-2xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                <path
                  d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Schools</h3>
          </div>
          <ul class="space-y-4">
            <li v-for="feature in schoolFeatures" :key="feature" class="flex items-start gap-3 text-gray-600">
              <span
                class="mt-1 flex-shrink-0 w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-[10px] font-bold">✓</span>
              <span class="text-sm leading-relaxed">{{ feature }}</span>
            </li>
          </ul>
        </div>

        <div
          class="relative group bg-white border border-gray-200 rounded-3xl p-8 transition-all hover:border-indigo-500 hover:shadow-2xl hover:shadow-indigo-500/10">
          <div class="flex items-center gap-4 mb-8">
            <div
              class="p-3 bg-indigo-100 rounded-2xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Students</h3>
          </div>
          <ul class="space-y-4">
            <li v-for="feature in studentFeatures" :key="feature" class="flex items-start gap-3 text-gray-600">
              <span
                class="mt-1 flex-shrink-0 w-5 h-5 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center text-[10px] font-bold">✓</span>
              <span class="text-sm leading-relaxed">{{ feature }}</span>
            </li>
          </ul>
        </div>

        <div
          class="relative group bg-white border border-gray-200 rounded-3xl p-8 transition-all hover:border-emerald-500 hover:shadow-2xl hover:shadow-emerald-500/10">
          <div class="flex items-center gap-4 mb-8">
            <div
              class="p-3 bg-emerald-100 rounded-2xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Donors</h3>
          </div>
          <ul class="space-y-4">
            <li v-for="feature in donorFeatures" :key="feature" class="flex items-start gap-3 text-gray-600">
              <span
                class="mt-1 flex-shrink-0 w-5 h-5 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-[10px] font-bold">✓</span>
              <span class="text-sm leading-relaxed">{{ feature }}</span>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const schoolFeatures = [
  "Register and maintain institutional records",
  "Bulk upload verified student data",
  "Submit sponsorship needs for enrolled students",
  "Upload academic performance records",
  "View fee and sponsorship coverage summaries"
]

const studentFeatures = [
  "Access personal fee balance and payment history",
  "Receive sponsorship allocations transparently",
  "View academic performance records",
  "Track sponsorship status linked to their profile",
  "Secure first-login and account ownership"
]

const donorFeatures = [
  "Browse eligible students approved by schools",
  "Sponsor students through a governed wallet system",
  "Receive academic progress updates for sponsored students",
  "View transaction history and funding impact reports"
]
</script>
