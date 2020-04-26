// pages/wode/wode.js
import api from '../../utils/api'
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    //用户名
    
    name: '',
    UserInfobutton:false,
    //密码
    pwd: '',
    scrollHeight:0,
    phoneList: [],
    login: 1,
    islogin: 0,
    ptuserlogin:false,
    username:"张旭",
    userinfo:{},
  },
  
  onShareAppMessage: function (res) {
    let shareInfo = res.target.dataset.shareinfo;
    return {
      title: shareInfo.title,
      path: shareInfo.path,
      imageUrl: shareInfo.imageUrl
    }
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    // this.GetCompanyInfo();
    // if (wx.getStorageSync("yuangong")){
    //   this.setData({
    //     login:0,
    //     islogin:1
    //   })
    // }else{
      //this.computeScrollViewHeight();
    // }
    var that = this;
    //console.log(app.globalData.userInfo);
    if (app.globalData.userInfo) {
      this.setData({

        userInfo: app.globalData.userInfo,
        hasUserInfo: true
      })
      
      //     //判断是否已经授权
    } else if (this.data.canIUse) {
      // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
      // 所以此处加入 callback 以防止这种情况
      if (app.globalData.token) {
        let user = wx.getStorageSync("backuserinfo")
        if (user && !user.picurl) {
          this.setData({
            UserInfobutton: true
          })
        }
       
      } else {
        app.checkLoginReadyCallback = res => {
          
          if (!res.data.data.picurl) {
            this.setData({
              UserInfobutton: true
            })
          }
        };
      }
    } else {
      //未有用户
      // 在没有 open-type=getUserInfo 版本的兼容处理
      wx.getUserInfo({
        success: res => {
          app.globalData.userInfo = res.userInfo
          this.setData({
            userInfo: res.userInfo,
            hasUserInfo: true
          })
        }
      })
    }
  },
  btn_sub: function (res) {
    // 声明一个变量接收用户授权信息
    var userinfos = res.detail.userInfo;
    // 判断是否授权  true 替换微信用户头像
    if (userinfos != undefined) {
      app.globalData.userInfo = userinfos
      this.setData({
        userInfo: userinfos
      })
      //上传用户头像等信息
      let param = {
        nickname: userinfos.nickName,
        avatarurl: userinfos.avatarUrl,
        uid: wx.getStorageSync("userid"),
        city: userinfos.city,
        province: userinfos.province,
        country: userinfos.country
      }
      api.UpUserInfo(param).then(res => {
        wx.showToast({
          title: '获取成功',
          icon: ''
        })
        wx.setStorageSync("userinfo",userinfos)
        this.setData({
          ptuserlogin:true,
          login:0,
          userinfo: userinfos
        })
      }).catch(err => {
       // console.log(err);
      })
    } else {
    }
  },
  getUserInfo: function (e) {
    console.log(e)
    app.globalData.userInfo = e.detail.userInfo
    this.setData({
      userInfo: e.detail.userInfo,
      hasUserInfo: true
    })
  },
  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {
    console.log(wx.getStorageSync('yuangong'));
    if (typeof this.getTabBar === 'function' && this.getTabBar()) {
      this.getTabBar().setData({
        selected: 3
      })
    }

    if (wx.getStorageSync("username")&&wx.getStorageSync("userpwd")) {
      this.setData({
        name: wx.getStorageSync("username"),
        pwd: wx.getStorageSync("userpwd")
      })
      this.login()
    } else if(wx.getStorageSync("userinfo")){
      let userinfos =wx.getStorageSync("userinfo")
      this.setData({
        ptuserlogin: true,
        login: 0,
        userinfo: userinfos
      })
    } else{
      this.computeScrollViewHeight();
      let user = wx.getStorageSync("backuserinfo")
      if (user.picurl) {
        this.setData({
          picurl: false
        })
      }
    }
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  //计算 scroll-view 的高度
  computeScrollViewHeight() {
    if (this.data.islogin){
      let that = this
      let query = wx.createSelectorQuery().in(this)
      query.select('.titletitle').boundingClientRect(function (res) {
        console.log(res)
        //得到标题的高度
        let titleHeight = res.height
        //scroll-view的高度 = 屏幕高度- tab高(50) - 10 - 10 - titleHeight
        //获取屏幕可用高度
        let screenHeight = wx.getSystemInfoSync().windowHeight
        //计算 scroll-view 的高度
        let scrollHeight = screenHeight - titleHeight - 250
        that.setData({
          scrollHeight: scrollHeight
        })
      }).exec()
    }
  },
  // 用户名赋值
  inputName(e) {
    console.log(e)
    this.setData({
      name: e.detail.value
    })
    console.log(this.data)
  },
  // 密码赋值
  inputPwd(e) {
    console.log(e)
    this.setData({
      pwd: e.detail.value
    })
  },
  //登录事件
  login(){
    let params = {
      username:this.data.name,
      userpwd:this.data.pwd,
    }
    var that=this;
    api.EmployeeLogin(params).then(res => {
      if (wx.getStorageSync("username")){
        wx.showToast({
          title: '更新成功',
          icon: ''
        })
      }else{
        wx.showToast({
          title: '登录成功',
          icon: ''
        })
      }
      let phonelist=res.data.data
      wx.setStorageSync("username",this.data.name);
      wx.setStorageSync("userpwd",this.data.pwd);
      wx.setStorageSync("yuangong",phonelist)
      this.setData({
        phoneList:phonelist,
        login: 0,
        islogin: 1,
      })
      this.computeScrollViewHeight()
    }).catch(err => {
      console.log(err);
    })
  },
  //拨打电话
  binMakePhoneCall(e) {
    if (e.currentTarget.dataset.id) {
      wx.makePhoneCall({
        phoneNumber: e.currentTarget.dataset.id,
      })
    } else {
      wx.showToast({
        title: '此商家为添加电话',
        icon: 'none',
        duration: 2000
      })
    }
  },
  //退出账号
  TuiChu(){
    wx.setStorageSync("username","");
    wx.setStorageSync("userpwd", "");
    wx.setStorageSync("yuangong", "");
    wx.setStorageSync("userinfo", "");
    this.setData({
      UserInfobutton: false,
      login: 1,
      islogin: 0,
      userinfo:{},
      ptuserlogin:false
    })
  }
})