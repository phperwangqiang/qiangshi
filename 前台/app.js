//app.js
import api from 'utils/api'
App({
  onLaunch: function () {
    // 展示本地存储能力
    var logs = wx.getStorageSync('logs') || []
    logs.unshift(Date.now())
    wx.setStorageSync('logs', logs)
    wx.setStorageSync("backuserinfo", "")
    wx.setStorageSync("token", "")
    wx.setStorageSync("userid", "")
    wx.setStorageSync("userinfo", "")
    // 登录
    wx.login({
      success: res => {
        this.globalData.code = res.code
        let param={
          code:res.code
        }
        let that=this
        wx.request({
          url: 'https://shop.dianjingkeji.net/api/Login/index',
          data:{code:res['code']},
          method:'post',
          header: {
            'content-type': 'application/json' // 默认值
          },
          success (res) {
            if(res.data.code==200){
              that.globalData.backuserinfo = res.data.data
              that.globalData.token = res.data.data.token
              that.globalData.userid = res.data.data.id
              wx.setStorageSync("backuserinfo", res.data.data)
              wx.setStorageSync("token", res.data.data.token)
              wx.setStorageSync("userid", res.data.data.id)
            }else{
              wx.showToast({
                title: '网络错误 请稍后再试',
                icon: 'none',
                duration: 2000,
              })
            }
            if (that.checkLoginReadyCallback) {
              that.checkLoginReadyCallback(res);
            }
          },
          fail: function (res) {
            console.log(res)
          }
        })
      }
    })
    // 获取用户信息
    wx.getSetting({
      success: res => {
        if (res.authSetting['scope.userInfo']) {
          // 已经授权，可以直接调用 getUserInfo 获取头像昵称，不会弹框
          wx.getUserInfo({
            success: res => {
              // 可以将 res 发送给后台解码出 unionId
              this.globalData.userInfo = res.userInfo
              // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
              // 所以此处加入 callback 以防止这种情况
              if (this.userInfoReadyCallback) {
                this.userInfoReadyCallback(res)
              }
            }
          })
        }
      }
    })
  },
  globalData: {
    backuserinfo:null,
    userInfo: null,
    openid:null,
    code:null,
    token:null,
    userid:null,
    userinfo:null,
    cid:0,
  }
})