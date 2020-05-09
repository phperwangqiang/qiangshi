// pages/case/index.js
import api from '../../utils/api'
import axios from '../../utils/axios'
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    //服务器地址
    baseurl: '',
    casesList:[],
    //是否还有数据
    ishasdata: 1,
    scrollHeight: 0,
    case_kong: "努力加载中....",
    hasphone:true
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    if (app.globalData.userid) {
      this.loginaction()
    } else {
      app.checkLoginReadyCallback = res => {
        this.loginaction()
      };
    }
  },
  loginaction(){
    this.computeScrollViewHeight();
    this.CaseList()
    let hasphone = true
    let userinfo = wx.getStorageSync('backuserinfo')
    if (userinfo.phone != "") {
      hasphone = false
    } 
    this.setData({
      hasphone:hasphone,
      baseurl: axios.baseUrl,
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
    if (typeof this.getTabBar === 'function' && this.getTabBar()) {
      this.getTabBar().setData({
        selected: 1
      })
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
  onShareAppMessage: function () {

  },
  //上划加载
  onReachBottom: function () {
  },
//设置高度
  computeScrollViewHeight() {
    let that = this
    let query = wx.createSelectorQuery().in(this)
    query.select('.case').boundingClientRect(function (res) {
      console.log(res)
      //得到标题的高度
      let titleHeight = res.height
      //scroll-view的高度 = 屏幕高度- tab高(50) - 10 - 10 - titleHeight
      //获取屏幕可用高度
      let screenHeight = wx.getSystemInfoSync().windowHeight
      //计算 scroll-view 的高度
      let scrollHeight = screenHeight - titleHeight - 135
      that.setData({
        scrollHeight: scrollHeight
      })
    }).exec()
  },
  //获取品牌列表
  CaseList: function () {
    let param={
      uid:wx.getStorageSync("userid"),
      cid: app.globalData.cid
    }
    api.CasesList(param).then(res => {
      console.log(res)
      if (res.data.data.length == 0) {
        wx.showToast({
          title: '已经没有数据了',
          icon: 'none',
          duration: 2000,
        })
        this.setData({
          ishasdata: 0,
          case_kong:'已经没有数据了'
        })
      } else {
        var caseslist = res.data.data;
        console.log(caseslist)
        this.setData({
          casesList: caseslist,
          case_kong: '还没有案例 敬请期待'
        })
      }
    }).catch(err => {
      // util.ValidateError('default')
    })
  },
  //滚动触底方法
  ScrollTolower: function () {
    if (this.data.ishasdata) {
      let page = this.data.productpage + 1
      let param = {
        page: page,
        size: this.data.size,
      }
      this.setData({
        productpage: page,
      })
      this.CaseList(param)
    } else {
      wx.showToast({
        title: '已经没有数据了',
        icon: 'none',
        duration: 2000,
      })
    }
  },
  //微信分享
  onShareAppMessage: function (res) {
    console.log(res)
    let url = this.data.baseurl + res.target.dataset.id.picurl
    console.log(url)
    return {
      title: res.target.dataset.id.name,
      path: 'pages/case/index',
      imageUrl: url //自定义图片路径，显示图片长宽比是 5:4。
    }
  },
  getPhoneNumber: function (e) {//点击获取手机号码按钮
    var that = this;
    console.log(e)
    let video = e.target.dataset.id
    if (video) {
      wx.checkSession({
        success: function () {
          var ency = e.detail.encryptedData;
          var iv = e.detail.iv;
          var sessionk = that.data.sessionKey;
          if (e.detail.errMsg == 'getPhoneNumber:fail user deny') {
            wx.showToast({
              title: '拒绝获取电话',
              icon: ''
            })
          } else {//同意授权
            let param = {
              iv: iv,
              encryptedData: ency,
              uid: wx.getStorageSync("userid"),
              type: 2,
              tid: video.id,
              cid: app.globalData.cid
            }
            api.Upmobile(param).then(res => {
              wx.showToast({
                title: '关注成功',
                icon: ''
              })
              let userinfo = wx.getStorageSync('backuserinfo')
              //不返回电话所以先随意给个值 方便下次验证时有phone让他可以打电话
              userinfo.phone="432423";
              wx.setStorageSync('backuserinfo',userinfo)
              let hasphone=false
              that.setData({
                hasphone: hasphone,
                baseurl: axios.baseUrl,
              })
            }).catch(err => {
              console.log(err);
            })
          }
        },
        fail: function () {
          console.log("session_key 已经失效，需要重新执行登录流程");
          that.UserInfo(); //重新登录
        }
      });
    }
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

})