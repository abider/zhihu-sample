<template>
    <button type="button" class="btn btn-sm" :class="{ 'btn-primary' : voted, 'btn-outline-primary' : !voted }" @click="vote">
        {{ text }} ({{ voteCount }})
    </button>
</template>

<script>
    export default {
        props: {
            voted: {
                type: Boolean,
                default() {
                    return false;
                }
            },
            voteCount: {
                type: Number,
                default() {
                    return 0;
                }
            },
            url: {
                type: String,
                default() {
                    return '/api/answer/vote';
                }
            }
        },
        computed: {
            text() {
                return this.voted ? '已赞' : '点赞';
            }
        },
        methods: {
            vote() {
                axios.post(this.url).then((response) => {
                    response.data.voted ? this.voteCount++ : this.voteCount--;
                    this.voted = response.data.voted;
                })
            }
        }
    }
</script>
