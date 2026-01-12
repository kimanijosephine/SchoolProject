export interface AuthFormData {
  role: string
  email: string
  password: string
  name?: string
  company_name?: string
}

export interface User {
  name?: string
  email: string
  company_name?: string
}

export interface AuthResponse {
  access_token: string
  token_type: string
  expires_in: number
  user: User
  role: 'school' | 'sponsor' | 'student' | 'admin'
}
