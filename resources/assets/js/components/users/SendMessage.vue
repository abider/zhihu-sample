<template>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" :disabled="!login" data-target="#messageModal">
            写私信
        </button>

        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">
                            {{ title}}
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
                                    私信发送成功！
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" @click="send">发送</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                default() {
                    return 'null';
                }
            },
            url: {
                type: String,
                default() {
                    return 'api/users/message';
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
            title() {
                return '发送私信给 ' + this.name;
            },
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
                        $('#messageModal').modal('toggle')
                    }
                })
            }
        }
    }
</script>
