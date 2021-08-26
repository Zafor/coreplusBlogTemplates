<template>
<div class="form-group tw-max-w-2xl tw-mx-auto tw-border tw-py-8 tw-px-6 md:tw-px-12">
    <label class="tw-group tw-cursor-pointer tw-flex tw-items-center">
        <input
            type="checkbox"
            true-value="yes"
            false-value="no"
            @change="onInput"
            class="tw-h-0 tw-w-0 tw-absolute hide-my-checkbox"
            :checked="value === 'yes'">
        <span
          class="tw-flex-shrink-0 tw-mr-6 tw-w-12 tw-h-12 tw-border-gray-300 tw-rounded tw-border tw-inline-flex tw-items-center tw-justify-center "
          :class="{
            'tw-border-gray-300 group-hover:tw-border-gray-500': value === 'no',
            'tw-border-red-500 group-hover:tw-border-gray-500': value === 'no' && hasError,
            'tw-border-primary group-hover:tw-border-primary': value === 'yes',
          }">
          <template
            v-if="value === 'yes'">
          <svg
            class="tw-text-primary tw-h-10 tw-w-10 tw-transform tw-transition tw-ease-in-out tw-duration-150"
            :class="{
              'tw-opacity-0 tw--rotate-45': value === 'no',
              'tw-opacity-100 tw-rotate-0': value === 'yes',
            }"
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
          </svg>
          </template>
        </span>
        <span class="tw-text-sm tw-pt-1">
            <span v-html="label"></span>
        </span>
    </label>
    <div v-if="hasError"
      class="tw-bg-red-500 tw-text-white tw-text-xs tw-text-center tw-px-8 tw-py-3 tw-rounded-b tw-relative">
      <span class="tw-block tw-w-5 tw-h-5 tw-bg-red-500 tw-transform tw-rotate-45 tw-absolute tw-top-0 tw-left-0 tw-ml-3 tw--mt-1"></span>
      <span v-html="errorMessage"></span>
    </div>
</div>
</template>

<!-- <script> -->
<script>
export default {
    props: {
        value: {
            type: [String],
            default: '',
        },
        label: {
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
    data: function () {
        return {
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
    },
    methods: {
        onInput ($event) {
            this.$emit('input', $event.target.checked ? 'yes' : 'no')
        }
    }
}
</script>

<style scoped>
input[type="checkbox"]:focus + span {
  border: 2px solid #F98731;
}
</style>
