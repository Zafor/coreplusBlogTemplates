<template>
<div class="form-group">
    <input type="text"
        :placeholder="placeholder"
        v-bind:value="value"
        :class="{
          'tw-border-red-500 tw-rounded-b-none': hasError
        }"
        v-on:input="$emit('input', $event.target.value)"
        class="form-control focus:tw-border-primary">
    <div v-if="hasError"
      class="tw-bg-red-500 tw-text-white tw-text-sm tw-text-center tw-px-8 tw-py-3 tw-rounded-b"
      v-html="errorMessage">
    </div>
</div>
</template>

<script>
export default {
  props: {
    value: {
        type: [String],
        default: '',
    },
    type: {
        type: [String],
        default: 'text'
    },
    placeholder: {
        type: [String],
        default: '',
    },
    errors: {
      type: [Object]
    },
    fieldKey: {
      type: [String]
    }
  },
  computed: {
    hasError () {
      if (!this.errors[this.fieldKey]) {
        return false
      }
      return true
    },
    errorMessage () {
      if (!this.errors[this.fieldKey]) {
        return ''
      }
      return this.errors[this.fieldKey]
    }
  }
}
</script>
