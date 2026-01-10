import { createRouter, createWebHistory } from 'vue-router'
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
    },
    {
      path: '/donor-dashboard',
      name: 'donor-dashboard',
      component: DonorDashboard,
    },

    // testing route
    {
      path: '/test',
      name: 'test',
      component: TestView,
    },
  ],
})

export default router
