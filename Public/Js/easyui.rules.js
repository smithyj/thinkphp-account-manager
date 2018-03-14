
/**
 * [validator validatebox扩展验证]
 */
$.extend($.fn.validatebox.defaults.rules,{
    title : {
        validator : function(value){
            return (/[\u4e00-\u9fa5]+$/i.test(value)|/[a-zA-Z]+$/i.test(value));
        },
        message: '请输入中文或者英文'
    },
    name : {
        validator : function(value){
            return /[a-zA-Z]+$/i.test(value);
        },
        message: '请输入英文字母'
    },
    password : {
        validator : function(value,param){
            return $(param[0]).val() == value;
        },
        message: '两次密码输入不一致'
    },
    qq : {// 验证QQ,从10000开始
        validator : function(value) {
            return /^[1-9]\d{4,12}$/i.test(value);
        },
        message : 'QQ号码格式不正确'
    },
    phone : {// 验证电话号码
        validator : function(value) {
            return /^1[3|4|5|8][0-9]\d{4,8}$/i.test(value);
        },
        message : '手机号码必须是11位正确号码'
    },
    remote_row: {
        validator: function(value, param){
            var status=$.ajax({url:param[0],dataType:"json",data:$(param[1]).serialize(),async:false,cache:false,type:"post"}).responseText;
            return status=="true";
        },
        message: '请修正改字段'
    }
});