import { defineStore } from 'pinia'
import axios from '@/api/axios'
import type { Sponsor, DashboardStats } from '@/types'

export const useSponsorStore = defineStore('sponsor', {
  state: () => ({
    sponsor: [] as Sponsor[],
    dashboardStats: {
      total_students: 0,
      studentsPerYear: {},
      wallet_balance: 0
    } as DashboardStats,
    isLoading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchDashboardStats() {
      this.isLoading = true
      this.error = null
      try {
        // Axios will use the base URL and interceptors defined in your @/api/axios
        const response = await axios.get('/sponsor-portal')
        this.dashboardStats = response.data
      } catch (error: any) {
        this.error = error.response?.data?.message || 'Failed to fetch dashboard data'
        console.error("Dashboard Fetch Error:", error)
      } finally {
        this.isLoading = false
      }
    },
  },
})
