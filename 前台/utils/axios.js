// 前缀地址
const baseUrl = 'https://shop.dianjingkeji.net/api/'
const url = 'https://shop.dianjingkeji.net/api/'

export default {
    baseUrl: 'https://shop.dianjingkeji.net',
    url: 'https://shop.dianjingkeji.net/api/',
    // imgUrl: 'https://bulingbuling.hbweipai.com/',
    axios(url, params, method, isForm, loading) {
        return new Promise((resolve, reject) => {
            // 请求开始，显示loading
            if (loading) {
                wx.showLoading({
                    title: '加载中'
                })
            }
            // 请求
            wx.request({
                url: baseUrl + url,
                data: params,
                method: method,
                header: {
                    'Content-Type': isForm === 1 ? 'application/x-www-form-urlencoded;charset=utf-8' : 'application/json;charset=utf-8',
                    "Authentication-Token": wx.getStorageSync('token') ? wx.getStorageSync('token') : ''
                },
                // dataType: 'json',
                success: function (res) {
                  console.log(res)
                    if (res.data.code == 200) {
                        resolve(res) // 接收res并传到then的参数中去
                        wx.hideLoading() // 结束加载
                    } else {
                        wx.hideLoading()
                        reject(res) // 结束加载
                        console.log("tian")
                        wx.showToast({
                            title: res.data.msg,
                            icon: 'none'
                        })
                    }
                },
                error: function (e) {
                    wx.hideLoading()
                    wx.showToast({
                        title: e.data.msg,
                        icon: none
                    })
                    console.log(e)
                    reject(e)
                }
            })
        })
    }
}