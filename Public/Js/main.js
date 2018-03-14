


$(function(){
	//读取皮肤配置
	if($.cookie('theme')){
    	$.Oa.theme($.cookie('theme'));
	}
	/**
	 * 用户操作下拉特效
	 * 2015年3月8日09:38:20
	 * @author [杨圆建] 624508914@qq.com
	 */
	$(".oa-user-select").hover(function() {
		$(this).children('p').stop(true, true).slideDown('slow');
	}, function() {
		$(this).children('p').stop(true, true).slideUp('slow');
	});

	/**
	 * 顶部菜单切换特效
	 * 2015年3月8日10:51:14
	 * @author [杨圆建] 624508914@qq.com
	 */
	$(".oa-menu a").click(function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
	});

	/**
	 * tabs 框架
	 * 2015年3月10日14:24:00
	 */
	$("#oa-tabs").tabs({
	    fit:true,
	    tabPosition:'bottom',
	    border:false
	});

	/**
	 * 左侧菜单accordion
	 * 2015年3月10日14:22:55
	 */
	$(".oa-menu a").click(function(e) {
	    $('#west').panel({title:$(this).text()});
	    $.ajax({
	        url: $(this).attr('data-url'),
	        type: 'GET',
	        dataType: 'json',
	        beforeSend: function(){
	            //移除左侧菜单内容
	            $.Oa.removeLeftMenu();
	            $("#left").accordion("add", {content:$.Oa.loading("正在加载菜单中...")});
	        },
	        success: function(data){
	            //移除左侧菜单内容
	            $.Oa.removeLeftMenu();
	            //左侧内容更新
	            /*$.each(data, function(i,m) {
	                var content = '';
	                if(m.children){
	                    content = "<ul class='easyui-tree' data-options='data:"+ JSON.stringify(m.children) +",animate:true,lines:false,onClick:function(node){$.Oa.openUrl(node)}'></ul>";
	                }
	                $("#left").accordion("add", {title: m.title, content: content,iconCls:m.cls});
	            });*/
	    		$('#left').tree({
			        checkbox: false,
			        data: data,
			        parentField:"rule_id",
			        textFiled:"text",
			        idFiled:"key",
			        onClick: function(node){
				       $.Oa.openUrl(node);
				    }
			    });
	        },
			error: function(){
				$.messager.progress({text:"获取菜单失败，请联系管理员！3秒后关闭..."});
            	setTimeout('$.messager.progress("close")',3000);
			}
	    });

	});
	$(".oa-menu a").eq(0).click();
});