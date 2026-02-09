<template>
  <nav class="sticky top-0 z-50 bg-white shadow-sm w-full mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="flex items-center gap-2">
          <div
            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-lg">E</span>
          </div>
          <span class="text-2xl font-bold text-blue-600">EDU</span>
        </div>

        <div class="hidden md:flex items-center gap-8">
          <button class="text-gray-600 hover:text-blue-600 font-medium">About</button>
          <button class="text-gray-600 hover:text-blue-600 font-medium">Features</button>
          <button class="text-gray-600 hover:text-blue-600 font-medium">Contact</button>
        </div>

        <div class="flex gap-4">
          <div class="relative inline-block">
            <button @click="toggleLogin"
              class="px-6 py-2.5 text-blue-600 border-blue-600 border font-semibold hover:bg-blue-50 rounded-full transition">
              Login
            </button>
            <div v-if="openLogin"
              class="absolute mt-2 w-48 right-0 bg-white rounded-lg shadow-xl p-3 border border-gray-100 z-50">
              <RouterLink v-for="link in loginLinks" :key="link.link" :to="link.link"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md"
                @click="openLogin = false">
                {{ link.title }}
              </RouterLink>
            </div>
          </div>

          <div class="relative inline-block">
            <button @click="toggleRegister"
              class="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">
              Register
            </button>
            <div v-if="openRegister"
              class="absolute mt-2 w-48 right-0 bg-white rounded-lg shadow-xl p-3 border border-gray-100 z-50">
              <RouterLink v-for="link in registerLinks" :key="link.link" :to="link.link"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md"
                @click="openRegister = false">
                {{ link.title }}
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="max-w-4xl mx-auto p-8">
    <header class="flex flex-col items-center text-center mb-12">
      <img src="@/assets/Fees_Logo.png" alt="Logo" class="w-20 h-15 mb-4" />
      <div class="bg-blue-50 p-4 rounded-xl w-full">
        <p class="text-blue-800 font-medium">
          ✨ Welcome to the future of education payments. ✨
        </p>
      </div>
    </header>

    <div class="grid md:grid-cols-2 gap-8">
      <section class="p-6 border border-gray-100 rounded-2xl shadow-sm bg-white">
        <h2 class="text-xl font-bold mb-4">Why choose Online Fees Payment?</h2>
        <ul class="space-y-3 text-gray-600">
          <li><strong>Instant Clearance:</strong> No more waiting for bank slips.</li>
          <li><strong>Bank-Level Security:</strong> Your data is encrypted.</li>
          <li><strong>Total Transparency:</strong> Access history 24/7.</li>
        </ul>
      </section>

      <section class="p-6 bg-blue-600 text-white rounded-2xl shadow-lg">
        <h2 class="text-xl font-bold mb-4">Three Simple Steps</h2>
        <ol class="list-decimal list-inside space-y-2 opacity-90 mb-6">
          <li>Identify your student account</li>
          <li>Review your balance</li>
          <li>Securely checkout</li>
        </ol>
        <RouterLink to="/login" class="inline-block bg-white text-blue-600 px-6 py-2 rounded-lg font-bold">
          Enter Portal
        </RouterLink>
      </section>
    </div>
  </main>
</template>

<script setup lang="ts">
import { ref } from "vue"

const openRegister = ref(false)
const openLogin = ref(false)

const toggleRegister = () => {
  openRegister.value = !openRegister.value
  if (openRegister.value) openLogin.value = false // Close login if register opens
}

const toggleLogin = () => {
  openLogin.value = !openLogin.value
  if (openLogin.value) openRegister.value = false // Close register if login opens
}

const registerLinks = [
  { title: "As a Donor", link: "/donor-auth" },
  { title: "As a School", link: "/school-auth" },
  { title: "As a Student", link: "/student-auth" }
]

const loginLinks = [
  { title: "As a Donor", link: "/donor-auth" },
  { title: "As a School", link: "/school-auth" },
  { title: "As a Student", link: "/student-auth" }
]
</script>
