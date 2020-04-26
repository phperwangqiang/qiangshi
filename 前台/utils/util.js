const formatTime = date => {
  const year = date.getFullYear()
  const month = date.getMonth() + 1
  const day = date.getDate()
  const hour = date.getHours()
  const minute = date.getMinutes()
  const second = date.getSeconds()

  return [year, month, day].map(formatNumber).join('/') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

const formatNumber = n => {
  n = n.toString()
  return n[1] ? n : '0' + n
}
const weChatAuthorization= n =>{
  return new Promise((resolve, reject) => {
    wx.login({
      success(res) {
        if (res.code) {
          //发起网络请求
          wx.request({
            url: 'https://zz.dianjingkeji.net/api/base/weChatLogin',
            data: { code: res['code'] },
            method: 'post',
            header: {
              'content-type': 'application/json' // 默认值
            },
            success(res) {
              resolve(res)
            },
            fail: function (res) {
              resolve(res)
            }
          })
        } else {
          console.log('登录失败！' + res.errMsg)
        }
      }
    })
  })
}
module.exports = {
  formatTime: formatTime,
  weChatAuthorization: weChatAuthorization,
}
