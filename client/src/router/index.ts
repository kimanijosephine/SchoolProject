import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import HomeView from '../views/HomeView.vue'
import TestView from '@/views/TestView.vue'
import SchoolLogin from '@/views/AuthVue/SchoolLogin.vue'
import DonorLogin from '@/views/AuthVue/DonorLogin.vue'
import StudentLogin from '@/views/AuthVue/StudentLogin.vue'
import SchoolDashboard from '@/views/SchoolDashboard.vue'
import DonorDashboard from '@/views/DonorDashboard.vue'
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

    // Dashboard routes pending authentication implementation
    {
      path: '/school-dashboard',
      name: 'school-dashboard',
      component: SchoolDashboard,
      meta: { requiresAuth: true, role: 'school' },
    },
    {
      path: '/donor-dashboard',
      name: 'donor-dashboard',
      component: DonorDashboard,
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

  // 1. Check if route requires login
  if (to.meta.requiresAuth) {
    if (!authStore.isAuthenticated) {
      // Not logged in? Redirect to home or a specific login
      return next({ name: 'home' })
    }

    // 2. Check Role Authorization
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
