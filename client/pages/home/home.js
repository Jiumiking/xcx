//index.js
var qcloud = require('../../vendor/wafer2-client-sdk/index')
var config = require('../../config')
var util = require('../../utils/util.js')

Page({
    data: {
        number: '',
        requestStatus: 0,
        requestData: {}
    },
    formSubmit: function(e) {
//        this.setData({
//            number: e.detail.value.number
//        });

        if( e.detail.value.number == '' ){
            util.showModel('错误','请输入编号');
            return;
        }

        util.showBusy('请求中...')
        var that = this
        var options = {
            url: config.service.homeUrl,
            data: {'number':e.detail.value.number},
            success (result) {
                util.showSuccess('请求成功完成')
                console.log('request success', result);
//                        console.log('data', that.data)
                if( result.data.code == 1 ){
                    that.setData({
                        requestStatus: 1,
                        requestData: result.data.data
                    });
                }else{
                    that.setData({
                        requestStatus: 2,
                        requestData: {}
                    })
                }
            },
            fail (error) {
                util.showModel('请求失败', error);
                console.log('request fail', error);
            }
        }
        qcloud.request(options);

//        console.log('form发生了submit事件，携带数据为：', e.detail.value)
    },
    formReset: function() {
        console.log('form发生了reset事件')
    }
})