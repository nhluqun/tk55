import config from './api-config'

let api = {
	//注册
	register: config.host + config.prefix + '/user/add',
	//登录
	login: config.host + '/oauth/token',
	// 用户信息
	user: config.host + config.prefix + '/user',
	// 更换密码
	change_password: config.host + config.prefix + '/user/change_password',
}
let client = {
	client_id: '7',
	client_secret: 'v2tlPgfokYwUsAOlxOE0T0BaBdiPrBqPeIlb3XMB'
}

export default {
	api: api,
	client: client
};
