<template lang="html">

  <nav className="sticky top-0 z-50 bg-white shadow-sm  w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-20">
            <div className="flex items-center gap-2">
              <div className="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                <span className="text-white font-bold text-lg">E</span>
              </div>
              <span className="text-2xl font-bold text-blue-600">EDU</span>
            </div>

            <div className="hidden md:flex items-center gap-8">
              <button className="text-gray-600 hover:text-blue-600 font-medium">About</button>
              <button className="text-gray-600 hover:text-blue-600 font-medium">Features</button>
              <button className="text-gray-600 hover:text-blue-600 font-medium">Contact</button>
            </div>

            <div class="relative inline-block">
              <!-- Toggle button -->
              <button @click="toggleLogin" class="px-6 py-2.5 text-blue-600 border-blue-600 border  font-semibold hover:bg-blue-50 rounded-full transition">
                Login
              </button>
              <div v-if="openLogin" class="absolute mt-2 w-36 right-1 bg-white  rounded shadow-xl p-3">
                <RouterLink v-for="link in loginLinks" :key="link.link" :to="link.link" class="block px-4 py-2 hover:bg-gray-100" @click="openLogin = false">{{ link.title }}</RouterLink>
              </div>
            </div>


          

            <!-- <div className="flex gap-3">
              <button className="px-6 py-2.5 text-blue-600 font-semibold hover:bg-blue-50 rounded-lg transition">
                Login
              </button>
              <button className="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">
                Register
              </button>
            </div> -->
          </div>
        </div>
      </nav>
  <!-- <nav class="w-3xl max-w-full  p-5 flex justify-between items-center">
    <a href="/" class="text-blue-500 font-bold">EDU</a>
    <div>
         Login dropdown 
        <button>Login</button>
        <div>
            <router-link to="/donor-auth">As a Donor</router-link>
            <router-link to="/school-auth">As a School</router-link>
            <router-link to="/student-auth">As a Student</router-link>
        </div>

         Register dropdown 
        <button>Register</button>
        <div>
            <router-link to="/donor-auth">As a Donor</router-link>
            <router-link to="/school-auth">As a School</router-link>
            <router-link to="/student-auth">As a Student</router-link>
        </div>
    </div>
  </nav> -->
  <!-- <div class="page-wrapper">
  <header class="header">
    <div class="logo">
      <h2>SCHOOL <span >FEES</span> </h2>
    </div>

    <nav class="nav">
      <router-link to="/">Home</router-link>
      <router-link to="/login">Login</router-link>
      <router-link to="/register">Register</router-link>
    </nav>
  </header>
  <div>
    <main class="container">
      <div class="hero-section">
        <h1 class="heading">Welcome to the Online Fees Payment System</h1>

    <p class="intro-text">
      Our Online Fees Payment System provides a simple, secure, and efficient
      way for students and parents to pay school fees anytime, anywhere.
      The system is designed to eliminate long queues, reduce paperwork,
      and ensure accurate and transparent fee transactions.
    </p>
    </div>
    <div class="content-columns">
      <section class="column">
    <h2>Why Use Our System?</h2>
    <ul>
      <li>Easy and convenient online payments</li>
      <li>Secure transactions</li>
      <li>Instant payment confirmation</li>
      <li>Accurate fee records</li>
      <li>24/7 accessibility</li>
    </ul>
    </section>
    <section class="column">
    <h2>How It Works</h2>
    <ol>
      <li>Log in to the system using your credentials</li>
      <li>View your fee balance and payment details</li>
      <li>Select a payment method and make payment</li>
      <li>Receive instant confirmation and receipt</li>
    </ol>
    </section>
    </div>
  <footer class="mission-section">
    <h2>Our Mission</h2>
    <p>
      To provide a reliable, transparent, and user-friendly platform that
      simplifies the fees payment process and enhances efficiency for
      students, parents, and institutions.
    </p>
  </footer>
  </main>
  </div>
  </div> -->
</template>

<script setup lang="ts">
import { ref } from "vue"

const openRegister = ref(false)
const openLogin = ref(false)

const toggleRegister = () => {
    openRegister.value = !openRegister.value
}

const toggleLogin = () => {
    openLogin.value = !openLogin.value
}


const registerLinks = [
    {
        title: "As a Donor",
        link: "/donor-auth"
    },
    {
        title: "As a School",
        link: "/school-auth"
    },
    {
        title: "As a Student",
        link: "/student-auth"
    }
]

const loginLinks = [
    {
        title: "As a Donor",
        link: "/donor-auth"
    },
    {
        title: "As a School",
        link: "/school-auth"
    },
    {
        title: "As a Student",
        link: "/student-auth"
    }
]
</script>

<style scoped>
</style>
