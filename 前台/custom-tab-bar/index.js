Component({
  data: {
    selected: 0,
    color: "#fff",
    selectedColor: "#f00",
    list: [{
      pagePath: "/pages/index/index",
      text: "首页"
    },{
      pagePath: "/pages/case/index",
      text: "案例"
    }, {
      pagePath: "/pages/shop/index",
      text: "商城"
    }, {
      pagePath: "/pages/wode/wode",
      text: "我的"
    }]
  },
  attached() {
  },
  methods: {
    switchTab(e) {
      const data = e.currentTarget.dataset
      const url = data.path
      wx.switchTab({url})
      this.setData({
        selected: data.index
      })
    }
  }
})