<template>
<div class="tw-relative tw-overflow-hidden tw-pb-8 md:tw-pb-24">
    <div class="tw-w-full tw-fixed tw-z-10 trial-bg-wrap">
      <img
          class="tw-absolute tw-left-0 tw-w-screen tw-h-screen sm:tw-h-auto tw-object-cover tw-object-center"
          :src="cms.bg"
          alt="">
    </div>
    <div class="tw-w-full tw-fixed tw-z-30 trial-bg-wrap tw-pointer-events-none">
      <lottie-player
        mode="normal"
        loop="false"
        class="lottie-player"
        :class="isAnimationHidden || hasServerErrors ? 'tw-opacity-0' : 'tw-opacity-100'">
      </lottie-player>
    </div>
    <!-- <div
      class="trial-animation-wrap tw-pointer-events-none tw-z-30 tw-h-full tw-mx-auto tw-fixed tw-top-0 tw-left-0 tw-items-center tw-justify-center tw-flex tw-transition tw-duration-100 tw-ease-in-out"
      >
    </div> -->
    <div class="tw-relative tw-py-20 tw-overflow-hidden"
        style="">
        <div class="container tw-relative">
          <div class="tw-max-w-800px tw-mx-auto tw-shadow-lg"
            ref="formWrap">
            <div class="tw-bg-primary tw-text-white tw-p-6 sm:tw-py-12 sm:tw-px-16 tw-text-center tw-text-2xl md:tw-text-3xl tw-leading-tight tw-relative tw-z-40"
              v-html="cms.panel_heading">
            </div>
            <div class="trial-form-wrapper tw-py-16 tw-relative">
              <div class="tw-absolute tw-inset-0 tw-bg-white tw-bg-opacity-75 tw-z-10"></div>
              <div class="tw-max-w-5xl tw-mx-auto tw-px-6 md:tw-px-0 tw-relative tw-z-40">
                <div class="tw-pb-12 tw-text-center">
                  <h1 class="tw-text-xl md:tw-text-3xl tw-text-primary tw-mx-auto tw-text-center tw-mb-8"
                    v-html="cms.form_heading">
                  </h1>
                  <p v-html="cms.form_description">
                  </p>
                </div>
                <div v-if="hasServerErrors"
                  class="tw-max-w-3xl tw-mx-auto tw-text-center tw-bg-yellow-100 tw-mb-4 tw-p-6 tw-text-sm">
                  Oops, we have encountered an error when submitting your request.
                  Please try again later or contact us at <a class="tw-text-gray-800 tw-underline" href="mailto:support@coreplus.com.au">support@coreplus.com.au</a> and we will sort this out.
                </div>
                <div v-if="hasErrors"
                  class="tw-max-w-3xl tw-mx-auto tw-text-center tw-text-red-500 tw-mb-4 tw-p-6 tw-text-sm">
                  Whoa there! We can't wait for you to join our digital healthcare community.
                  But first, we will need a few more details.
                </div>
                <div class="trial-inputs-wrap"
                  v-if="step === 'form'">
                  <trial-form-inputs
                    :inputs="inputs"
                    :errors="errors"
                    :is-submitting="isSubmitting"
                    @submit="onSubmit">
                  </trial-form-inputs>
                </div>
                <div class="tw-mx-auto tw-items-center tw-justify-center tw-flex tw-transition tw-duration-100 tw-ease-in-out"
                  v-if="step === 'setup' && !hasServerErrors">
                  <trial-setup
                    :setup-step="setupStep"
                    :is-animation-playing="!isAnimationHidden">
                  </trial-setup>
                </div>
                <div class="tw-mt-12 tw-pt-12 tw-border-t">
                  <div class="tw-max-w-3xl tw-mx-auto tw-text-center tw-space-y-6">
                    <p class="tw-text-base"
                      v-html="cms.form_footer_text">
                    </p>
                    <p class="tw-text-sm">
                      Already have a coreplus account? <a class="tw-underline tw-text-gray-500 hover:tw-text-primary" href="https://coreplus.com.au/intracore/redir.html">Log In</a>
                    </p>
                    <p class="tw-text-sm">
                      Are you a Developer? <a class="tw-underline tw-text-gray-500 hover:tw-text-primary" href="https://developers.coreplus.com.au/">Register for your sandbox account here.</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
