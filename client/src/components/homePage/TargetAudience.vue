<template lang="html">
    <div>
        <div>
            <h2>Who Participates in EDU</h2>

            <div>
                <h3>Schools</h3>
                <ul>
                    <li v-for="feature in schoolFeatures" :key="feature">{{ feature }}</li>
                </ul>
            </div>
            <div>
                <h3>Students</h3>
                <ul>
                    <li v-for="feature in studentFeatures" :key="feature">{{ feature }}</li>
                </ul>
            </div>
            <div>
                <h3>Donors</h3>
                <ul>
                    <li v-for="feature in donorFeatures" :key="feature">{{ feature }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
const schoolFeatures = [
    "Register and maintain institutional records",
    "Bulk upload verified student data",
    "Submit sponsorship needs for enrolled students",
    "Upload academic performance records",
    "View fee and sponsorship coverage summaries"
]

const studentFeatures = [
    "Access personal fee balance and payment history",
    "Receive sponsorship allocations transparently",
    "View academic performance records",
    "Track sponsorship status linked to their profile",
    "Secure first-login and account ownership"
]

const donorFeatures = [
    "Browse eligible students approved by schools",
    "Sponsor students through a governed wallet system",
    "Receive academic progress updates for sponsored students",
    "View transaction history and funding impact reports"
]

</script>
<style scoped>
    
</style>