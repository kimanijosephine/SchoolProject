import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import HomeView from '../views/HomeView.vue'
import TestView from '@/views/TestView.vue'
import SchoolLogin from '@/views/AuthVue/SchoolLogin.vue'
import DonorLogin from '@/views/AuthVue/DonorLogin.vue'
import StudentLogin from '@/views/AuthVue/StudentLogin.vue'
// import SchoolDashboard from '@/views/SchoolDashboard.vue'
import SchoolDashboard from '@/views/SchoolVue/DashboardView.vue'
import AdminStudentsView from '@/views/SchoolVue/StudentsView.vue'
import UploadsView from '@/views/SchoolVue/UploadsView.vue'
import StudentDashboard from '@/views/StudentVue/StudentDashboard.vue'
import ResetPassword from '@/views/auth/auth/ResetPassword.vue'
import SponsorDashboard from '@/views/SponsorDashboard.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },

    // Auth vue for different user types
    {
      path: '/school-auth',
      name: 'school-auth',
      component: SchoolLogin,
    },
    {
      path: '/donor-auth',
      name: 'donor-auth',
      component: DonorLogin,
    },
    {
      path: '/student-auth',
      name: 'student-auth',
      component: StudentLogin,
    },
    {
      path: '/reset-password/:token',
      name: 'reset-password',
      component: ResetPassword,
    },

    // Dashboard routes pending authentication implementation
    //school dashboards
    {
      path: '/school-dashboard',
      name: 'school-dashboard',
      component: SchoolDashboard,
      meta: { requiresAuth: true, role: 'school' },
    },
    {
      path: '/school-dashboard/students',
      name: 'school-dashboard-students',
      component: AdminStudentsView,
      meta: { requiresAuth: true, role: 'school' },
    },
    {
      path: '/school-dashboard/uploads',
      name: 'school-dashboard-uploads',
      component: UploadsView,
      meta: { requiresAuth: true, role: 'school' },
    },

    // student dashboards
    {
      path: '/student-dashboard',
      name: 'student-dashboard',
      component: StudentDashboard,
      meta: { requiresAuth: true, role: 'student' },
    },
    // donor dashboards
    {
      path: '/sponsor-portal',
      name: 'sponsor-portal',
      component: SponsorDashboard,
      meta: { requiresAuth: true, role: 'sponsor' },
    },

    // testing route
    {
      path: '/test',
      name: 'test',
      component: TestView,
      meta: { requiresAuth: true, role: 'admin' },
    },
  ],
})
// Controll authorized access to routes
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()

  if (to.meta.requiresAuth) {
    if (!authStore.isAuthenticated) {
      return next({ name: 'home' })
    }

    // --- NEW LOGIC START ---
    // If student hasn't reset password, block dashboard access
    if (authStore.role === 'student' && authStore.isFirstLogin) {
      // Allow them to see the reset-password page, but nothing else
      if (to.name !== 'reset-password') {
        alert('Please reset your password via the email link before accessing the dashboard.')
        return next({ name: 'home' }) // or a dedicated 'verify-email' page
      }
    }
    // --- NEW LOGIC END ---

    if (to.meta.role && authStore.role !== to.meta.role) {
      alert('Unauthorized access')
      return next({ name: 'home' })
    }
  }

  // 3. Prevent logged-in users from going to login pages
  const isAuthPage = ['school-auth', 'donor-auth', 'student-auth'].includes(to.name as string)
  if (isAuthPage && authStore.isAuthenticated) {
    // If already logged in, send them to their specific dashboard
    if (authStore.role === 'school') return next({ name: 'school-dashboard' })
    if (authStore.role === 'sponsor') return next({ name: 'donor-dashboard' })
    return next({ name: 'home' })
  }

  next() // Always call next() to finish the hook!
})

export default router
