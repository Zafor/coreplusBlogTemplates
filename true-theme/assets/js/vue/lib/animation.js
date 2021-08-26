import lottie from 'lottie-web';

const ANIMATION_DATA = require('./trial-animation.json')

export default new class {

    setup () {
        let player = document.querySelector('lottie-player')
        player.load(ANIMATION_DATA)
        return player
    }
}
