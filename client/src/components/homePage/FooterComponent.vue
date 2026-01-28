<template>
   <footer class="site-footer">
    <div class="footer-content">
      <div class="footer-column">
        <h3 class="footer-label">Our Vision</h3>
        <p class="footer-text">To be the global benchmark for digital education finance,making quality education accessible through seamless payment technology. </p>
      </div>
    </div>
    <div class="footer-divider">
      <div class="footer-column">
        <h3 class="footer-labl">Our Mission</h3>
        <p class="footer-text">We simplify the bridge between parents and institutions by providing a transparent , secure and instant fee management ecosystem. </p>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2026 School Fees Portal. Securely Encrypted .</p>
    </div>
  </footer>
  
</template>

<script>
export default {
  name: "AppFooter",
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
};
</script>

<style scoped>
.site-footer {
 
  padding: 60px 10%;
  background: linear-gradient(to bottom, #000000, #0f172a); /* Fades from pure black to deep navy */
  border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.footer-content {
  display: flex;
  justify-content: space-between;
  gap: 40px;
  flex-wrap: wrap; /* Stacks on mobile */
  max-width: 1000px;
  margin: 0 auto;
}

.footer-column {
  flex: 1;
  min-width: 280px;
}

.footer-label {
  color: #818cf8; /* That same soft indigo from your body */
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 15px;
}

.footer-text {
  color: #64748b; /* Muted slate color for secondary info */
  line-height: 1.6;
  font-size: 0.95rem;
  font-style: italic; /* Makes Vision/Mission feel more inspirational */
}

/* The vertical line between Mission and Vision */
.footer-divider {
  width: 1px;
  background: rgba(255, 255, 255, 0.1);
  margin: 0 20px;
}

.footer-bottom {
  margin-top: 50px;
  text-align: center;
  border-top: 1px solid rgba(255, 255, 255, 0.05);
  padding-top: 25px;
}

.footer-bottom p {
  color: #475569;
  font-size: 0.8rem;
}

/* Mobile Fix: Hide divider when stacked */
@media (max-width: 768px) {
  .footer-divider { display: none; }
  .footer-content { text-align: center; }
}
</style>
