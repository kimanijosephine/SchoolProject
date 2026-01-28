<template lang="html">
    <div>
        <h2>Traditional Systems are Inneficient</h2>

        <p>The Education industry is often hindered by mis-management, opacity and outdated processes. We’ve rebuilt the system from the ground up to ensure every dollar is accounted for and every student is supported.</p>
    </div>
    <div>
        <h2>Our Pillars</h2>
        <ul>
            <li v-for="pillar in pillars" :key="pillar.title">
                <h3>{{ pillar.title }}</h3>
                <p>{{ pillar.challenge }}</p>
                <p>{{ pillar.solution }}</p>
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
const pillars = [
    {
        "title": "Fees Payment",
        "challenge": "Fragmented payment processes force parents and students into manual queues, delayed verification, and inconsistent fee records.",
        "solution": "A 24/7 platform where payments are processed online, securely and reflected instantly across student, school, and sponsor records."
    },
    {
        "title": "Transparent Sponsorship",
        "challenge": "Education funding often flows into pooled accounts, leaving donors uncertain about impact and schools burdened with manual allocation.",
        "solution": "Governed Sponsorship Allocation: Sponsors fund verified student profiles, while schools retain oversight and all transactions remain traceable."
    },
    {
        "title": "Performance Tracking",
        "challenge": "Academic records are isolated in physical files or disconnected systems, limiting meaningful insight for families and sponsors.",
        "solution": "Controlled Academic Visibility: Schools upload results in bulk, enabling authorized stakeholders to view progress without exposing private records."
    },
    {
        "title": "Security & Governance",
        "challenge": "Sensitive academic and financial data is frequently managed through insecure spreadsheets or outdated systems.",
        "solution": "Role-Based System Security: Strong authentication and access control ensure each stakeholder interacts only with approved data and actions."
    }
]

</script>

<style scoped>
    
</style>