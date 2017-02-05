<template>
    <span>
        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" :data-target="dialogTypeId">
            评论 ({{ commentsCount }})
        </button>

        <div class="modal fade" :id="dialogType" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentsModalLabel">
                            评论列表
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card form-group" v-for="comment in comments">
                            <div class="card-block">
                                {{ comment.body }}
                            </div>
                            <div class="card-footer">
                                <img width="40" class="img-thumbnail rounded-circle" :src="comment.user.avatar" :alt="comment.user.name">
                                {{ comment.user.name }}
                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <input class="form-control" id="message-text" v-model="body" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" @click="store">评论</button>
                    </div>
                </div>
            </div>
        </div>
    </span>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default() {
                    return 'null';
                }
            },
            url: {
                type: String,
                default() {
                    return 'null';
                }
            },
            id: {
                type: Number,
                default() {
                    return 0;
                }
            }
        },
        data() {
            return {
                body: '',
                comments: [],
            }
        },
        mounted() {
            this.getComments();
        },
        computed: {
            dialogType() {
                return 'comments-dialog-' + this.type + '-' + this.id;
            },
            dialogTypeId() {
                return '#' + this.dialogType;
            },
            commentsCount() {
                return this.comments.length;
            }
        },
        methods: {
            store() {
                axios.post('/api/comments', {
                    body: this.body,
                    type: this.type,
                    id: this.id
                }).then((response) => {
                    this.comments.push(response.data);
                    this.body = '';
                })
            },
            getComments() {
                axios.get(this.url).then((response) => {
                    response.data.comments.forEach((comment) => {
                        this.comments.push(comment);
                    })
                })
            }
        }
    }
</script>
