<template>
    <el-row >
        <el-col >
            <h1 >TK <small>地理题库</small></h1>
            <div >
                <router-link :to="{name: 'login'}">登录</router-link> | <router-link :to="{name: 'register'}">注册</router-link>
            </div>
        </el-col>
    </el-row>
</template>

<script>
import config from '../config/config'

export default {
    route: {
        data() {
            document.title = config.web_name;
        }
    },
    data() {
        return {
            web: {
                name: 'TK',
                url: 'http://localhost:8000'
            }
        }
    }
}
</script>

<style>
.page { margin-top: 200px; }
.web-name { font-weight: 200; }
.web-menu { line-height: 30px; }
</style>
