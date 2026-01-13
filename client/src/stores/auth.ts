import { defineStore } from 'pinia'
import axios from '@/api/axios'
import type { AuthFormData, AuthResponse, User } from '@/types'

// const serverUrl = import.meta.env.VITE_API_URL

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user') || 'null') as User | null,
    token: localStorage.getItem('access_token') || null,
    role: localStorage.getItem('role') || null,
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
    getUserName: (state) => state.user?.name || state.user?.company_name || 'User',
  },

  actions: {
    setUserData(data: AuthResponse) {
      this.user = data.user
      this.token = data.access_token
      this.role = data.role

      localStorage.setItem('access_token', data.access_token)
      localStorage.setItem('user', JSON.stringify(data.user))
      localStorage.setItem('role', data.role)

      axios.defaults.headers.common['Authorization'] = `Bearer ${data.access_token}`
    },

    async register(formData: AuthFormData) {
      const response = await axios.post<AuthResponse>(`/register`, formData)
      //const response = await axios.post<AuthResponse>(`${serverUrl}/register`, formData)

      this.setUserData(response.data)
      return response.data
    },

    async login(credentials: Partial<AuthFormData>) {
      const response = await axios.post<AuthResponse>(`/login`, credentials)
      // const response = await axios.post<AuthResponse>(`${serverUrl}/login`, credentials)

      this.setUserData(response.data)
      return response.data
    },

    logout() {
      this.user = null
      this.token = null
      this.role = null
      localStorage.removeItem('access_token')
      localStorage.removeItem('user')
      localStorage.removeItem('role')
      delete axios.defaults.headers.common['Authorization']
    },
  },
})

//if the user refreshes the page then the headers are reapplied
// const authStore = useAuthStore()
// if (authStore.token) {
//   axios.defaults.headers.common['Authorization'] = `Bearer ${authStore.token}`
// }
