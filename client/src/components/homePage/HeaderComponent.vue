<template lang="html">
  <nav class="w-3xl max-w-full  p-5 flex justify-between items-center">
    <a href="/" class="text-blue-500 font-bold">EDU</a>
    <div>
        <!-- Login dropdown -->
        <button>Login</button>
        <div>
            <router-link to="/donor-auth">As a Donor</router-link>
            <router-link to="/school-auth">As a School</router-link>
            <router-link to="/student-auth">As a Student</router-link>
        </div>

        <!-- Register dropdown -->
        <button>Register</button>
        <div>
            <router-link to="/donor-auth">As a Donor</router-link>
            <router-link to="/school-auth">As a School</router-link>
            <router-link to="/student-auth">As a Student</router-link>
        </div>
    </div>
  </nav>
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

</script>

<style scoped>
</style>
