<template lang="html">
  <div class="form-viewport">
  <div class="progress-container">
    <!--It is a way to tell vue "Only add the CSS class active if this condition is true"-->
    <div class="dot" :class="{active: currentStep ===1}" ></div>
    <div class="dot" :class="{active: currentStep ===2}" ></div>
    <div class="dot"  :class="{active: currentStep ===3}"></div>
  </div>

  <h2>Payment made easy.</h2>

  <form id="feeform" @submit.prevent="handlePayment">
    <div class="form-slider" :style="{transform: 'translateX(-${currentStep -1}*33.333%)'}">

        <!--Step one in the form-->
      <div class="form-step">
        <h3>Step 1: School Details</h3>
        <div class="form-group">
          <label>County of the School</label>
          <select v-model="formData.county" required>
            <option value="">Select county</option>
            <option>Nairobi</option><!--All the 47 counties come here -->
            <option>Kiambu</option>
          </select>
        </div>

        <div class="form-group">
          <label>School Name</label>
          <select v-model="formData.school" required>
            <option value="">Select school</option>
            <option>ABC Academy</option><!--All the schools come here -->
            <option>Sunrise School</option>
          </select>
        </div>

        <!--The first continue button-->
        <div class="btn-group">
          <button type="button" class="btn btn-next"@click="nextStep">Continue</button>
        </div>
      </div>

      <!--The second step in the form-->
      <div class="form-step">
        <h3>Step 2: Student Info</h3>
        <div class="form-group">
          <label>Student ID</label>
          <input type="text" v-model="formData.studentId" placeholder="Enter ID" required>
        </div>
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" placeholder="Enter Name" required>
        </div>
        <!--the second button-->
        <div class="btn-group">
          <button type="button" class="btn btn-back" @click="prevStep">Back</button>
          <button type="button" class="btn btn-next" @click="nextStep">Continue</button>
        </div>
      </div>

      <!--The third step in the form -->
      <div class="form-step">
        <h3>Step 3: Payment Details</h3>
        <div class="form-group">
          <label>Select Bank</label>
            <select v-model="formData.bank" required>
              <option value="">-- Choose a Bank --</option>
              <option value="kcb">KCB Bank</option>
              <option value="equity">Equity Bank</option>
             <option value="coop">Co-operative Bank</option>
             <option value="abs">ABSA Bank</option>
            </select>
       </div>
        <div class="form-group">
          <label>Amount to Pay (Ksh)</label>
          <input type="number" v-model="formData.amount" placeholder="0.00">
        </div>
        <div class="form-group">
          <label>Remaining Balance</label>
          <input type="text" :value="remainingBalance"  readonly>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-back" @click="prevStep">Back</button>
          <button type="submit" class="btn btn-pay">Confirm Payment</button>
        </div>
      </div>

    </div>
  </form>
</div>
</template>
<script>
export default {
    
}
</script>
<style scoped>
  * { box-sizing: border-box; font-family: "Segoe UI", Tahoma, sans-serif; }
    
    body { 
      background: #87CEEB; 
      min-height: 100vh; 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      margin: 0; 
      overflow-x: hidden; /* Prevents scrollbars during animation */
    }

    /* The viewport that clips the extra pages */
    .form-viewport {
      background: #ffffff;
      width: 100%;
      max-width: 500px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden; /* This hides the pages that aren't active */
    }

    /* The long container that holds all pages side-by-side */
    .form-slider {
      display: flex;
      width: 300%; /* 3 pages = 300% */
      transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); /* The "Move" animation */
    }

    /* Each individual page */
    .form-step {
      width: 33.333%; /* Each page takes 1/3 of the slider */
      padding: 30px;
      flex-shrink: 0;
    }

    h2 { text-align: center; color: #172b4d; margin-bottom: 5px; }
    h3 { text-align: center; color: #4a90e2; margin-bottom: 25px; font-size: 16px; }

    .form-group { margin-bottom: 18px; }
    label { display: block; margin-bottom: 6px; font-size: 14px; color: #555; }
    
    input, select {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
      outline: none;
    }

    input:focus { border-color: #4a90e2; }
    input[readonly] { background-color: #f3f3f3; }

    /* Buttons */
    .btn-group { display: flex; justify-content: space-between; gap: 15px; margin-top: 30px; }
    .btn { padding: 14px 20px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s; }
    .btn-next { background-color: #4a90e2; color: white; flex: 2; }
    .btn-back { background-color: #f1f5f9; color: #475569; flex: 1; }
    .btn-pay { background: linear-gradient(135deg, #28a745, #218838); color: white; flex: 2; }
    
    .btn:active { transform: scale(0.98); }

    /* Progress Dots */
    .progress-container {
      display: flex;
      justify-content: center;
      gap: 10px;
      padding-top: 20px;
    }
    .dot { width: 10px; height: 10px; border-radius: 50%; background: #ddd; transition: 0.3s; }
    .dot.active { background: #4a90e2; width: 25px; border-radius: 10px; }
    
</style>