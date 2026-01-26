<template lang="html">
  <div class="page-wrapper">
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
  <!--<footer class="mission-section">
    <h2>Our Mission</h2>
    <p>
      To provide a reliable, transparent, and user-friendly platform that
      simplifies the fees payment process and enhances efficiency for
      students, parents, and institutions.
    </p>
  </footer>-->
  </main>
  </div>
  </div>
</template>

<script setup lang="ts">

</script>

<style scoped>
/* 1. Overall Page Style */
.page-wrapper {
  background-color: black  ;
  min-height: 100vh;
  font-family: 'Inter', sans-serif;
}
.container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 40px 20px;
}
/* 2. Beautiful Header */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 10%;
  background-color:black ;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  position: sticky;
  top: 0;
  z-index: 100;
}
.heading{
  display: flex;
  flex-direction: column;
 text-align: center;
 justify-content: center;
 align-items: center;
 min-height:30vh;
}
.intro-text{
text-align: center;     
  max-width: 700px;
  margin: 20px auto;       
  line-height: 1.8;       /*adds space between lines for redability*/ 
   color: blue ;
  font-size: 1.1rem;
}
.content-columns {
  display: flex;            /* Turns the container into a flexbox */
  gap: 40px;               /* Adds space between the two columns */
  justify-content: center;  /* Centers the columns horizontally */
  margin: 40px 0;
  flex-wrap: wrap;         /* Allows columns to stack on small screens */
}
.column {
  flex: 1;                 /* Gives both columns equal width */
  min-width: 300px;        /* Prevents columns from getting too squished */
  background: #ffffff;
  padding: 25px;
  border-radius: 20px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.05); /* Soft "cute" shadow */
  border: 1px solid #f0f0f0;
}
h2 {
  text-align: center;
  color: #5a189a;
  font-size: 1.5rem;
  margin-bottom: 1.5rem;
}

/* Styling the lists inside the columns */
ul, ol {
  color: #4a5568;
  line-height: 0.5;
  padding-left: 20px;
}

li {
  margin-bottom: 10px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background-color: blue ;
  color: white;
}

.logo h2 {
  margin: 0;
}

.nav {
  display: flex;
  gap: 20px;
}

.nav a {
  color: white;
  text-decoration: none;
  font-weight: 500;
}

.nav a.router-link-active {
  text-decoration: underline;
}
/* Make Login/Register look like buttons */
.nav-btn {
  padding: 8px 18px;
  border-radius: 8px;
}
</style>
