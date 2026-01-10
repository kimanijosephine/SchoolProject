export interface schoolFormData {
  role: string
  name?: string
  email: string
  password: string
}
export interface donorFormData {
  role: string
  company_name?: string
  email: string
  password: string
}

export interface User {
  name: string
  email: string
}

export interface AuthResponse {
  access_token: string
  token_type: string
  expires_in: number
  user: User
  role: string
}
