export interface AuthFormData {
  role: string
  email: string
  password: string
  name?: string
  company_name?: string
  token?: string
  password_confirmation?: string
}

export interface User {
  name?: string
  email: string
  company_name?: string
  is_first_login?: boolean | number
}

export interface AuthResponse {
  access_token: string
  token_type: string
  expires_in: number
  user: User
  role: 'school' | 'sponsor' | 'student' | 'admin'
  first_login?: boolean
}

export interface Student {
  id: number
  name: string
  registration_number: string
  course_id: string
  year_of_study: number
  class_year: number
  email: string
  school_id: string
  status: 'active' | 'suspended' | 'expelled'
  marks?: Record<string, number>
}

export interface Sponsor {
  id: number
  company_name: string
  email: string
  school_id: string
}

export interface DashboardStats {
  total_students: number
  studentsPerYear: Record<string, number>
  wallet_balance?: number // Added based on your description
}
