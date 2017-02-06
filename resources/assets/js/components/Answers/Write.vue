<template>
    <div>
        <button type="button" class="btn btn-primary btn-block" :disabled="!login" data-toggle="modal" data-target="#answerModal">
            写回答
        </button>

        <div class="modal fade" id="answerModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">
                            {{ title }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <textarea class="form-control" id="message-text" v-model="body" v-if="!status" required></textarea>
                                <div class="alert alert-success" v-if="status">
                                    感谢您的回答！
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" @click="send">提交</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                default() {
                    return 'null';
                }
            },
            url: {
                type: String,
                default() {
                    return '/api/answers/store';
                }
            }
        },
        data() {
            return {
                body: '',
                status: false
            }
        },
        computed: {
            login() {
                return Laravel.apiToken.length > 0;
            }
        },
        methods: {
            send() {
                axios.post(this.url, {
                    body: this.body
                }).then((response) => {
                    this.status = response.data.result
                    if (this.status) {
                        $('#answerModal').modal('toggle')
                    }
                })
            }
        }
    }
</script>