</template>

<script>
import { steps } from "./steps";
import { ajax } from "./lib/ajax";
import { disablePageScroll, enablePageScroll } from "scroll-lock";
import Scroll from "./lib/Scroll";
import captcha from "./lib/recaptcha";
import TrialFormInputs from "./TrialFormInputs.vue";
import TrialSetup from "./TrialSetup.vue";
import animation from "./lib/animation";
let CMS = {}
if (window._trial_form) {
  CMS = window._trial_form.cms
}
export default {
  components: {
    TrialFormInputs,
    TrialSetup,
  },
  data: function () {
    return {
      inputs: {
        firstname: '',
        lastname: '',
        email: '',
        promocode: '',
        accept_terms: 'no',
      },
      // inputs: {
      //   firstname: 'James 123',
      //   lastname: 'White',
      //   email: 'james.white@gmail.com',
      //   promocode: '',
      //   accept_terms: 'yes',
      // },
      // 'form' or 'setup'
      step: 'form',
      setupStep: 'submitting',
      setupSteps: steps.submitting,
      setupSuccessRedirect: null,
      hasErrors: false,
      hasServerErrors: false,
      isSubmitting: false,
      errors: {},
      // Animation
      isAnimationHidden: true,
      shouldOverlapBg: false,
      animation: null,
      cms: CMS,
    }
  },
  computed: {
    transitionName () {
      if (this.step === 'form') {
        return 'fade-right'
      }
      return 'fade-left'
    },
    params () {
      return {
        nonce: window._trial_form.nonce,
        firstname: this.inputs.firstname,
        lastname: this.inputs.lastname,
        email: this.inputs.email,
        promocode: this.inputs.promocode,
        accept_terms: this.inputs.accept_terms,
      }
    }
  },
  methods: {
    async onSubmit () {
      this.clear()
      this.isSubmitting = true
      try {
        let token = await captcha.execute()
        disablePageScroll()
        let response = await this.submitValidation({
          token: token
        })
        this.isSubmitting = false
        if (!response.success) {
          this.handleFormErrors(response.data.errors)
          enablePageScroll()
          return
        }
        this.step = 'setup'
        this.setupStep = 'submitting'
        this.scrollToTop()
        this.isAnimationHidden = false
        this.playAnimation()
        let coreplusResponse = await this.submit()
        if (coreplusResponse.success !== true) {
          this.handleSubmitError(coreplusResponse)
          return
        }
        this.setupStep = 'redirecting'
        this.setupSuccessRedirect = coreplusResponse.data.redirect
        if (this.isAnimationHidden) {
          window.location = this.setupSuccessRedirect
        }
      } catch (error) {
        this.hasServerErrors = true
        this.isSubmitting = false
        console.log(error)
        this.scrollToTop()
      }
    },
    submitValidation (additionalParams) {
      return ajax({
        action: 'trial_validate_form',
        ...this.params,
        ...additionalParams
      })
    },
    submit () {
      return ajax({
        action: 'trial_submit',
        ...this.params,
      })
    },
    handleFormErrors (errors) {
      this.step = 'form'
      this.hasErrors = true
      this.errors = errors
      this.scrollToTop()
    },
    handleSubmitError (response) {
      if (response.data.is_account_exists) {
        this.setupStep = 'email_exists'
      } else {
        this.setupStep = 'other_error'
        if (window.Intercom) {
          // Show support chat
          window.Intercom('show')
        }
      }
    },
    clear () {
      this.hasErrors = false
      this.errors = {}
      this.hasServerErrors = false
    },
    scrollToTop () {
      const scroller = new Scroll
      let width = $(window).width()
      if (width <= 960) {
        scroller.scrollTo($(this.$refs.formWrap).offset().top + 30)
        return
      }
      scroller.scrollTo($(this.$refs.formWrap).offset().top)
    },
    playAnimation () {
      this.shouldOverlapBg = false
      this.animation.play()
    }
  },
  mounted () {
    setTimeout(() => {
      this.animation = animation.setup()
      this.animation.addEventListener('loop', () => {
        this.animation.stop()
        this.isAnimationHidden = true
        setTimeout(() => {
          this.animation.seek(0)
          enablePageScroll()
          setTimeout(() => {
            this.shouldOverlapBg = true
          }, 100);
          if (this.setupStep === 'redirecting' && this.setupSuccessRedirect) {
            window.location = this.setupSuccessRedirect
          }
        }, 150);
      })
    }, 250);
  }
}
</script>

