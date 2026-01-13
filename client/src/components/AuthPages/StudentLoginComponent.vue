<template lang="html">
  <div class="flex items-center justify-center min-h-screen bg-gray-100 font-sans">
    <div
      class="relative bg-white w-[450px] max-w-full min-h-[500px] rounded-xl shadow-2xl overflow-hidden flex flex-col">

      <div class="bg-linear-to-r from-blue-500 to-indigo-600 py-10 px-8 text-center text-white">
        <h1 class="text-3xl font-bold">Student Portal</h1>
        <p class="text-sm mt-2 opacity-90">Please sign in to access your dashboard</p>
      </div>

      <div class="grow flex flex-col items-center justify-center px-12 py-8 text-center">
        <form @submit.prevent="handleLogin" class="w-full">
          <h2 class="text-2xl font-bold text-blue-600 mb-6">Sign In</h2>

          <div class="space-y-4">
            <div class="text-left">
              <label class="text-xs font-semibold text-gray-500 ml-1 uppercase">Email Address</label>
              <input v-model="loginData.email" type="email" placeholder="student@school.com"
                class="bg-gray-100 border-none p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-400 outline-none text-gray-600 mt-1"
                required />
            </div>

            <div class="text-left">
              <label class="text-xs font-semibold text-gray-500 ml-1 uppercase">Password</label>
              <input v-model="loginData.password" type="password" placeholder="••••••••"
                class="bg-gray-100 border-none p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-400 outline-none text-gray-600 mt-1"
                required />
            </div>
          </div>

          <button type="submit"
            class="mt-8 w-full rounded-full border border-blue-600 bg-blue-600 text-white text-xs font-bold py-3 uppercase tracking-wider transition-transform active:scale-95 hover:bg-blue-700 shadow-lg"
            style="margin-top: 20px;">
            Enter Portal
          </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 w-full text-center">
          <p class="text-xs text-gray-400">
            Don't have an account? <br />
            <span class="text-blue-500 font-medium">Please contact your School Administration.</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue';
const serverUrl = import.meta.env.VITE_API_URL
import axios from 'axios';
// student data
const loginData = reactive({
  role: "student",
  email: "",
  password: ""
});

const handleLogin = () => {
  console.log("Student Login Attempt:", loginData);
  try {
    axios.post(serverUrl + '/login', {
      email: loginData.email,
      password: loginData.password,
      role: "student"
    })
      .then(response => {
        console.log("Login Successful:", response.data);
      })

  }
  catch (error) {
    console.error("Login Error:", error);
  }
};
</script>

<style lang="css" scoped>
/* Scoped styles for small refinements */
input::placeholder {
  color: #a0aec0;
  font-size: 0.85rem;
}
</style>
