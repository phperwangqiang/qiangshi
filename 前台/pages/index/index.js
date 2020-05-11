//index.js
//获取应用实例
import api from '../../utils/api'
import axios from '../../utils/axios'
import util from '../../utils/util'
const app = getApp()

Page({
  data: {
    //扫描的微信二维码
    wxewm:'',
    //服务器地址
    baseurl:'',
    data: {
      showModal:false
    },
    //当前页
    spindex:0,
    UserInfobutton:false,
    //当前用户信息
    userInfo: {},
    //当前用户信息获取成功与否
    hasUserInfo: false,
    //长按保存图片弹窗控制
    showModalscop:false,
    //登录判断getUserInfo是否可用
    canIUse: wx.canIUse('button.open-type.getUserInfo'),
    //视频信息
    video:[],
    //公司信息
    companynfo:"",
    //红包
    HongBao:true,
    //红包图片
    HongBaoImage:"/pages/images/hongbaokai.jpg",
    //红包类型
    HongBaoType:true,
    //红包文字
    HongBaoInfo:"",
    //分享视频信息
    fenxianginfo:"",
  },
    // 外面的弹窗
    weixinbtn:function (e) {
      if(e.currentTarget.dataset.id){
        this.setData({
          showModal: true,
          wxewm: e.currentTarget.dataset.id
        })
      }else{
        wx.showToast({
          title: '此商户未添加 微信二维码',
          icon: 'none',
          duration: 2000
        })
      }
    },
    // 禁止屏幕滚动
    preventTouchMove:function () {
    },
    // 弹出层里面的弹窗
    ok:function () {
      this.setData({
        showModal:false
      })
    },
  //事件处理函数
  bindViewTap: function() {
    wx.navigateTo({
      url: '../logs/logs'
    })
  },
  //点击暂停/开始
  videoTap:function(e){
    var thisindex = e.currentTarget.id;
  	//获取video
    console.log(e.currentTarget.id)
    this.videoContext = wx.createVideoContext(e.currentTarget.id)
    let video=this.data.video
    console.log(video)
    if (video[thisindex].zanting){
      console.log("bofang")
      video[thisindex].zanting=false
      //开始播放
      this.videoContext.play()//开始播放
    }else{
      console.log("zanting")
      //当play==false 显示图片 暂停
      video[thisindex].zanting = true
      this.videoContext.pause()//暂停播放
    }
    this.setData({
      video: video
    })
   },
  onShareAppMessage: function (res) {
    let shareInfo = res.target.dataset.shareinfo;
    console.log(shareInfo);
    return {
      title: shareInfo.title,
      path: shareInfo.path,
      imageUrl: shareInfo.imageUrl
    }
  },
  
  onLoad: function (options) {
    var that = this;
    if (app.globalData.userInfo) {
      this.setData({
        userInfo: app.globalData.userInfo,
        hasUserInfo: true
      })
      this.loginactin(options)
      //     //判断是否已经授权
    } else if (this.data.canIUse) {
      // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
      // 所以此处加入 callback 以防止这种情况
      if (app.globalData.token) {
        let user = wx.getStorageSync("backuserinfo")
        if (user && !user.picurl) {
          // this.setData({
          //   UserInfobutton: true
          // })
        }
        this.loginactin(options)
      } else {
        app.checkLoginReadyCallback = res => {
          this.loginactin(options)
          if (!res.data.data.picurl) {
            // this.setData({
            //   UserInfobutton: true
            // })
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
  onShow() {
    if (typeof this.getTabBar === 'function' && this.getTabBar()) {
      this.getTabBar().setData({
        selected: 0
      })
    }
    let fenxiang= this.data.fenxianginfo;
    this.IsHongBao(fenxiang, 2)
  },
  loginactin(options){
    //获取视频列表
    let params = {
      uid: wx.getStorageSync('userid'),
      cid: app.globalData.cid
    }
    api.Isenable(params).then(res => {
      if (res.data.msg == 0) {
        this.setData({
          spenable: false
        })
      }
      else {
        this.setData({
          spenable: true
        })
        this.GetVideoList(options);
        // let videolist=this.data.video
        // console.log(videolist)
        //获取公司信息
        this.GetCompanyInfo();
        //播放第一个视频
        // if (options && options.index) {
        //   this.setData({
        //     spindex: options.index
        //   })
        //   wx.createVideoContext(options.index).play();
        // } else {
        //   wx.createVideoContext("0").play();
        // }
        
      }

    }).catch(err => {
      wx.showToast({
        title: '网络错误,请稍后再试',
        icon: 'none',
        duration: 2000
      })
    })
    
    
  },
  // UserInfo(){
  //   if (app.globalData.userInfo) {
  //     this.setData({
  //       userInfo: app.globalData.userInfo,
  //       hasUserInfo: true
  //     })
  // //     //判断是否已经授权
  //   } else if (this.data.canIUse) {
  //     // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
  //     // 所以此处加入 callback 以防止这种情况
  //     if (app.globalData.token) {
  //       let user=wx.getStorageSync("backuserinfo")
  //       if (user && !user.picurl){
  //         this.setData({
  //           UserInfobutton: true
  //         })
  //       }
  //     } else {
  //       app.checkLoginReadyCallback = res => {
  //         if(!res.data.data.picurl){
  //           this.setData({
  //             UserInfobutton: true
  //           })
  //         }
  //       };
  //     }
  //   } else {
  //     //未有用户
  //     // 在没有 open-type=getUserInfo 版本的兼容处理
  //     wx.getUserInfo({
  //       success: res => {
  //         app.globalData.userInfo = res.userInfo
  //         this.setData({
  //           userInfo: res.userInfo,
  //           hasUserInfo: true
  //         })
  //       }
  //     })
  //   }
  // },
  shipingaibian:function(e){
    var that=this;
    
    var index = String(this.data.spindex);
    wx.createVideoContext(String(index)).pause();
    let video=this.data.video
    video[index].zanting=true
    this.setData({
      spindex:e.detail['current'],
      HongBao:false
    });
    var index1 = that.data.spindex;
    // this.videoContext = swan.createVideoContext(String(index1));
    video[index1].zanting = false
    wx.createVideoContext(String(index1)).play();
    this.setData({
      video: video,
    });
    // 查看是否飘红包
    this.IsHongBao(video[index1],1)
  },
  IsHongBao(video, fromas){
    if(video!=""){
      let params = {
        uid: wx.getStorageSync("userid"),
        cid: app.globalData.cid,
        videoid: video.id,
        fromas: fromas
      }
      api.Redbag(params).then(res => {
        console.log(res)
        if (res.data.code == 200) {
          this.setData({
            hongbao: true
          })
        }
      }).catch(err => {
        console.log(err);
      })
      this.setData({
        fenxianginfo:""
      })
    }
  },
  getUserInfo: function(e) {
    console.log(e)
    app.globalData.userInfo = e.detail.userInfo
    this.setData({
      userInfo: e.detail.userInfo,
      hasUserInfo: true
    })
  },
  // 长按保存图片
  previewImage(e) {
    console.log(e)
    let url  = e.target.dataset.src;
    //用户需要授权
    wx.getSetting({
      success: (res) => {
        console.log("fdsa121")
        if (!res.authSetting['scope.writePhotosAlbum']) {
          wx.authorize({
            scope: 'scope.writePhotosAlbum',
            success: () => {
              // 同意授权
              this.saveImg1(url);
            },
            fail: (res) => {
              this.setData({
                showModalscop: true
              })
              console.log(this.data)
              console.log(res);
            }
          })
        } else {
          // 已经授权了
          this.saveImg1(url);
        }
      },
      fail: (res) => {
        console.log("fdsa")
        
        console.log(res);
      }
    })
  },
  saveImg1(url) {
    wx.getImageInfo({
      src: url,
      success: (res) => {
        let path = res.path;
        wx.saveImageToPhotosAlbum({
          filePath: path,
          success: (res) => {
            this.setData({
              showModal: false
            })
            wx.showToast({
              title: '二维码保存成功',
              icon: 'success',
              duration: 2000
            })
          },
          fail: (res) => {
            this.setData({
              showModal: false
            })
            wx.showToast({
              title: '二维码保存失败',
              icon: 'success',
              duration: 2000
            })
            console.log(res);
          }
        })
      },
      fail: (res) => {
        console.log(res);
      }
    })
  },
  //拨打电话
  binMakePhoneCall(e){
    if (e.currentTarget.dataset.id){
      wx.makePhoneCall({
        phoneNumber: e.currentTarget.dataset.id,
      })
    }else{
      wx.showToast({
        title: '此商家为添加电话',
        icon: 'none',
        duration: 2000
      })
    }
  },
  // 手动授权
  handleSetting(e) {
    console.log("fdscvizo")
    var that = this
    if (!e.detail.authSetting['scope.writePhotosAlbum']) {
      wx.showModal({
        title: '警告',
        content: '若不打开授权，则无法将图片保存在相册中！',
        showCancel: false
      })
      that.setData({
        showModalscop: false
      })
    } else {
      wx.showModal({
        title: '提示',
        content: '您已授权，赶紧将图片保存在相册中吧！',
        showCancel: false
      })
      that.setData({
        showModalscop: false
      })
    }
  },
  onReady: function () {
  },
  isenable(){
    
    
  },
  //获取视频列表
  GetVideoList(options){
    // console.log(wx.getStorageSync("token"))
    let params = {
      uid: wx.getStorageSync("userid"),
      cid: app.globalData.cid
    }
    api.VideoList(params).then(res => {
      let videolist=res.data.data
      if (videolist){
        for(var i=0;i<videolist.length;i++){
          if (videolist[i].description.length > 18) {
            let temp = [];
            let time = 3
            while (time>0) {
              if (time != 1) {
                console.log("fdsa")
                if (videolist[i].description.length > 18) {
                  temp.push(videolist[i].description.substr((3-time)*22,22));
                } else {
                  break;
                }
              } else {
                if (videolist[i].description.length > 15) {
                  temp.push(videolist[i].description.substr((3 - time) * 22, 18) + "...");
                } else {
                  break;
                }
              }
              time--;
            }
            videolist[i].description = temp
          }else{
            let temp = videolist[i].description
            videolist[i].description=[]
            videolist[i].description[0] = temp
          }
        }
      }
      if (options && options.index) {
        this.setData({
          spindex: options.index
        })
        wx.createVideoContext(options.index).play();
        this.IsHongBao(videolist[index],1)
      } else {
        wx.createVideoContext("0").play();
        this.IsHongBao(videolist[0],1)
      }
      this.setData({
        baseurl: axios.baseUrl,
        video: videolist
      })
    }).catch(err => {
      wx.showToast({
        title: '网络错误,请稍后再试',
        icon: 'none',
        duration: 2000
      })
    })
  },
  //微信分享
  onShareAppMessage: function (res) {
    console.log(res)
    let index=0
    if (res.target.dataset.index)
    {
      index = res.target.dataset.index
    }
    let url = this.data.baseurl + res.target.dataset.id.picurl
    this.setData({
      fenxianginfo: res.target.dataset.id
    })
    return {
      title: res.target.dataset.id.name,
      path: 'pages/index/index?index=' + index,
      imageUrl: url,//自定义图片路径，显示图片长宽比是 5:4。
    }
  },
//获取用户信息
  btn_sub: function (res) {
    // 声明一个变量接收用户授权信息
    var userinfos = res.detail.userInfo;
    // 判断是否授权  true 替换微信用户头像
    if (userinfos != undefined) {
      app.globalData.userInfo = userinfos
      this.setData({
        UserInfobutton:false,
        userInfo: userinfos
      })
      //上传用户头像等信息
      let param={
        nickname: userinfos.nickName,
        avatarurl:userinfos.avatarUrl,
        uid: wx.getStorageSync("userid"),
        city:userinfos.city,
        province:userinfos.province,
        country:userinfos.country,
        cid: app.globalData.cid
      }
      api.UpUserInfo(param).then(res => {
        console.log("上传成功");
      }).catch(err => {
        console.log(err);
      })
    } else {
    }
  },
  getPhoneNumber: function (e) {//点击获取手机号码按钮
    var that = this;
    let video = e.target.dataset.id
    if (video){
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
              type: 1,
              tid: video.id,
              cid: app.globalData.cid
            }
            api.Upmobile(param).then(res => {
              wx.showToast({
                title: '关注成功',
                icon: ''
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
  GetCompanyInfo() {
    let params = {
      uid: wx.getStorageSync("userid"),
      cid: app.globalData.cid
    }
    api.GetCompanyInfo(params).then(res => {
      this.setData({
        companynfo: res.data.data,
      })
    }).catch(err => {
      console.log(err);
    })
  },
  //红包关闭事件
  CloseHongBao(){
    this.setData({
      HongBao:false
    })
  }
})
