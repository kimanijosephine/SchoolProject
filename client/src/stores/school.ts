import { defineStore } from 'pinia'
import axios from '@/api/axios'
import { useAuthStore } from './auth'
import type { Student } from '@/types'

export const useSchoolStore = defineStore('school', {
  state: () => ({
    students: [] as Student[],
    dashboardStats: {
      total_students: 0,
      active_courses: 0, // Added to match backend
      pending_fees: 0, // Added to match backend
      studentsPerYear: {} as Record<string, number>,
    },
    isLoading: false,
    error: null as string | null,
  }),

  actions: {
    // Helper to ensure headers (useful if axios interceptor isn't catching it)
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
        // Correctly pass the 'year' query param
        const response = await axios.get(`/school/students`, {
          params: { year },
        })
        this.students = response.data
      } catch (error) {
        this.error = error instanceof Error ? error.message : String(error)
      } finally {
        this.isLoading = false
      }
    },

    async uploadData(file: File, type: 'students' | 'marks') {
      this.isLoading = true
      const formData = new FormData()
      formData.append('file', file)

      try {
        await axios.post(`/school/upload/${type}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        await this.fetchStudents()
        return { success: true, message: 'File uploaded successfully' }
      } catch (error) {
        this.error = error instanceof Error ? error.message : String(error)
      } finally {
        this.isLoading = false
      }
    },

    async updateStudentStatus(id: number, status: 'suspended' | 'expelled' | 'active') {
      try {
        // URL Updated to match the /school/students/... prefix in routes
        await axios.patch(`/school/students/${id}/status`, { status })

        // Optimistically update the UI list
        const student = this.students.find((s) => s.id === id)
        if (student) student.status = status
      } catch (error) {
        console.error('Status update failed', error)
      }
    },

    async resetStudentMarks(id: number) {
      if (!confirm('Are you sure? This will clear all marks for this student.')) return
      try {
        // Updated URL to keep the /school prefix consistency
        await axios.delete(`/school/students/${id}/marks`)

        // Refresh the list or show success message
        await this.fetchStudents()
      } catch (err) {
        console.error('Failed to reset marks', err)
      }
    },
  },
})
