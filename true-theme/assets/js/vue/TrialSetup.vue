<template>
<div
  class="tw-max-w-3xl tw-mx-auto tw-pb-24">
  <div class="circle-status-text tw-flex tw-flex-col tw-justify-end tw-text-center tw-pt-24 sm:tw-pt-32 md:tw-pt-2 circle-wrap">
    <div
      :class="{
        'tw-hidden': isAnimationPlaying
      }">
      <trial-circle-status
        :setup-step="setupStep"
        :is-animation-playing="isAnimationPlaying">
      </trial-circle-status>
      <div key="submitting" v-if="setupStep === 'submitting'">
        <h3>Setting up..</h3>
        <p>
          Please wait while we prepare your coreplus instance
        </p>
      </div>
      <div key="email_exists" v-else-if="setupStep === 'email_exists'">
        <h3>Account Already Exists</h3>
        <p>
          You already have a trial account with coreplus. A password reset link has been sent to you.
        </p>
      </div>
      <div key="other_error" v-else-if="setupStep === 'other_error'">
        <h3>Unexpected Issue</h3>
        <p>
          We are unable to process your submission at this time. Please double check your submission and try again later. If issue persists, please contact our support team.
        </p>
      </div>
      <div key="redirecting" v-else-if="setupStep === 'redirecting'">
        <h3>Done!</h3>
        <p>
          Redirecting you to coreplus application
        </p>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import TrialCircleStatus from "./TrialCircleStatus.vue";
export default {
  props: [
    'setup-step',
    'is-animation-playing',
  ],
  components: {
    TrialCircleStatus,
  }
}
</script>

<style scoped>
.circle-wrap {
  padding-top: 9.5%;
  min-height: 340px;
}
</style>
