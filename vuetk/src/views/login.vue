<template>
<div>
<el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
  <el-form-item label="用户名" prop="username">
    <el-input v-model="ruleForm.username"></el-input>
  </el-form-item>
	<el-form-item label="密码" prop="password">
		<el-input v-model="ruleForm.password"></el-input>
	</el-form-item>
	<el-form-item>
    <el-button type="primary" @click="submitForm('ruleForm')">立即登录</el-button>
    <el-button @click="resetForm('ruleForm')">重置</el-button>
<router-link :to="{name: 'register'}">还没有账号？点击注册</router-link> | <router-link :to="{name: 'findpass'}">忘记密码？</router-link>
  </el-form-item>
</el-form>
</div>
</template>
<script>
import server from '../config/api.js';
import config from '../config/config.js';

//import api from '../fetch/api';
//import * as _ from '../util/tool';

  export default {
    data() {
      return {
        ruleForm: {
          username: '',
          password: ''
                },
        rules: {
          username: [
            { required: true, message: '请输入用户名', trigger: 'blur' },
            {  }
          ],
          password: [
            { required: true, message: '请输入密码', trigger: 'change' }
          ]

        }
      };
    },
    methods: {
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {

          this.$ajax.post(server.api.login, {
          						'grant_type': 'password',
  						'client_id': server.client.client_id,
  						'client_secret': server.client.client_secret,
  						'username': this.ruleForm.username,
              'password': this.ruleForm.password,
  						'scope': '*'
					}).then((response) => {
          console.log('成功了');
            console.log(response);
						// 全局状态提交 - AccessToken
						this.$store.commit('setAccessToken', response.data.access_token);
						this.$store.commit('login');
						// LocalStorage信息存储
						localStorage.access_token = this.$store.state.access_token;
						// 信息提示
console.log(response.data.access_token);
console.log(this.$store.state.access_token);
						// 获取用户信息
			//this.$ajax.get(server.api.userDetails, {
      this.$ajax.get('/api/userDetails', {
							headers: {
								'Authorization': 'Bearer ' + this.$store.state.access_token
							}
						}).then((response) => {
							// Vuex全局状态提交 - LoginStatus
              console.log(response.data);
							this.$store.commit('setUser', response.data.user);

							setTimeout(() => {
								this.$router.push({name: 'index'});
							}, 1000);
						}, (error) => {
							this.button = {
							//	loading: false,
								text: '登录'
							};
		console.log('获取信息失败！');
						});
					}, (error) => {
          console.log('哪里错了？');
						console.log(error);
					})
          } else {
          console.log('请填写有效信息！');
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      }
    }
  }
</script>


<style>
	.title { text-align: center; line-height: 200px; }
</style>
