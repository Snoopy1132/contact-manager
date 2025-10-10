<template>
  <div class="p-4">
    <h1 class="text-2xl font-semibold mb-2 text-primary">
      Welcome back, {{ user.name }}!
    </h1>
    <p class="text-muted mb-4">Here’s an overview of your contact data.</p>

    <div class="mb-5">
      <p class="text-sm text-gray-500">
        <span class="fw-semibold text-light"> {{ formattedDate }}</span> —
        <span class="fw-semibold text-light"> {{ formattedTime }}</span>
      </p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <a href="/admin/contact" class="text-decoration-none">
          <div class="card shadow-sm border-0 rounded-3 bg-white hover:shadow-lg transition-all cursor-pointer">
            <div class="card-body d-flex align-items-center">
              <div class="bg-success-subtle p-3 rounded-circle me-3">
                <i class="la la-address-book la-2x text-success"></i>
              </div>
              <div>
                <h4 class="text-muted mb-1">Total Contacts</h4>
                <h3 class="mb-0 fw-bold text-dark">{{ contactsCount }}</h3>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

    const el = document.getElementById('vue-dashboard')
    const user = JSON.parse(el.dataset.user)
    const contactsCount = parseInt(el.dataset.contactsCount)

    const formattedDate = ref('')
    const formattedTime = ref('')

    function updateDateTime() {
    const now = new Date()

    formattedDate.value = now.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    })
    formattedTime.value = now.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    })
    }

    onMounted(() => {
        updateDateTime()
        const interval = setInterval(updateDateTime, 1000)
        onUnmounted(() => clearInterval(interval))
    })
</script>
