import { defineStore } from 'pinia'
import axios from '@/api/axios'
import { useAuthStore } from './auth'
import type { Sponsor } from '@/types'

export const useSponsorStore = defineStore('sponsor', {
  state: () => ({
    sponsor: [] as Sponsor[],
    dashboardStats: {
      total_students: 0,
      studentsPerYear: {} as Record<string, number>,
    },
    isLoading: false,
    error: null as string | null,
  }),

  actions: {
    // Helper to ensure headers are set (redundancy check)
    getHeaders() {
      const authStore = useAuthStore()
      return {
        headers: { Authorization: `Bearer ${authStore.token}` },
      }
    },

    async fetchDashboardStats() {
      this.isLoading = true
      try {
        const response = await axios.get(`/sponsor-portal`)
        this.dashboardStats = response.data
      } catch (error) {
        this.error = error instanceof Error ? error.message : String(error)
      } finally {
        this.isLoading = false
      }
    },

    // async fetchMyStudents(year?: number) {
    //   this.isLoading = true
    //   try {
    //     const params = year ? { year } : {}
    //     const response = await axios.get(`/school/students`, { params })
    //     this.students = response.data
    //   } catch (error) {
    //     this.error = error instanceof Error ? error.message : String(error)
    //   } finally {
    //     this.isLoading = false
    //   }
    // },
  },
})
