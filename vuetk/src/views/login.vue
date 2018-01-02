<template>
<div>
<el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
  <el-form-item label="邮箱" prop="email">
    <el-input v-model="ruleForm.email"></el-input>
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
  export default {
    data() {
      return {
        ruleForm: {
          email: '',
          password: ''
                },
        rules: {
          email: [
            { required: true, message: '请输入邮箱地址', trigger: 'blur' },
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

					/*this.$ajax.post(server.api.login, {
						'grant_type': 'password',
						'client_id': server.client.client_id,
						'client_secret': server.client.client_secret,
						'username': this.ruleForm.email,
						'password': this.ruleForm.password,
						'scope': '*' */

            this.$ajax.post('/oauth/token', {
  						'grant_type': 'password',
  						'client_id': 4,
  						'client_secret': 'dAi5wEtrSA4kOR9kzDD5hBVo2iWMO9HE68d4bzqE',
  						'username': this.ruleForm.email,
  						'password': this.ruleForm.password,
  						'scope': '*'
					}).then((response) => {
					this.$Message.success('登录成功！获取用户信息中...');
						// 提交登录状态
						this.button.text = '登录中...';
						// 全局状态提交 - AccessToken
						this.$store.commit('setAccessToken', response.body.access_token);
						this.$store.commit('login');
						// LocalStorage信息存储
						localStorage.access_token = this.$store.state.access_token;
						// 信息提示
						this.$Message.success('登录成功！获取用户信息中...');
						this.button.text = '获取用户信息中...';
						// 获取用户信息
						this.$ajax.get(server.api.user, {
							headers: {
								'Authorization': 'Bearer ' + this.$store.state.access_token
							}
						}).then((response) => {
							// Vuex全局状态提交 - LoginStatus
							this.$store.commit('setUser', response.body.data);
							this.button.text = '跳转中...';
							// 信息提示
							this.$Message.success('获取信息成功！');
							// 跳转
							setTimeout(() => {
								this.$route.router.go({name: 'account'});
							}, 1000);
						}, (error) => {
							this.button = {
							//	loading: false,
								text: '登录'
							};
							this.$Message.error('获取信息失败！');
						});
					}, (error) => {
						console.log(error);
						//this.button.loading = false;
						this.$Message.error(error.body.message);
					})
          } else {
            this.$Message.error('请填写有效信息！');
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
