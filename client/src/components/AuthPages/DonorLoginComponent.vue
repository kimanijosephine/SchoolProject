<template lang="html">
  <div class="flex items-center justify-center min-h-screen bg-gray-100 font-sans">
    <div id="container" :class="['relative overflow-hidden w-[768px] max-w-full min-h-[480px] bg-white rounded-xl shadow-2xl',
      isSignUp ? 'right-panel-active' : '']">
      <div
        class="form-container sign-up-container absolute top-0 h-full transition-all duration-700 ease-in-out left-0 w-1/2 opacity-0 z-[1]">
        <form @submit.prevent="handleRegister"
          class="bg-white flex flex-col items-center justify-center h-full px-12 text-center">
          <h1 class="text-2xl font-bold m-0">Create Account</h1>
          <span class="text-sm text-gray-600 my-3">Register as a Sponsor</span>
          <input v-model="formData.company_name" type="text" placeholder="Company Name"
            class="bg-gray-100 border-none p-3 my-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
            required />
          <input v-model="formData.email" type="email" placeholder="Email"
            class="bg-gray-100 border-none p-3 my-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
            required />
          <input v-model="formData.password" type="password" placeholder="Password"
            class="bg-gray-100 border-none p-3 my-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
            required />
          <button type="submit"
            class="mt-4 rounded-full border border-blue-600 bg-blue-600 text-white text-xs font-bold py-3 px-11 uppercase tracking-wider transition-transform active:scale-95 hover:bg-blue-700">
            Sign Up
          </button>
        </form>
      </div>

      <div
        class="form-container sign-in-container absolute top-0 h-full transition-all duration-700 ease-in-out left-0 w-1/2 z-[2]">
        <form @submit.prevent="handleLogin"
          class="bg-white flex flex-col items-center justify-center h-full px-12 text-center">
          <h1 class="text-2xl font-bold m-0">Sign in</h1>
          <span class="text-sm text-gray-600 my-3">Access sponsor dashboard</span>
          <input type="email" placeholder="Email"
            class="bg-gray-100 border-none p-3 my-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
            required />
          <input type="password" placeholder="Password"
            class="bg-gray-100 border-none p-3 my-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
            required />
          <button type="submit"
            class="mt-4 rounded-full border border-blue-600 bg-blue-600 text-white text-xs font-bold py-3 px-11 uppercase tracking-wider transition-transform active:scale-95 hover:bg-blue-700">
            Sign In
          </button>
        </form>
      </div>

      <div
        class="overlay-container absolute top-0 left-1/2 w-1/2 h-full overflow-hidden transition-transform duration-700 ease-in-out z-[100]">
        <div
          class="overlay bg-gradient-to-r from-blue-500 to-indigo-600 text-white relative -left-full h-full w-[200%] transform translate-x-0 transition-transform duration-700 ease-in-out">

          <div
            class="overlay-panel overlay-left absolute flex flex-col items-center justify-center h-full w-1/2 px-10 text-center top-0 transform -translate-x-[20%] transition-transform duration-700 ease-in-out">
            <h1 class="text-2xl font-bold text-white">Welcome Back!</h1>
            <p class="text-sm my-5">Keep connected with us by logging in with your sponsor info</p>
            <button @click="isSignUp = false"
              class="rounded-full border border-white bg-transparent text-white text-xs font-bold py-3 px-11 uppercase tracking-wider transition-transform active:scale-95">
              Sign In
            </button>
          </div>

          <div
            class="overlay-panel overlay-right absolute flex flex-col items-center justify-center h-full w-1/2 px-10 text-center top-0 right-0 transform translate-x-0 transition-transform duration-700 ease-in-out">
            <h1 class="text-2xl font-bold text-white">Hello, Sponsor!</h1>
            <p class="text-sm my-5">Register your company details and start sponsoring projects</p>
            <button @click="isSignUp = true"
              class="rounded-full border border-white bg-transparent text-white text-xs font-bold py-3 px-11 uppercase tracking-wider transition-transform active:scale-95">
              Sign Up
            </button>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive } from 'vue';

const isSignUp = ref(false);

const formData = reactive({
  role: "sponsor", // Automatically set to sponsor
  company_name: "",
  email: "",
  password: ""
});

const handleRegister = () => {
  console.log("Payload captured:", formData);
  // Example: axios.post('/api/register', formData)
};

const handleLogin = () => {
  console.log("Login logic here");
};
</script>

<style scoped>
/* Custom animations for the sliding mechanism */
.container.right-panel-active .sign-in-container {
  transform: translateX(100%);
}

.container.right-panel-active .sign-up-container {
  transform: translateX(100%);
  opacity: 1;
  z-index: 5;
  animation: show 0.6s;
}

.container.right-panel-active .overlay-container {
  transform: translateX(-100%);
}

.container.right-panel-active .overlay {
  transform: translateX(50%);
}

.container.right-panel-active .overlay-left {
  transform: translateX(0);
}

.container.right-panel-active .overlay-right {
  transform: translateX(20%);
}

@keyframes show {

  0%,
  49.99% {
    opacity: 0;
    z-index: 1;
  }

  50%,
  100% {
    opacity: 1;
    z-index: 5;
  }
}
</style>
