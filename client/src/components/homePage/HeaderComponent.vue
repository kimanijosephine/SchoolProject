<template lang="html">
  <div class="page-wrapper">

      <!--represents introductory content -->
  <header class="header">

    <!--This is the Logo of the page -->
       <img src="@/assets/Fees_Logo.png" alt="School Fees Logo " class="w-[80px] h-[60px]"/>

      <!--The Banner Section-->
      <div class="welcome-banner">
        <span class="sparkle">====</span>
      <p class="banner-text">
        Welcome to the future of education payments.</p>
        <span class="sparkle">====</span>    
     </div>
        <router-link to=".../StudentLogin" class="card-btn">Enter Portal</router-link> 
  </header>

  <main class="main-body">
    <div class="feature-grid">

      <section class="info-card">
        <div class="card-header">
          <span class="card-iron">===</span>
          <h2>Why choose Online Fees Payment?</h2>
        </div>
        <p class="card-tagline">Efficiency at your fingertips</p>
        <ul class="clean-list">
          <li><strong>Instant Clearance:</strong>No more waiting for bank slips to process. </li>
          <li><strong>Bank-Level Security:</strong>Your data is encrypted and safe</li>
          <li><strong>Total Transparency:</strong>Access your full payment history 24/7 </li>
        </ul>
      </section>

      <section class="info-card featured-card">
        <div class="card-header">
          <span class="card-iron">===</span>
          <h2>Three Simple Steps</h2>
        </div>
        <p class="card-tagline">Pay in under 60 seconds.</p>
        <ol class="step-list">
          <li>Identify your student account</li>
          <li>Review your balance </li>
          <li>Securely checkout</li>
        </ol>
        <router-link to="/login" class="card-btn">Enter Portal</router-link>
      </section>
    </div>
  </main>
  </div>
</template>

<script setup lang="ts">

</script>

<style scoped>
/*Styyling of the bidy part*/
.main-body {
  max-width: 1100px;
  margin: 0 auto;
  padding: 40px 20px;
}
.feature-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 30px;
  margin-top: 20px;
}
.info-card {
  background: #111827; /* Very dark gray, looks better than pure black on black */
  padding: 40px;
  border-radius: 24px;
  border: 1px solid rgba(255, 255, 255, 0.05);
  transition: all 0.4s ease;
}
.info-card:hover {
  border-color: rgba(129, 140, 248, 0.4);
  transform: translateY(-5px);
}
.featured-card {
  background: linear-gradient(145deg, #111827, #1e1b4b);
  border: 1px solid rgba(129, 140, 248, 0.2);
}
.card-icon {
  font-size: 2rem;
  display: block;
  margin-bottom: 15px;
}

.h2 {
  color: #ffffff;
  font-size: 1.6rem;
  font-weight: 700;
  margin-bottom: 8px;
  text-align: left; /* Aligned left looks more modern for cards */
}

.card-tagline {
  color: #818cf8;
  font-size: 0.9rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 25px;
}

/* Lists Styling */
.clean-list, .step-list {
  color: #94a3b8;
  padding-left: 18px;
  line-height: 1.8;
}

.clean-list li::marker { color: #4f46e5; }

.card-btn {
  display: inline-block;
  margin-top: 30px;
  color: #ffffff;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  border-bottom: 2px solid #4f46e5;
  padding-bottom: 4px;
  transition: 0.3s;
}

.card-btn:hover {
  color: #818cf8;
  border-color: #818cf8;
}

/* Hero Section Container */
.hero-section {
  position: relative;
  text-align: center;
  padding: 80px 20px;
  overflow: hidden; /* Keeps the glow effects inside */
}
/* Trust Badge 
.trust-badge {
  display: inline-block;
  padding: 8px 16px;
  background: rgba(79, 70, 229, 0.1);
  color: green ;
  border-radius: 50px;
  font-size: 0.9rem;
  font-weight: 600;
  margin-bottom: 20px;
}*/
/* 1. Overall Page Style */
.page-wrapper {
  background-color:white ;
  min-height: 100vh;
  font-family: 'Inter', sans-serif;
}
.container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 40px 20px;
}
/* Beautiful Header */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 10%;
  background-color:black ;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  position: sticky;
  top: 0;
  z-index: 1000;
  min-height: 70 px;
}
/* The Welcome Banner Styling */
.welcome-banner {
  display: flex;
  align-items: center;
  gap: 12px;
  animation: fadeIn 1.5s ease-in-out;
}
/*Banner Text*/
.banner-text {
  text-align: center;
  color: yellow; 
  font-size: 0.95rem;
  font-weight: 400;
  font-style: italic;
  letter-spacing: 1px;
  margin: 0;
  border-left: 1px solid rgba(255, 255, 255, 0.2);
  padding-left: 15px;
}
.sparkle {
  font-size: 0.8rem;
  opacity: 0.8;
}
/* Simple Action Link */
.portal-link {
  color: #ffffff;
  text-decoration: none;
  font-size: 0.9rem;
  font-weight: 600;
  padding: 8px 18px;
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 50px;
  transition: all 0.3s ease;
}
.portal-link:hover {
  background: white;
  color: #0f172a;
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




.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background-color: blue ;
  color: white;
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
