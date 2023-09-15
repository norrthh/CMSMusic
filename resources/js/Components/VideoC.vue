<template>
    <div>
        <video ref="videoElement" class="video-js"></video>
    </div>
</template>

<script>
import videojs from 'video.js';
import 'video.js/dist/video-js.css';

export default {
    props: ['src'],
    mounted() {
        const options = {
            sources: [
                {
                    src: this.src,
                    type: 'video/mp4',
                },
            ],
        };
        this.player = videojs(this.$refs.videoElement, options);
    },
    beforeDestroy() {
        if (this.player) {
            this.player.dispose();
        }
    },
};
</script>

<style>
/* Здесь можно добавить свои стили */
</style>
