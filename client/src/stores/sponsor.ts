import { defineStore } from 'pinia'
import axios from '@/api/axios'
import { useAuthStore } from './auth'
import type { Student } from '@/types'

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
        const response = await axios.get(`/school/dashboard-stats`)
        this.dashboardStats = response.data
      } catch (error) {
        this.error = error instanceof Error ? error.message : String(error)
      } finally {
        this.isLoading = false
      }
    },

    async fetchStudents(year?: number) {
      this.isLoading = true
      try {
        const params = year ? { year } : {}
        const response = await axios.get(`/school/students`, { params })
        this.students = response.data
      } catch (error) {
        this.error = error instanceof Error ? error.message : String(error)
      } finally {
        this.isLoading = false
      }
    },

    // Handles CSV/Excel Uploads
    async uploadData(file: File, type: 'students' | 'marks') {
      this.isLoading = true
      const formData = new FormData()
      formData.append('file', file)
      formData.append('type', type) // Inform backend what kind of upload this is

      try {
        await axios.post(`/school/upload/${type}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            ...this.getHeaders().headers,
          },
        })
        await this.fetchStudents() // Refresh list after upload
        return { success: true, message: 'File uploaded successfully' }
      } catch (error) {
        return { success: false, message: error instanceof Error ? error.message : 'Upload failed' }
      } finally {
        this.isLoading = false
      }
    },

    async updateStudentStatus(id: number, status: 'suspended' | 'expelled' | 'active') {
      try {
        await axios.patch(`/students/${id}/status`, { status })
        // Optimistically update the UI
        const student = this.students.find((s) => s.id === id)
        if (student) student.status = status
      } catch (error) {
        this.error = error instanceof Error ? error.message : String(error)
      }
    },

    async resetStudentMarks(id: number) {
      if (!confirm('Are you sure? This cannot be undone.')) return
      try {
        await axios.delete(`/students/${id}/marks`)
        await this.fetchStudents()
      } catch (err) {
        console.error(err)
      }
    },
  },
})
