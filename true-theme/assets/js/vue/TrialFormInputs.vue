<template>
<form
  class="trial-contact-form"
  action="javascript:;"
  @submit="$emit('submit')">
    <form-input
        placeholder="First Name"
        :errors="errors"
        :field-key="'firstname'"
        v-model="inputs.firstname"></form-input>
    <form-input
        placeholder="Last Name"
        :errors="errors"
        :field-key="'lastname'"
        v-model="inputs.lastname"></form-input>
    <form-input
        placeholder="Email"
        :errors="errors"
        :field-key="'email'"
        v-model="inputs.email"></form-input>
    <form-input
        placeholder="Promo Code (optional)"
        :errors="errors"
        :field-key="'promocode'"
        v-model="inputs.promocode"></form-input>
    <form-checkbox
        :label="termsHtml"
        :errors="errors"
        :field-key="'accept_terms'"
        v-model="inputs.accept_terms"></form-checkbox>
    <!-- <form-checkbox
        :label="clickwrapHtml"
        :errors="errors"
        :field-key="'accept_clickwrap'"
        v-model="inputs.accept_clickwrap"></form-checkbox> -->
    <div class="tw-mt-8">
      <button type="submit"
        @click.prevent="$emit('submit')"
        class="btn btn-block btn--small-shadow btn--colour-orange tw-py-6 tw-text-base md:tw-text-lg"
        :class="{
          'tw-opacity-50 tw-cursor-not-allowed': isSubmitting
        }"
        :disabled="isSubmitting">
        <span v-if="!isSubmitting">
          <span class="tw-hidden md:tw-block">Create my coreplus digital HEALTH practice</span>
          <span class="tw-block md:tw-hidden">Create Account</span>
        </span>
        <span v-else>Please wait..</span>
      </button>
    </div>
</form>
</template>

<script>
import FormInput from "./FormInput.vue";
import FormCheckbox from "./FormCheckbox.vue";
export default {
  props: [
    'inputs',
    'errors',
    'is-submitting',
  ],
  data () {
    return {
      termsHtml: `I accept coreplus's <a class="tw-text-gray-600 tw-underline hover:tw-text-primary" href="https://www.coreplus.com.au/terms-of-use/" target="_blank">Terms of Use</a>, <a class="tw-text-gray-600 tw-underline hover:tw-text-primary" href="https://www.coreplus.com.au/privacy-policy/" target="_blank">Privacy Policy</a> and <a class="tw-text-gray-600 tw-underline hover:tw-text-primary" href="https://www.coreplus.com.au/clickwrap/" target="_blank">Clickwrap License Agreement</a>`,
      // clickwrapHtml: `I accept coreplus's <a class="tw-text-gray-600 tw-underline hover:tw-text-primary" href="https://www.coreplus.com.au/clickwrap/" target="_blank">Clickwrap License Agreement</a>`,
    }
  },
  components: {
    FormInput,
    FormCheckbox,
  }
}
</script>

<style>
</style>
