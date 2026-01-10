import { defineStore } from 'pinia'
import axios from 'axios'
import type { schoolFormData, AuthResponse, User } from '@/types'
const serverUrl = import.meta.env.VITE_API_URL

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user') || 'null') as User | null,
    token: localStorage.getItem('access_token') || null,
    role: localStorage.getItem('role') || null,
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
  },

  actions: {
    // Helper to save data to state and localStorage
    setUserData(data: AuthResponse) {
      this.user = data.user
      this.token = data.access_token
      this.role = data.role

      localStorage.setItem('access_token', data.access_token)
      localStorage.setItem('user', JSON.stringify(data.user))
      localStorage.setItem('role', data.role)

      // Set default axios header for future requests
      axios.defaults.headers.common['Authorization'] = `Bearer ${data.access_token}`
    },

    async register(formData: schoolFormData) {
      try {
        const response = await axios.post(`${serverUrl}/register`, formData)
        this.setUserData(response.data)
        return response.data
      } catch (error) {
        throw error
      }
    },

    async login(credentials: schoolFormData) {
      try {
        const response = await axios.post(`${serverUrl}/login`, credentials)
        this.setUserData(response.data)
        return response.data
      } catch (error) {
        throw error
      }
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
