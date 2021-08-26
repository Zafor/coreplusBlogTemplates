const iconClass = 'tw-w-10 tw-h-10'
const iconDatabase = `<svg viewBox="0 0 20 20" fill="currentColor" class="database ${iconClass}"><path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"></path><path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"></path><path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"></path></svg>`
const iconClick = `<svg viewBox="0 0 20 20" fill="currentColor" class="cursor-click ${iconClass}"><path fill-rule="evenodd" d="M6.672 1.911a1 1 0 10-1.932.518l.259.966a1 1 0 001.932-.518l-.26-.966zM2.429 4.74a1 1 0 10-.517 1.932l.966.259a1 1 0 00.517-1.932l-.966-.26zm8.814-.569a1 1 0 00-1.415-1.414l-.707.707a1 1 0 101.415 1.415l.707-.708zm-7.071 7.072l.707-.707A1 1 0 003.465 9.12l-.708.707a1 1 0 001.415 1.415zm3.2-5.171a1 1 0 00-1.3 1.3l4 10a1 1 0 001.823.075l1.38-2.759 3.018 3.02a1 1 0 001.414-1.415l-3.019-3.02 2.76-1.379a1 1 0 00-.076-1.822l-10-4z" clip-rule="evenodd"></path></svg>`
const iconExclamation = `<svg viewBox="0 0 20 20" fill="currentColor" class="exclamation ${iconClass}"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>`
const iconMail = `<svg viewBox="0 0 20 20" fill="currentColor" class="mail ${iconClass}"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>`

export const steps = {
    'processing': [
        {
          label: 'Processing',
          description: 'We are processing your request',
          state: 'loading',
          icon: iconMail,
        },
        {
          label: 'Setting Up',
          description: 'Preparing your coreplus instance',
          state: 'inactive',
          icon: iconDatabase,
        },
        {
          label: 'Launching',
          description: 'Your coreplus instance is ready',
          icon: iconClick,
          state: 'inactive',
        }
    ],
    'submitting': [
        {
          label: 'Processing',
          description: 'We are processing your request',
          state: 'done',
          icon: iconMail,
        },
        {
          label: 'Setting Up',
          description: 'Preparing your coreplus instance',
          state: 'loading',
          icon: iconDatabase,
        },
        {
          label: 'Launching',
          description: 'Your coreplus instance is ready',
          icon: iconClick,
          state: 'inactive',
        }
    ],
    'redirecting': [
        {
          label: 'Processing',
          description: 'We are processing your request',
          state: 'done',
          icon: iconMail,
        },
        {
          label: 'Setting Up',
          description: 'Done!',
          state: 'done',
          icon: iconDatabase,
        },
        {
          label: 'Lauching',
          description: 'Redirecting you to coreplus app',
          state: 'loading',
          icon: iconClick,
        }
    ],
    'email_exists': [
        {
          label: 'Processing',
          description: 'We are processing your request',
          state: 'done',
          icon: iconMail,
        },
        {
          label: 'Setting Up',
          description: 'Preparing your coreplus instance',
          state: 'done',
          icon: iconDatabase,
        },
        {
          label: 'Account Already Exists',
          description: 'You already have a trial account with coreplus. A password reset link has been sent to you.',
          state: 'warn',
          icon: iconExclamation,
        }
    ],
}
