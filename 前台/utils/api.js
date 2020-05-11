import axios from './axios'
const api = {};
// 登录
api.Login = params => axios.axios('Login/index', params, 'POST', 1, true);
//上传头像和昵称
api.UpUserInfo = params => axios.axios('Login/upnicknameandavatar', params, 'POST', 1, true);
//获取公司信息
api.GetCompanyInfo = params => axios.axios('home/getcompanyinfo', params, 'POST', 1, true);
//获取视频列表
api.VideoList = params => axios.axios('lists/shipin', params, 'POST', 1, true);
//获取案例列表
api.CasesList = params => axios.axios('lists/cases', params, 'POST', 1, true);
//获取商品列表
api.GoodList = params => axios.axios('lists/goods', params, 'POST', 1, true);
//员工登录
api.EmployeeLogin = params => axios.axios('employee/login', params, 'POST', 1, true);
//员工账户下的客户手机号
api.Upmobile = params => axios.axios('home/upmobile', params, 'POST', 1, true);
api.Isenable=params=>axios.axios('home/enable',params,'POST',1,true);
//验证是否需要弹出红包
api.Redbag = params => axios.axios('redbag/index', params, 'POST', 1, true);
export default api

