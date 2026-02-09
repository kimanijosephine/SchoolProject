<template lang="html">
  <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto text-center mb-16">
      <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase mb-2">The Problem</h2>
      <p class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
        Traditional Systems are Inefficient
      </p>
      <div class="mt-4 max-w-2xl mx-auto h-1.5 bg-blue-100 rounded-full">
        <div class="w-24 h-full bg-blue-600 rounded-full"></div>
      </div>
      <p class="mt-6 text-xl text-gray-500 leading-relaxed">
        The education industry is often hindered by mismanagement, opacity, and outdated processes.
        We’ve rebuilt the system from the ground up to ensure every dollar is accounted for
        and every student is supported.
      </p>
    </div>

    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Our Strategic Pillars</h2>
      </div>

      <ul class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <li v-for="pillar in pillars" :key="pillar.title"
          class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

          <div class="flex items-center gap-4 mb-6">
            <div
              class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
              <span class="font-bold text-xl">{{ pillar.title.charAt(0) }}</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ pillar.title }}</h3>
          </div>

          <div class="space-y-4">
            <div class="p-4 bg-red-50 rounded-xl border-l-4 border-red-400">
              <span class="text-xs font-bold text-red-600 uppercase tracking-wider">The Challenge</span>
              <p class="mt-1 text-gray-700 leading-snug">{{ pillar.challenge }}</p>
            </div>

            <div class="p-4 bg-green-50 rounded-xl border-l-4 border-green-400">
              <span class="text-xs font-bold text-green-600 uppercase tracking-wider">Our Solution</span>
              <p class="mt-1 text-gray-700 leading-snug">{{ pillar.solution }}</p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">
const pillars = [
  {
    "title": "Fees Payment",
    "challenge": "Fragmented payment processes force parents and students into manual queues, delayed verification, and inconsistent fee records.",
    "solution": "A 24/7 platform where payments are processed online, securely and reflected instantly across student, school, and sponsor records."
  },
  {
    "title": "Transparent Sponsorship",
    "challenge": "Education funding often flows into pooled accounts, leaving donors uncertain about impact and schools burdened with manual allocation.",
    "solution": "Governed Sponsorship Allocation: Sponsors fund verified student profiles, while schools retain oversight and all transactions remain traceable."
  },
  {
    "title": "Performance Tracking",
    "challenge": "Academic records are isolated in physical files or disconnected systems, limiting meaningful insight for families and sponsors.",
    "solution": "Controlled Academic Visibility: Schools upload results in bulk, enabling authorized stakeholders to view progress without exposing private records."
  },
  {
    "title": "Security & Governance",
    "challenge": "Sensitive academic and financial data is frequently managed through insecure spreadsheets or outdated systems.",
    "solution": "Role-Based System Security: Strong authentication and access control ensure each stakeholder interacts only with approved data and actions."
  }
]
</script>
