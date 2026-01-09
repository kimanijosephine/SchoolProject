import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import TestView from '@/views/TestView.vue'
import SchoolLogin from '@/views/LoginVue/SchoolLogin.vue'
import DonorLogin from '@/views/LoginVue/DonorLogin.vue'
import StudentLogin from '@/views/LoginVue/StudentLogin.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/test',
      name: 'test',
      component: TestView,
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
  ],
})

export default router
