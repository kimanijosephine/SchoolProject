<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100 font-sans">
    <div class="bg-white w-[450px] rounded-xl shadow-2xl overflow-hidden">
      <div class="bg-gradient-to-r from-blue-500 to-indigo-600 py-8 text-center text-white">
        <h1 class="text-2xl font-bold">Set New Password</h1>
        <p class="text-xs opacity-90">Please choose a secure password for your account</p>
      </div>

      <form @submit.prevent="handleReset" class="p-8 space-y-4">
        <div>
          <label class="text-xs font-semibold text-gray-500 uppercase">New Password</label>
          <input v-model="form.password" type="password"
            class="bg-gray-100 border-none p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
            required />
        </div>

        <div>
          <label class="text-xs font-semibold text-gray-500 uppercase">Confirm Password</label>
          <input v-model="form.password_confirmation" type="password"
            class="bg-gray-100 border-none p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
            required />
        </div>

        <button type="submit" :disabled="loading"
          class="w-full rounded-full bg-blue-600 text-white text-xs font-bold py-3 uppercase hover:bg-blue-700 transition-all disabled:bg-gray-400">
          {{ loading ? 'Updating...' : 'Update Password' }}
        </button>

        <p v-if="message" class="text-center text-green-600 text-sm mt-2">{{ message }}</p>
        <p v-if="error" class="text-center text-red-600 text-sm mt-2">{{ error }}</p>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { reactive, ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from '@/api/axios';

const route = useRoute();
const router = useRouter();
const loading = ref(false);
const message = ref('');
const error = ref('');

const form = reactive({
  token: '',
  email: '',
  password: '',
  password_confirmation: ''
});

onMounted(() => {
  // Capture data from the URL sent in the email
  form.token = route.params.token as string;
  form.email = route.query.email as string;
});

const handleReset = async () => {
  loading.value = true;
  error.value = '';
  try {
    const response = await axios.post('/reset-password', form);
    message.value = response.data.message;

    // Redirect to login after 2 seconds
    setTimeout(() => router.push('/student-auth'), 2000);
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
};
</script>
