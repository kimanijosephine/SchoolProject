import { defineStore } from 'pinia'
import axios from 'axios'
import { useAuthStore } from './auth'

const serverUrl = import.meta.env.VITE_API_URL

export interface Student {
  id: number
  name: string
  registration_number: string
  year: number
  status: 'active' | 'suspended' | 'expelled'
  marks?: Record<string, number>
}

export const useSchoolStore = defineStore('school', {
  state: () => ({
    students: [] as Student[],
    dashboardStats: {
      totalStudents: 0,
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
        const response = await axios.get(`${serverUrl}/dashboard/stats`)
        this.dashboardStats = response.data
      } catch (err: any) {
        this.error = err.message
      } finally {
        this.isLoading = false
      }
    },

    async fetchStudents(year?: number) {
      this.isLoading = true
      try {
        const params = year ? { year } : {}
        const response = await axios.get(`${serverUrl}/students`, { params })
        this.students = response.data
      } catch (err: any) {
        this.error = err.message
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
        await axios.post(`${serverUrl}/upload/${type}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            ...this.getHeaders().headers,
          },
        })
        await this.fetchStudents() // Refresh list after upload
        return { success: true, message: 'File uploaded successfully' }
      } catch (err: any) {
        return { success: false, message: err.response?.data?.message || 'Upload failed' }
      } finally {
        this.isLoading = false
      }
    },

    async updateStudentStatus(id: number, status: 'suspended' | 'expelled' | 'active') {
      try {
        await axios.patch(`${serverUrl}/students/${id}/status`, { status })
        // Optimistically update the UI
        const student = this.students.find((s) => s.id === id)
        if (student) student.status = status
      } catch (err: any) {
        this.error = 'Failed to update status'
      }
    },

    async resetStudentMarks(id: number) {
      if (!confirm('Are you sure? This cannot be undone.')) return
      try {
        await axios.delete(`${serverUrl}/students/${id}/marks`)
        await this.fetchStudents()
      } catch (err) {
        console.error(err)
      }
    },
  },
})
