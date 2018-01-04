import config from './api-config'

let api = {
	//注册
	register: config.host + config.prefix + '/user/add',
	//登录
	login: config.host + '/oauth/token',
	// 用户信息
	userDetails: config.host + config.prefix + '/userDetails',
	// 更换密码
	change_password: config.host + config.prefix + '/user/change_password',
}
let client = {
	client_id: '4',
	client_secret: 'dAi5wEtrSA4kOR9kzDD5hBVo2iWMO9HE68d4bzqE'
}
//家里电脑
//client_id: '7',
//client_secret: 'v2tlPgfokYwUsAOlxOE0T0BaBdiPrBqPeIlb3XMB'
//学校电脑
//client_id: '4',
//client_secret: 'dAi5wEtrSA4kOR9kzDD5hBVo2iWMO9HE68d4bzqE'
export default {
	api: api,
	client: client
};
