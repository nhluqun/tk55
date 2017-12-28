<template>
    <div>
        <h1>Hello, Post curd</h1>
        <li v-for="post in posts">
        @{{ post.title }}
        @{{ post.body }}
        <button type="button" @click="modify(post)">修改</button>
<button type="button" @click="remove(post.id)">删除</button>
        </li>
<form >
<input name='da' />
<input name='xzttext' />
<button type="button" @click="publish()">保存</button>
</form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
            post: {
                id: null,
                title: '',
                body: ''
            },
            titleWarning: false,
            bodyWarning: false,
            isSave: false
        }
    },

    methods: {
        init: function () {
            let self = this;
            axios.get('/api/posts')
                .then(function (response) {
                    self.posts  = response.data;
                })
                .catch(function (response) {
                    console.log(response);
                });
        },

        publish: function () {
            this.titleWarning = (this.post.title.trim().length == 0);
            this.bodyWarning = (this.post.body.trim().length == 0);
            if (this.titleWarning || this.bodyWarning) return;
            //
            let self = this;
            axios.post('/api/posts', this.post)
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        self.titleWarning = false;
                        self.bodyWarning = false;
                        self.post = {title:'', body:''};
                    }
                })
                .catch(function (response) {
                    console.log(response)
                });
        },

        modify: function (post) {
            location.href = "#form";
            this.post.id = post.id;
            this.post.title = post.title;
            this.post.body = post.body;
            this.isSave = true;
            console.log(this.post);
        },

        save: function () {
            let self = this;
            axios.put('/api/posts/' + this.post.id, this.post)
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        self.isSave = false;
                        self.post = {id:null, title: '', body:''};
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });
        },

        cancel: function () {
            this.post = {id: null, title: '', body: ''};
            this.isSave = false;
        },

        remove: function (id) {
            let self = this;
            axios.delete('/api/posts/' + id)
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });
        }
    },

    mounted: function () {
        this.init();
    }
}
</script>

<style>

    .content {
        padding: 20px;
    }
  </style>
