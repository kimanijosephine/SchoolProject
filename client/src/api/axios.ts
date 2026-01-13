import axios from 'axios'
import { useAuthStore } from '@/stores/auth'

const instance = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
})

instance.interceptors.request.use((config) => {
  const authStore = useAuthStore() // Pinia works inside functions!
  if (authStore.token) {
    config.headers.Authorization = `Bearer ${authStore.token}`
    // console.log('added auth header')
  }
  return config
})

export default instance
