
	function hz6d$(id)
	{
		return document.getElementById(id) ? document.getElementById(id) : null;
	}
	
	var hz6d_referer = '&referer=' + window.encodeURIComponent(window.location.href); //当前访问页面
	var kf_success=1; var kftype=2;
	var powered_by_53kf_url = 'http://www.53kf.com/53kfkefu.html?yx_from=53KF02',
			powered_by_53kf_txt = 'Powered by 53KF';
	function hz6d_createScript(id, url){
		var oldS=hz6d$(id);
		if(oldS!=null) oldS.parentNode.removeChild(oldS);
		var t=document.createElement('script');
		t.src = url;
		t.type = 'text/javascript';
		t.id = id;
		document.getElementsByTagName('head')[0].appendChild(t);
	}
	
	(function(window, undefined) {
		// window.open 方法重写 
		// 支持ie/ff/chrome/safari/opera 
		var _open = window.open;
		window.open = function(sURL, sName, sFeatures, bReplace) {
			if (sURL == undefined) {
				sURL = ''
			}
			if (sName == undefined) {
				sName = ""
			}
			if (sFeatures == undefined) {
				sFeatures = ""
			}
			if (bReplace == undefined) {
				bReplace = false
			}
			if (/webCompany.php|webClientMin.php/.test(sURL)) {
				sURL += '&timeStamp=' + new Date().getTime();
			} else if ('' != '') {
				var _zdyurl = '';
				if (sURL.indexOf(_zdyurl) > -1) {
					sURL += '&timeStamp=' + new Date().getTime();
				}
			}
			sURL = sURL.replace('&referer={hz6d_referer}',hz6d_referer);
			var win = _open(sURL, sName, sFeatures, bReplace);
			return win;
		}
	})(window);
	// 获取cookie值 
	function hz6d_getCookie(name)
	{
		var offset = document.cookie.indexOf(name + "=");
		if (offset != -1)
		{
			offset += name.length + 1;
			var end = document.cookie.indexOf(";", offset);
			if (end == -1)
			{
				end = document.cookie.length;
			}
			return document.cookie.substring(offset, end);
		}
		else
		{
			return "";
		}
	}
	// 获取访问的入口来源页面:搜索引擎/外部链接/直接输入  
	var hz6d_from_page = hz6d_getCookie("53kf_70840187_keyword");
	if (document.cookie.indexOf('53kf_70840187_keyword=') == -1)
	{
		hz6d_from_page = document.referrer;
	}
	document.cookie = "53kf_70840187_keyword=" + hz6d_from_page;
	hz6d_from_page = "&keyword=" + escape(hz6d_from_page);
	
	function hz6d_html_replace(html)
	{
		var pattern = /{hz6d_keyword}/gim;
		var str = hz6d_from_page + "&tfrom=1";
		var hz6d_html = html.replace(pattern, str);
		return hz6d_html;
	}

	// has defined <!DOCTYPE... > 

	function hasdoctype()
  {
		if (document.compatMode == "BackCompat")
		{
			ret = false;
		}
		else
		{
			ret = true;
		}
		return ret;
	}

	function detectBrowser()
	{
		var ret = "ie6"; // default
		var user_agent = navigator.userAgent;
		if (user_agent.indexOf("compatible") > -1)
		{
			if (user_agent.indexOf("MSIE 6.0") > -1)
			{
				ret = "ie6";
			}
			else if (user_agent.indexOf("MSIE 7.0") > -1)
			{
				ret = "ie7";
			}
			else if (user_agent.indexOf("MSIE 8.0") > -1)
			{
				ret = "ie8";
			}
			if (user_agent.indexOf("360") > -1)
			{
				ret = "360";
			}
		}
		else if (user_agent.indexOf("Gecko") > -1)
		{
			ret = "firefox";
		}
		if ("" == "TheWorld")
		{
			ret = "TheWorld";
		}
		return ret;
	}
	// 间距小于步进，则移动间距的距离 

	function smoothMove(start, end)
	{
		var step = Math.abs(end - start);
		var forword = end - start;
		if (step > 2)
		{
			step = Math.ceil(step * 0.2) * (forword / Math.abs(forword));
		}
		else
		{
			step = step * (forword / Math.abs(forword));
		}
		posi = start + step;
		if (step > 0)
		{
			if (posi > end) posi = end;
		}
		else
		{
			if (posi < end) posi = end;
		}
		return posi;
	}
	var hasdoctype = hasdoctype();
	var browser = detectBrowser();
	// 点击图标设置变量 

	function setIsinvited()
	{
		try
		{
			onliner_zdfq = 2;
			if (acc_autotype == 3)
			{
				document.cookie = "onliner_zdfq70840187=" + onliner_zdfq;
			}
		}
		catch (e)
		{}
	}
	var onliner_zdfq = hz6d_getCookie("onliner_zdfq70840187"); // onliner_zdfq: 0.初始值 2.点击接受 3.点击拒绝 
	if (onliner_zdfq == "")
	{
		onliner_zdfq = 0;
		document.cookie = "onliner_zdfq70840187=" + onliner_zdfq;
	}
	var hz6d_kf_type = 2;
	var hz6d_pos_model = 1;
	var hz6d_hidden = 0;
	var hz6d_close_icon = 0;
	// 加载ivt.php，即中间的接受邀请层 
	if (!hz6d$("ivt_script"))
		document.write("<scr"+"ipt src='http://www41.53kf.com/kf_ivt.php?arg=happy-englisth&test_do=&style=1&isonline=0&kfonline=0&lang=cn&resize=yes&charset=GBK&kflist=off&kf=&zdkf_type=1"+ hz6d_referer + hz6d_from_page + "&lytype=0&tpl_name=crystal_blue&tpl_width=703&tpl_height=473' type='text/javascript' id='ivt_script'></scr"+"ipt>");  

  var kf_script_num = 0;
  var script_total = document.getElementsByTagName('script');
  for (var i = 0; i < script_total.length; i++)
  {
    if (script_total[i].src.indexOf('kf.php') != -1)
    {
      kf_script_num += 1;
      break;
    }
  }
	if (kf_script_num <= 1)
  {
    document.write('<iframe src="" frameborder="0" style="overflow: hidden; position: absolute;height:0;width:0" id="hz6d_im_iframe"></iframe>');
    function init_zdytb_arr(zdytb_str)
    {
      // 生成 图标 数组 
      var zdytb_arrs = [];
      var tmp_arrs = zdytb_str.split('#');
      for (var i = 0; i < tmp_arrs.length; i++)
      {
        zdytb_arrs[i] = [];
        zdytb_arrs[i] = tmp_arrs[i].split(',');
      }
      return zdytb_arrs;
    }

    function get_input_name_pos(_input_name_arr,_input_name)
    {
      // 获取自定义图标 输入值位置 
      var _pos = 0;
      for (var i = 0; i < _input_name_arr.length; i++)
      {
        if (_input_name_arr[i] == _input_name)
        {
          _pos = i;
          break;
        }
      }
      return _pos;
    }

    // 组装自定义图标div 
    function get_zdytb_divs(on_off,zdytb_on_arrs,zdytb_off_arrs,kficon_click_str)
    {
      var element_arrs = (String(on_off) == '1') ? zdytb_on_arrs : zdytb_off_arrs;
      
      var divs_str = '';
      for (var i = 0; i < element_arrs.length; i++)
      {
        var element_arr = element_arrs[i];
        var css_arr_1 = css_name_arr_1;
        //var css_arr_2 = css_name_arr_2;
        var css_arr_3 = css_name_arr_3;
        var css_str = '';
        var link_str = '';
        var target_str = '';
        var text_str = '';
        var click_str = '';

        // 处理css 
        for (var j = 0;j < css_arr_3.length; j++)
        {
          var css_pos = css_arr_3[j];
          if (element_arr[css_pos] == '' || element_arr[css_pos] == '-')
            continue;
          if (css_pos == 8 && element_arr[css_pos].indexOf('http://') == -1)
            element_arr[css_pos] = "http://" + "www41.53kf.com" + "/" + element_arr[css_pos];
          css_str += css_arr_1[j].replace("c_c",element_arr[css_pos]) + ';';
        }
        
        // 处理文本内容 
        var text_type_pos = get_input_name_pos(input_name_arr,'text_type');
        var text_content_pos = get_input_name_pos(input_name_arr,'text_content');
        var tmp_type = element_arr[text_type_pos].Trim();
        var tmp_text = element_arr[text_content_pos].Trim().replace(/&amp;/g, '&').HtmlDecode();
        if (tmp_type != '' && tmp_type != '-' && tmp_text != '' && tmp_text != '-')
        {
          text_str = tmp_text; 
        }
        
        // 处理连接 
        var element_type_pos = get_input_name_pos(input_name_arr,'element_type');
        var link_href_pos = get_input_name_pos(input_name_arr,'link_href');
        var tmp_e_type = element_arr[element_type_pos].Trim();
        var tmp_herf = element_arr[link_href_pos].Trim().replace(/&amp;/g, '&').HtmlDecode();
        var im_account_pos = get_input_name_pos(input_name_arr,'im_account');
        var tmp_im_account = element_arr[im_account_pos].Trim();
        if ((tmp_e_type == '' || tmp_e_type == '-') && tmp_herf.Trim().replace('http://','') != '' && tmp_herf.Trim() != '-')
        {
          link_str = tmp_herf.Trim();
        }
        else
        {
					switch (tmp_e_type)
          {
            case 'chat': click_str = kficon_click_str; break;
            case 'close': click_str = 'this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode)'; break; 
            case 'etel': click_str = 'window.open(\'http://chat.53kf.com/eht.php?company_id=70840187&style_id=103789644\',\'_blank\',\'height=400,width=300,top=100,left=200,status=yes,toolbar=no,menubar=no,resizable=no,scrollbars=no,location=no,titlebar=no\')'; break;
            case 'qq': if (tmp_im_account != '' && tmp_im_account != '-') link_str = 'tencent://message/?uin=' + tmp_im_account; if(tmp_im_account == ['97559766'][0]) link_str=['http://www.365123.com'][0]; break;
            case 'wang': if (tmp_im_account != '' && tmp_im_account != '-') link_str = 'aliim://sendmsg?touid=cntaobao' + tmp_im_account; if(tmp_im_account == ['fonlue'][0]) link_str=['http://www.365123.com'][0]; break;
            case 'msn': if (tmp_im_account != '' && tmp_im_account != '-') link_str = 'msnim:chat?contact=' + tmp_im_account; if(tmp_im_account.indexOf(['fonlue'][0]) > -1) link_str=['http://www.365123.com'][0]; break;
            default: link_str = '';click_str = '';
          }
        }
        // 处理是否新窗口 
        var link_target_pos = get_input_name_pos(input_name_arr,'link_target');
        var tmp_target = element_arr[link_target_pos].Trim();
        if (tmp_target == '' || tmp_target == '-' || tmp_target == '_blank') target_str = '_blank';
        else target_str = '_self';
        // if (tmp_im_account != '' && tmp_im_account != '-' && link_str != '') 
        // {
          //click_str = "chatwindow = window.open('','','width=1,height=1,top=0,left=0');chatwindow.location='" + link_str + "';if(typeof chatwindow != 'undefined') closeTimer = window.setInterval(function(){chatwindow.close();},1000);else window.clearInterval(closeTimer);";
          // click_str = "hz6d$('hz6d_im_iframe').src='" + link_str + "'";
          // link_str = '';
        // }
        
        var onclick_str = '';
        if (link_str == '' && click_str != '') onclick_str = 'onclick="' + click_str + ';"';
        else if (link_str != ''&& click_str != '') onclick_str = ' onclick="' + click_str + ';window.open(\'' + link_str +'\',\'' + target_str + '\');" ';
        else if (link_str != ''&& click_str == '') onclick_str = ' onclick="window.open(\'' + link_str +'\',\'' + target_str + '\');" ';
        
        if (link_str != '' || click_str != '') css_str += "cursor: pointer;";
        var height_str = element_arr[get_input_name_pos(input_name_arr,'div_height')];
        if (text_str != '') css_str += "line-height: " + height_str + "px;";
        //if (text_str != '') css_str += "padding-top: " + parseInt(height_str/2) + "px;" + "padding-bottom: " + parseInt(height_str/2) + "px;";
        // 组装成div 
        
        var title_str = '';
        if (text_str != ''&& onclick_str != '')
        {
          title_str = 'title=\"' + text_str + '\"';
        }
				link_str = link_str.replace('http://www.53kf.com',powered_by_53kf_url);
				onclick_str =  onclick_str.replace('http://www.53kf.com',powered_by_53kf_url);
        if(i == 0)
        {
          onclick_str = '';
          divs_str += "<div style=\"position: relative;overflow: hidden;z-index:10086;" + css_str + "\" " + onclick_str + ">";
        }
        else if(tmp_im_account != '' && tmp_im_account != '-' && link_str != '')
        {
          divs_str += "<a href=\"" + link_str+ "\" target=\"_blank\"><div style=\"position: absolute;overflow: hidden;text-decoration:none;" + css_str + "\" " + title_str + ">" + text_str + "</div></a>";
        }
        else
        {
          divs_str += "<div style=\"position: absolute;overflow: hidden;" + css_str + "\" " + onclick_str + title_str + ">" + text_str + "</div>";
        }
      }
      divs_str += '</div>';
      return divs_str;
    }
    String.prototype.Trim = function()
    {
      var tmp = this.replace(/(^\s*)|(\s*$)/g, "");
      return tmp;
    }
    String.prototype.HtmlDecode = function()
    {
      var msg = this.replace(/&amp;/g, '&').replace(/&quot;/g, '\"').replace(/&#039;/g, '\'').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&douhao/g,",").replace(/&jinghao/g,'#');
      return msg;
    }

    // 定义全局解码数组 
    var css_name_arr_1 = ["width: c_cpx","height: c_cpx","left: c_cpx","top: c_cpx","z-index: c_c","background-image: url(c_c)","background-repeat: c_c","background-color: #c_c","font-size: c_cpx","color: #c_c","text-align:c_c","font-weight: c_c","font-style: c_c","text-decoration: c_c","font-family:c_c","border-style: c_c","border-width: c_cpx","border-color:#c_c;word-break:break-all;"];
    var css_name_arr_2 = ["div_width","div_height","div_left","div_top","div_zindex","bg_img_url","bg_img_repeat","bg_color","font_size","text_color","text_align","font_bold","font_italic","text_underline","font_family","border_style","border_width","border_color"];
    var css_name_arr_3 = [3,4,5,6,7,8,9,10,14,15,16,17,18,19,20,21,22,23];
    var input_name_str = 'element_id#element_name#element_type#div_width#div_height#div_left#div_top#div_zindex#bg_img_url#bg_img_repeat#bg_color#im_account#text_type#text_content#font_size#text_color#text_align#font_bold#font_italic#text_underline#font_family#border_style#border_width#border_color#link_href#link_target';
    var input_name_arr = input_name_str.split('#'); // 初始化解码数组 
	}
  
				function _createIconDivMain()
				{
					if (hz6d$(this.config["iconDiv"]) == null)
					{
						var id = this.config["id"];
						setTimeout('kf_icons[' + id + '].createIconDivMain()', 500);
						return;
					}
					if (hz6d$(this.config["iconDiv"]).innerHTML.indexOf('.gif') != -1 || hz6d$(this.config["iconDiv"]).innerHTML.indexOf('.jpg') != -1 || hz6d$(this.config["iconDiv"]).innerHTML.indexOf('.swf') != -1)
					{
						 return;
					}
					var imgsrc = '';
					if (this.config["isonline"] == 1)
					{
						imgsrc = this.config["img_on"];
					}
					else
					{
						imgsrc = this.config["img_off"];
					}
					var html = "";
					html += "<iframe style='position:absolute;z-index:7998;width:0px;height:0px;top:0px;left:0px;' frameborder='0' ></iframe>";
					var kf = "<div onclick=\"setIsinvited();kf_icons[" + this.config["id"] + "].wopen('" + this.setParameter() + "')\" style='width:" + this.config["width"] + "px;height:" + this.config["height"] + "px;background:url(\"" + imgsrc + "\") no-repeat;cursor:pointer;'></div>";
					if (this.config["record_url"] != "" && this.config["isonline"] == 0)
					{
						kf = "<a href=\"" + this.config["record_url"] + "\" target='_blank'><div style='width:" + this.config["width"] + "px;height:" + this.config["height"] + "px;background:url(\"" + imgsrc + "\") no-repeat;cursor:pointer;'></div></a>";
					}
          if ("" == '' || "" == ''  || "no" == 'no')
          {
						kf += '<div style="text-align:right"><a style="color:#999;stylefont-size:11px;margin-right:3px;display:inline-block;width:156;text-decoration:none;line-height:20px;;display:none;" onmouseout="this.style.textDecoration=\'none\'" onmouseover="this.style.textDecoration=\'underline\'" target="_blank" href="' + powered_by_53kf_url + '">' + powered_by_53kf_txt + '</a></div>';
            html += "<div id='" + this.config["iconDivMain"] + "' style='z-index:10085;display:" + this.display + ";left: " + this.left + "px; top: " + this.top + "px;width:" + this.config["width"] + "px;height:" + (parseInt(this.config["height"],10) + 20) +  "px; overflow:hidden;POSITION: absolute;'>" + this.closeIcon() + kf + "</div>";
          }
          else
          {
            html += "<div id='" + this.config["iconDivMain"] + "' style='z-index:10085;display:" + this.display + ";left: " + this.left + "px; top: " + this.top + "px;width:" + this.config["width"] + "px;height:" + this.config["height"] + "px; overflow:hidden;POSITION: absolute;'>" + get_zdytb_divs(this.config["isonline"],this.config["zdytb_on_arrs"],this.config["zdytb_off_arrs"],kf_icons[this.config["id"]].getClickUrl()) + "</div>";
          }
					hz6d$(this.config["iconDiv"]).innerHTML = html;
					this.iconDivMain = hz6d$(this.config["iconDivMain"]);
				}	function set_hz6d_bottom_logo() {
		try {
			if ('server' != "oem")
			{
				hz6d$("hz6d_bottom_logo").style.textAlign = 'right';
				hz6d$("hz6d_bottom_logo").style.textIndent = '0px';
				if("blue" == 'pink' || "blue" == 'yellow2'  || "blue" == 'blue2')
				{
					hz6d$("hz6d_bottom_logo").style.lineHeight = hz6d$("hz6d_bottom_logo").parentNode.offsetHeight + 'px';
					hz6d$("hz6d_bottom_logo").style.position = 'relative';
					hz6d$("hz6d_bottom_logo").style.top = '6px';
				}
				hz6d$("hz6d_bottom_logo").style.backgroundImage = '';
				if ("" == true) {
					hz6d$("hz6d_bottom_logo").innerHTML  = '<a style="text-decoration:none;color:#999;display:inline-block;margin-right:8px;font-size:11px;;display:none;" onmouseout="this.style.textDecoration=\'none\'" onmouseover="this.style.textDecoration=\'underline\'" target="_blank" href="' + powered_by_53kf_url + '">' + powered_by_53kf_txt + '</a>';
				}
				else {
					hz6d$("hz6d_bottom_logo").innerHTML  = '<a style="text-decoration:none;color:#999;display:inline-block;margin-right:8px;font-size:11px;;display:none;" onmouseout="this.style.textDecoration=\'none\'" onmouseover="this.style.textDecoration=\'underline\'" target="_blank" href="' + powered_by_53kf_url + '">' + hz6d$("hz6d_bottom_logo").innerHTML + '</a>';
				}
				hz6d$("hz6d_bottom_logo").style.display = '';
			}
		} catch(e) {
			setTimeout(set_hz6d_bottom_logo,100);
		}
	}		if (typeof(kf_icons) == "undefined")
		{
			var kf_icons = new Array();

			function hishow(id, img_url)
			{
				var divname = "hsdiv" + id;
				if (hz6d$(divname).style.display == "none")
				{
					hz6d$(divname).style.display = "block";
					hz6d$("arrow" + id).src = "http://www41.53kf.com/" + img_url + "arrow1.gif";
				}
				else
				{
					hz6d$(divname).style.display = "none";
					hz6d$("arrow" + id).src = "http://www41.53kf.com/" + img_url + "arrow2.gif";
				}
			}

			function kfIcon()
			{
				this.config = new Array();
				this.left = -200; // 图标需要到达的 left 
				this.top = 0;
				this.width = 0; // 图标宽度 
				this.height = 0; // 图标宽度 
				this.offsetLeft = 0; // 距离左侧宽度，包括滚动过的距离 
				this.offsetTop = 0; //距离顶部宽度，包括滚动过的距离 
				this.scrolledX = 0; //图标水平滚动条滚动过的距离 
				this.scrolledY = 0;
				this.issmooth = false; //是否平滑移动 
				this.loopmillisecond = 10; //图标循环定位的毫秒，数值越大越慢，对CPU影响越小 
				this.Xstep = 4; //水平步进基数,数字越大越平滑，也越慢 
				this.Ystep = 4;
				this.pageW = 0; //页面总宽度 
				this.pageH = 0;
				this.display = ""; //是否显示图标,值 "none"|"" 
				this.iconDiv = null;
				this.iconDivMain = null;
				this.autoScrollTimer = null;
				this.init = _init;
				this.autoScroll = scroll;
				this.createIconDivMain = _createIconDivMain; // 
				this.setParameter = _setParameter; //在 createIconDivMain 中调用 
				this.wopen = _wopen; //同上 
				this.closeIcon = _closeIcon; //同上 
				this.hidden = _hidden; //同上 
        this.getClickUrl = _getClickUrl; // 获取点击的url 
			};

			function scroll()
			{
				//this.createIconDivMain();
				//if(hz6d$("Xstep"))
				//this.Xstep=hz6d$("Xstep").value;
				//if(hz6d$("Ystep"))
				//this.Ystep=hz6d$("Ystep").value;
				//alert("scroll");
				try
				{
					this.offsetLeft = this.iconDivMain.offsetLeft;
					this.width = parseInt(this.iconDivMain.style.width.replace("px", ""));
					this.height = parseInt(this.iconDivMain.style.height.replace("px", ""));
				}
				catch (e)
				{
					//this.iconDivMain=hz6d$(this.config["iconDivMain"]);
					return;
				}

				this.scrollbarW = 20; // scrollbar width in ie6,ie7,ie8 = 20px
				this.scrollbarH = 20; // scrollbar width in ie6,ie7,ie8 = 20px
				this.scrolledY = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
				this.scrolledX = Math.max(document.body.scrollLeft, document.documentElement.scrollLeft);
				if (browser == "ie6")
				{
					this.pageH = document.documentElement.offsetHeight;
					this.pageW = document.documentElement.offsetWidth + 3;
				}
				else if (browser == "ie7")
				{
					this.pageH = document.documentElement.offsetHeight;
					if (hasdoctype) this.pageW = document.documentElement.offsetWidth + 21;
					else this.pageW = document.documentElement.offsetWidth;
				}
				else if (browser == "ie8")
				{
					this.pageH = document.documentElement.offsetHeight;
					this.pageW = document.documentElement.offsetWidth;
				}
				else if (browser == "firefox")
				{
					this.pageH = window.innerHeight;
					// 21=17+4
					// 17 for document.documentElement.clientWidth in firefox 3
					// 4 for document.documentElement.scrollLeft in firefox 3 differently from ie6,ie7
					this.pageW = document.documentElement.clientWidth + 21;
				}
				else
				{
					this.pageH = document.documentElement.offsetHeight;
					this.pageW = document.documentElement.offsetWidth;
				}

				if (this.config["v_showmodel"] == 1)
				{
					if (this.top != (this.scrolledY + this.pageH))
					{
						var iconDivHeight = this.scrolledY + this.config["offsetH"] - this.offsetTop;
						iconDivHeight = (iconDivHeight > 0 ? 1 : -1) * Math.ceil(Math.abs(iconDivHeight));
						this.top = this.offsetTop + iconDivHeight;
					}
				}
				else
				{
					if (this.top != (this.scrolledY + this.pageH - this.height - this.config["offsetH"] - this.scrollbarH))
					{
						var iconDivHeight = this.scrolledY + this.pageH - this.height - this.config["offsetH"] - this.scrollbarH - this.offsetTop;
						iconDivHeight = (iconDivHeight > 0 ? 1 : -1) * Math.ceil(Math.abs(iconDivHeight));
						this.top = this.offsetTop + iconDivHeight;
					}
				}

				if (this.config["showmodel"] == 1)
				{
					if (this.left != (this.scrolledX + this.pageW))
					{
						var iconDivWidth = this.scrolledX + this.config["offsetW"] - this.offsetLeft;
						iconDivWidth = (iconDivWidth > 0 ? 1 : -1) * Math.ceil(Math.abs(iconDivWidth));
						this.left = this.offsetLeft + iconDivWidth;
					}
				}
				else
				{
					if (this.left != (this.scrolledX + this.pageW - this.width - this.config["offsetW"] - this.scrollbarW))
					{
						var iconDivWidth = this.scrolledX + this.pageW - this.width - this.config["offsetW"] - this.scrollbarW - this.offsetLeft;
						iconDivWidth = (iconDivWidth > 0 ? 1 : -1) * Math.ceil(Math.abs(iconDivWidth));
						this.left = this.offsetLeft + iconDivWidth;
					}
				}

				//set kf_icon postiotn
				//超出窗口边界，直接移动到窗口边界再平滑移动 
				var left = parseInt(this.iconDivMain.style.left.replace("px", ""));
				var top = parseInt(this.iconDivMain.style.top.replace("px", ""));

				if (this.issmooth == true)
				{
					if (left != this.left)
					{
						if (left < (this.scrolledX - this.width)) left = this.scrolledX - this.width;
						if (left > this.scrolledX + this.pageW) left = this.scrolledX + this.pageW;
						left = smoothMove(left, this.left);
					}
					if (top != this.top)
					{
						if (top < (this.scrolledY - this.height)) top = this.scrolledY - this.height;
						if (top > this.scrolledY + this.pageH) top = this.scrolledY + this.pageH;
						top = smoothMove(top, this.top);
					}
				}
				else if (this.issmooth == false)
				{
					left = this.left;
					top = this.top;
					this.issmooth = true;
				}

				this.iconDivMain.style.left = left + "px";
				this.iconDivMain.style.top = top + "px";
			};

			function _wopen(com)
			{
				if (this.config["is_zdyurl"] == 1) window.open(this.config["zdyurl"], "_blank", "height=" + 473 + ",width=" + 703 + ",top=200,left=200,status=yes,toolbar=no,menubar=no,resizable=yes,scrollbars=no,location=no,titlebar=no");
				else window.open(this.config["server_path"] + "/webCompany.php?arg=" + this.config["arg"] + com, "_blank", "height=" + 473 + ",width=" + 703 + ",top=200,left=200,status=yes,toolbar=no,menubar=no,resizable=yes,scrollbars=no,location=no,titlebar=no");
			};

			function _setParameter()
			{
				var params = "";
				params += this.config["style_id"];
				params += this.config["language"];
				params += this.config["onurl"];
				params += this.config["lytype"];
				params += this.config["lyurl"];
				params += this.config["copartner"];
				params += this.config["username"];
				params += this.config["userinfo"];
				params += this.config["charset"];
				params += this.config["introurl"];
				params += this.config["kf"];
				params += this.config["referer"];
				params += this.config["keyword"];
				params += this.config["tfrom"];
				params += this.config["company_tpl"];
				params += this.config["brief"];
				params += this.config["logo"];
				params += this.config["question"];
				return params;
			};
      
      function _getClickUrl()
      {
        var _click_str = '';
        if (this.config["record_url"] != "" && this.config["isonline"] == 0)
        {
           _click_str += 'window.open(\'' + this.config["record_url"] + '\',\'_blank\')';
        }
        else
        {
          _click_str += 'setIsinvited();';
          if (this.config["is_zdyurl"] == 1)
          {
            _click_str += 'window.open(\'' + this.config["zdyurl"] + '\', \'_blank\', \'height=473,width=703,top=200,left=200,status=yes,toolbar=no,menubar=no,resizable=yes,scrollbars=no,location=no,titlebar=no\')';
          }
          else
          {
            _click_str += 'window.open(\'' + this.config["server_path"] + '/webCompany.php?arg=' + this.config["arg"] + this.setParameter() + '\', \'_blank\', \'height=473,width=703,top=200,left=200,status=yes,toolbar=no,menubar=no,resizable=yes,scrollbars=no,location=no,titlebar=no\')';
          }
        }
        return _click_str;
      }

			function _hidden()
			{
				hz6d_close_icon = 1;
				this.display = "none";
				hz6d$(this.config["iconDivMain"]).style.display = "none";
				try
				{
					clearInterval(kf_icons[this.config["kf_icon_id"]].autoScrollTimer);
				}
				catch (e)
				{}
			};

			function _closeIcon()
			{
				var str_onmove = "";
				if (2 == 1 && ('blue' == "new_blue" || 'blue' == "new_red" || 'blue' == "new_yellow" || 'blue' == "new_green"))
				{
					str_onmove = "onmousemove='this.style.backgroundImage=\"url(http://www41.53kf.com/img/kflist/list_close_move.gif)\"' onmouseout='this.style.backgroundImage=\"url(http://www41.53kf.com/img/kflogo/close.gif)\"'";
				}
				if (0 == 1 || 70840187 == 600603 || 70840187 == 61393572 || 70840187 == 1413303 || 70840187 == 61389920 || 70840187 == 61420906 || 70840187 == 61578368)
				{
					if (2 == 1)
					{
						//return "<img onclick='kf_icons["+this.config["id"]+"].hidden()' style='position:absolute; right:0px;top:0px; cursor:pointer;' src='http://www41.53kf.com/img/kflogo/close.gif' "+str_onmove+" />";
						if ('blue' == "new_blue" || 'blue' == "new_red" || 'blue' == "new_yellow" || 'blue' == "new_green")
						{
							var str_wh = "width:27px;height:16px;";
						}
						else if ('blue' == "blue")
						{
							var str_wh = "width:11px;height:11px;";
						}
						else if ('blue' == "blue2")
						{
							var str_wh = "width:14px;height:14px;";
						}
						else if ('blue' == "yellow")
						{
							var str_wh = "width:14px;height:14px;";
						}
						else if ('blue' == "yellow2")
						{
							var str_wh = "width:14px;height:13px;";
						}
						else if ('blue' == "black")
						{
							var str_wh = "width:14px;height:14px;";
						}
						else if ('blue' == "pink")
						{
							var str_wh = "width:18px;height:18px;";
						}
						else
						{
							var str_wh = "width:11px;height:11px;";
						}
						return "<div onclick='kf_icons[" + this.config["id"] + "].hidden()' style='" + str_wh + "background:url(\"http://www41.53kf.com/img/kflogo/close.gif\") no-repeat;position:absolute;right:0px;top:0px;cursor:pointer;' " + str_onmove + " ></div>";
					}
					//return "<img onclick='kf_icons["+this.config["id"]+"].hidden()' style='position:absolute; right:0px;top:0px; cursor:pointer;' src='http://www41.53kf.com/img/kflogo/close.gif' />";
					return "<div onclick='kf_icons[" + this.config["id"] + "].hidden()' style='width:11px;height:11px;background:url(\"http://www41.53kf.com/img/kflogo/close.gif\") no-repeat;position:absolute;right:0px;top:0px;cursor:pointer;' ></div>";
				}
				return "";
			};

			function _init()
			{
				document.write('<div id="' + this.config["iconDiv"] + '" ></div>');
				this.iconDiv = hz6d$(this.config["iconDiv"]);
				this.createIconDivMain();
			};
		}

		if (typeof(kf_icon_id) == "undefined") kf_icon_id = 1;
		else kf_icon_id++;
		kf_icons[kf_icon_id] = new kfIcon();
		kf_icons[kf_icon_id].config["id"] = kf_icon_id;
		kf_icons[kf_icon_id].config["arg"] = "happy-englisth";
		//kf_icons[kf_icon_id].config["logo_id"]="201101";
		kf_icons[kf_icon_id].config["style_id"] = "&style=1";
		kf_icons[kf_icon_id].config["isonline"] = "0";
    kf_icons[kf_icon_id].config["zdytb_on_arrs"] = [];
    kf_icons[kf_icon_id].config["zdytb_off_arrs"] = [];
    if (2 == 2)kf_icons[kf_icon_id].config["zdytb_on_arrs"] = init_zdytb_arr("1,\u5916\u6846,-,156,362,-,-,1,-,no-repeat,-,-,-,-,12,-,-,-,-,none,\u5b8b\u4f53,-,-,-,-,_blank#2,\u5728\u7ebf\u56fe\u6807,chat,156,362,0,0,2,http:\/\/www41.53kf.com\/img\/kflogo\/cn\/201101.gif,no-repeat,-,-,zdy,-,12,000000,-,-,-,none,\u5b8b\u4f53,-,-,-,-,_blank");
    if (2 == 2)kf_icons[kf_icon_id].config["zdytb_off_arrs"] = init_zdytb_arr("1,\u5916\u6846,-,156,362,-,-,1,-,no-repeat,-,-,-,-,12,-,-,-,-,none,\u5b8b\u4f53,-,-,-,-,_blank#2,\u79bb\u7ebf\u56fe\u6807,chat,156,362,0,0,2,http:\/\/www41.53kf.com\/img\/kflogo\/cn\/201101_off.gif,no-repeat,-,-,zdy,-,12,000000,-,-,-,none,\u5b8b\u4f53,-,-,-,-,_blank");
		kf_icons[kf_icon_id].config["img_on"] = "http://www41.53kf.com/img/kflogo/cn/201101.gif";
		kf_icons[kf_icon_id].config["img_off"] = "http://www41.53kf.com/img/kflogo/cn/201101_off.gif";
		kf_icons[kf_icon_id].config["height"] = "362";
		kf_icons[kf_icon_id].config["width"] = "156";
		kf_icons[kf_icon_id].config["auto_hidden_img"] = "";
		kf_icons[kf_icon_id].config["hidden_img_height"] = "";
		kf_icons[kf_icon_id].config["hidden_img_width"] = "";
		kf_icons[kf_icon_id].config["showmodel"] = parseInt("2");
		kf_icons[kf_icon_id].config["offsetW"] = parseInt("1");
		kf_icons[kf_icon_id].config["v_showmodel"] = parseInt("1");
		kf_icons[kf_icon_id].config["offsetH"] = parseInt("200");
		kf_icons[kf_icon_id].config["language"] = "&language=cn";
		kf_icons[kf_icon_id].config["username"] = "";
		kf_icons[kf_icon_id].config["userinfo"] = "";
		kf_icons[kf_icon_id].config["charset"] = "&charset=GBK";
		kf_icons[kf_icon_id].config["introurl"] = "";
		kf_icons[kf_icon_id].config["onurl"] = "";
		kf_icons[kf_icon_id].config["lytype"] = "&lytype=0";
		kf_icons[kf_icon_id].config["lyurl"] = "";
		kf_icons[kf_icon_id].config["copartner"] = "";
		kf_icons[kf_icon_id].config["kf"] = "&kflist=off&kf=&zdkf_type=1";
		kf_icons[kf_icon_id].config["referer"] = hz6d_referer;
		kf_icons[kf_icon_id].config["keyword"] = hz6d_from_page;
		kf_icons[kf_icon_id].config["tfrom"] = "&tfrom=1";
		kf_icons[kf_icon_id].config["record_url"] = "";
		var hz6d_zdyurl = "?arg=happy-englisth&style=1&kflist=off&kf=&zdkf_type=1&language=cn&charset=GBK&lytype=0&referer={hz6d_referer}{hz6d_keyword}&tpl=crystal_blue";
		hz6d_zdyurl = hz6d_html_replace(hz6d_zdyurl);
		kf_icons[kf_icon_id].config["zdyurl"] = hz6d_zdyurl;
		kf_icons[kf_icon_id].config["is_zdyurl"] = "0";
		kf_icons[kf_icon_id].config["path"] = "http://chat.53kf.com";
		kf_icons[kf_icon_id].config["server_path"] = "http://www41.53kf.com";
		kf_icons[kf_icon_id].config["company_tpl"] = "&tpl=crystal_blue";
		kf_icons[kf_icon_id].config["brief"] = "";
		kf_icons[kf_icon_id].config["logo"] = "";
		kf_icons[kf_icon_id].config["iconDivMain"] = "iconDivMain" + kf_icon_id;
		kf_icons[kf_icon_id].config["iconDiv"] = "iconDiv" + kf_icon_id;
		kf_icons[kf_icon_id].config["question"] = "";
		kf_icons[kf_icon_id].init();
		kf_icons[kf_icon_id].autoScrollTimer = window.setInterval("kf_icons[" + kf_icon_id + "].autoScroll()", kf_icons[kf_icon_id].loopmillisecond);