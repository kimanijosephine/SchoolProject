<template>
  <footer class="footer">
    <h2>Our Mission</h2>
    <p>
      To provide a reliable, transparent, and user-friendly platform that
      simplifies the fees payment process and enhances efficiency for
      students, parents, and institutions.
    </p>
    <p>© {{ year }} SchoolPay</p>
    <small>Simplifying school fees payment</small>
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
.footer {
  background: green ;
  text-align: center;
  padding: 20px;
  margin-top: 50px;
}
</style>
