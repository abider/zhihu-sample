<template>
    <button type="button" class="btn btn-default btn-block" :class="{ 'btn-danger' : followed }" :disabled="!login" @click="follow">
        {{ text }}
    </button>
</template>

<script>
    export default {
        props: {
            followed: {
                type: Boolean,
                default() {
                    return false;
                }
            },
            url: {
                type: String,
                default() {
                    return '/api/questions/follow';
                }
            }
        },
        computed: {
            text() {
                return this.followed ? '取消关注' : '关注问题';
            },
            login() {
                return Laravel.apiToken.length > 0;
            }
        },
        methods: {
            follow() {
                axios.post(this.url).then((response) => {
                    this.followed = response.data.followed;
                })
            }
        }
    }
</script>
