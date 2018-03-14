/**
 * 公共方法
 */
;(function($){
	$.extend({
		/*Oa模块Js开始*/
		"Oa":{
			"dialog_1": "#oa-dialog-1",//模态框1
			"dialog_2": "#oa-dialog-2",//模态框2

			"tip": function(title,msg,icon,timeout,showType){//右下角提示框
				$.messager.progress('close');
				var text = []
				text.push('<div class="messager-icon messager-');
				text.push(icon || 'info');
				text.push('"></div>');
				text.push('<div>' + msg + '</div>');
				$.messager.show({
					title: title || '提示信息',
					msg: text.join(''),
					timeout: timeout || 2000,
					showType: showType || 'slide'
				});
			},
			//切换主题
			theme: function(t){
				var theme = t;
				$("#theme").attr("href","/Public/Framework/Easyui/themes/"+theme+"/easyui.css");
				$.cookie('theme', theme, {path:'/', expires:3650});
			},
			"confirm" : function(dofunction,info){
				info = info || '确定是否要进行此操作吗？';
				$.messager.confirm('确认对话框', info, function(r){
					if (r){
					    eval(dofunction);
					}
				});
			},

			"doForm" : function(dom){//添加||编辑数据库信息
				var isValid = $(dom).form('validate');
				if (!isValid){
					return isValid;	// 返回false，终止表单提交
				}
				type = $(dom).attr("method");
				url = $(dom).attr("action");
				data = $(dom).serialize();
				$.ajax({
					type: type,
					url: url,
					data: data,
					dataType:"json",
					beforeSend: function(){
						$.messager.progress({text:'处理中，请稍候...'});
					},
					success: function(data){
						$.messager.progress("close");
						if(!data.status){
							$.Oa.tip('提示信息', data.info,'error');
						} else {
							$.Oa.tip('提示信息', data.info,'info');
							$($.Oa.dialog_1).dialog('close');
							$.Oa.refresh();
						}
					},
					error: function(data){
						$.messager.progress("close");
						$.Oa.tip('提示信息', data.responseText,'error');
					}
				});
			},

			"delData" : function(id,url,type){//删除数据库信息
				type = type || 'post';
				url = url;
				data = 'id='+id;
				$.ajax({
					type: type,
					url: url,
					data: data,
					dataType:"json",
					beforeSend: function(){
						$.messager.progress({text:'处理中，请稍候...'});
					},
					success: function(data){
						$.messager.progress("close");
						if(!data.status){
							$.Oa.tip('提示信息', data.info,'error');
						} else {
							$.Oa.tip('提示信息', data.info,'info');
							$.Oa.refresh();
						}
					},
					error: function(data){
						$.messager.progress("close");
						$.Oa.tip('提示信息', data.responseText,'error');
					}
				});
			},

			"sess_verify" : function(url,jumpurl){//登录过期校验
		        $.post(url,'',function(data) {
		            if(!data.status){
		            	$.messager.progress({text:'登录超时，正在跳转登录页面...'});
		                setTimeout("location.href = '"+jumpurl+"';",1000);
		            }
		        },'json');
			},

			"loading": function(msg){//正在努力加载中
				msg = msg || "正在努力加载中...";
				return "<div class='oa-loading'>"+msg+"</span>";
			},

			"removeLeftMenu": function(stop,titles){//移除左侧菜单
				//加个判断，防止多次点击重复加载
				var options = $('body').layout('panel', 'west').panel('options');
				if(titles == options.title) return false;
				var leftmenu = $("#left").accordion("panels");
				$.each(leftmenu, function(i,n) {
					if(n){
						var t = n.panel("options").title;
						if(titles && titles.length){
							for(var k = 0; k < titles.length; k++){
								if(titles[k] == t) $("#left").accordion("remove", t);
							}
						}else{
							$("#left").accordion("remove", t);
						}
					}
				});
				var pp = $('#left').accordion('getSelected');
				if(pp) {
					var t = pp.panel('options').title;
					if(titles && titles.length){
						for(var k = 0; k < titles.length; k++){
							if(titles[k] == t) $("#left").accordion("remove", t);
						}
					}else{
						$("#left").accordion("remove", t);
					}
				}
				if(!stop){
					this.removeLeftMenu(true, titles);
				}
			},

			'openUrl': function(node){//在新tabs窗口打开页面
				if(node.type){
					if($("#oa-tabs").tabs('exists', node.text)){
						$('#oa-tabs').tabs('select', node.text);
					}else{
						$('#oa-tabs').tabs('add',{
							title: node.text,
							href: node.url,
							closable: true,
							cache: true,
							tools:[{
						        iconCls:'icon-mini-refresh',
						        handler:function(){
						            var tab = $("#oa-tabs").tabs("getSelected");
						            tab.panel("refresh",tab[0]['baseUrl']);
						        }
						    }]
						});
					}
				}
			},

			'refresh' : function(){//刷新当前已选择的Tabs
				var tab = $("#oa-tabs").tabs("getSelected");
				tab.panel("refresh",tab[0]['baseUrl']);
			}
		},
	});
})(jQuery);