<style scoped>
.trial-bg-wrap {
  height: 100vh;
}
@media only screen and (min-width: 767px) {
  .trial-bg-wrap {
    height: 990px;
  }
}
.trial-bg-wrap,
.trial-animation-wrap,
.trial-setup-wrap {
  width: 100vw;
  top: 0;
}
@media only screen and (min-width: 767px) {
  .trial-bg-wrap,
  .trial-animation-wrap,
  .trial-setup-wrap {
    top: 20vh;
  }
}
@media only screen and (min-width: 1280px) {
  .trial-bg-wrap,
  .trial-animation-wrap,
  .trial-setup-wrap {
    top: 10vh;
  }
}
@media only screen and (min-width: 1600px) {
  .trial-bg-wrap,
  .trial-animation-wrap,
  .trial-setup-wrap {
    top: 10vh;
  }
}
@media only screen and (min-width: 1920px) {
  .trial-bg-wrap,
  .trial-animation-wrap,
  .trial-setup-wrap {
    max-width: 1920px;
    margin-left: auto;
    margin-right: auto;
    left: 50%;
    transform: translate(-50%, 0);
  }
}
.trial-inputs-wrap {
  min-height: 480px;
}
.trial-animation-wrap,
.trial-setup-wrap {
  margin-top: 102px;
}
@media only screen and (min-width: 1600px) {
  .trial-animation-wrap,
  .trial-setup-wrap {
    margin-top: 102px;
  }
}
/* .trial-animation-wrap .lottie-player {
  width: 1920px;
  height: 990px;
} */
.trial-bg-wrap img {
  height: 100vh;
}
@media only screen and (min-width: 767px) {
  .trial-bg-wrap img {
    height: auto;
  }
}
@media only screen and (min-width: 1920px) {
  .trial-bg-wrap img {
    width: 1920px;
    margin-left: auto;
    margin-right: auto;
  }
}
.lottie-player {
  width: 194vh;
  top: 50%;
  left: 50%;
  position: absolute;
  transform: translate(-50%, -50%);
}
@media only screen and (min-width: 767px) {
  .lottie-player {
    width: 100%;
    margin-left: 0;
    position: static;
    transform: none;
    top: auto;
    left: auto;
  }
}
.fade-left-enter-active,
.fade-left-leave-active,
.fade-right-enter-active,
.fade-right-leave-active {
  transition: opacity 0.12s linear,
    transform 0.12s ease-in-out;
}
.fade-up-enter-active,
.fade-up-leave-active {
  transition: opacity 0.18s linear,
    transform 0.18s ease-in-out;
}
.slide-up-enter-active,
.slide-up-leave-active {
  transition: opacity 0.18s linear,
    transform 0.18s ease-in-out;
}

.fade-left-leave-to {
  opacity: 0;
  transform: translateX(-30px);
}
.fade-left-enter {
  opacity: 0;
  transform: translateX(30px);
}
.fade-right-enter {
  opacity: 0;
  transform: translateX(-30px);
}
.fade-right-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
.fade-up-enter {
  opacity: 0;
  transform: translateY(15px);
}
.fade-up-leave-to {
  opacity: 0;
  transform: translateY(-15px);
}
.slide-up-enter {
  opacity: 0;
  transform: translateY(50%);
}
.slide-up-leave-to {
  opacity: 0;
  transform: translateY(-50%);
}
</style>
