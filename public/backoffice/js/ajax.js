var ajax = new Ajax();
// -----------------------------------------------------------------------------
function Ajax()
{
	Ajax.prototype.go = function(sender, asynchronic)
	{
		return go(sender, asynchronic);
	};
	Ajax.prototype.get = function(url, asynchronic)
	{
		return get(url, asynchronic);
	};
	Ajax.prototype.odbierzDane = function(data, textStatus, idMarker)
	{
		return odbierzDane(data, textStatus, idMarker);
	};
	// -------------------------------------------------------------------------
	var toClose = new Array();
	// -------------------------------------------------------------------------
	function get(url, asynchronic)
	{
		if (typeof asynchronic == 'undefined')
		{
			asynchronic = true;
		}
		var random = new String(getRandomString(8));
		if (!asynchronic)
		{
			showLoading(random);
		}
		$.get(url, function(data, textStatus)
		{
			ajax.odbierzDane(data, textStatus, random);
		});
		return false;
	}
	// -------------------------------------------------------------------------
	function go(sender, asynchronic)
	{
		if (typeof synchoniczne == 'undefined')
		{
			asynchronic = false;
		}
		var random = new String(getRandomString(8));
		var domEl = $(sender).get(0);
		if (domEl.tagName.toLowerCase() == "a")
		{
			var url = new String($(sender).attr("href") + "&js=1");
			if (!asynchronic)
			{
				showLoading(random);
			}
			$.get(url, function(data, textStatus)
			{
				ajax.odbierzDane(data, textStatus, random);
			});

		}
		else if (domEl.tagName.toLowerCase() == "form")
		{
			if (beforeSubmit(sender))
			{
				if (!asynchronic)
				{
					showLoading(random);
				}
				var url = sender.getAttribute("action", 2);
				var post = $(sender).serialize() + "&js=1";
				$.post(url, post, function(data, textStatus)
				{
					ajax.odbierzDane(data, textStatus, random);
				});
			}
			else
			{
				hideLoading(random);
			}
		}
		return false;
	}
	// -------------------------------------------------------------------------
	function odbierzDane(data, textStatus, idMarker)
	{
		if (textStatus == "success")
		{
			resetSessionCounter();
			try
			{
				var elementy = data.getElementsByTagName("changes")[0].getElementsByTagName("*");
				for (var i = 0; i < elementy.length; i++)
				{
					var node = elementy[i];
					switch (node.tagName)
					{
						case "change":
							changeElement(node);
							break;
						case "append":
							appendElement(node);
							break;
						case "atrybut":
							changeAttribElement(node);
							break;
						case "popup":
							popUpWinElement(node);
							break;
						case "closePopUp":
							closePopUp(node);
							break;
						case "sustain":
							sustain(node.getAttribute("id"));
							break;
						case "remove":
							remove(node.getAttribute("id"));
							break;
						case "reload":
							reload(node.getAttribute("url"));
							break;
					}
				}
				clean();
			}
			catch (err)
			{
				var window = new PopUpWindow("AlertBox");
				window.create("Błąd: " + err.message);
				window.setContent(data);
			}
		}
		else
		{
			addAlert(data, textStatus);
		}
		hideLoading(idMarker);
	}
	// -------------------------------------------------------------------------
	function reload(url)
	{
		location.href = url;
	}
	// -------------------------------------------------------------------------
	function clean()
	{
		$("div.WindowBox").each(function()
		{
			if (typeof toClose[$(this).children(".WindowBoxContent:first").attr("id")] == "undefined")
			{
				closeWindow($(this).children(".WindowBoxContent:first").attr("id"));
			}
		});
		toClose = new Array();
	}
	// -------------------------------------------------------------------------
	function sustain(id)
	{
		if (id.substr(0, 1) == "#")
		{
			toClose[id.substr(1)] = 2;
		}
		else
		{
			toClose[id] = 1;
		}
	}
	// -------------------------------------------------------------------------
	function remove(id)
	{
		$(id).remove();
	}
	// -------------------------------------------------------------------------
	function closePopUp(node)
	{
		var idObject = node.getAttribute("id");
		closeWindow(idObject);
	}
	// -------------------------------------------------------------------------
	function changeElement(node)
	{
		var idObject = node.getAttribute("id");
		var content = node.childNodes[0].nodeValue;
		$(idObject).html(content);
		$(idObject).trigger('load');
		if (idObject = "#MsgBox")
		{
			var o = $("#MsgBox").offset();
			$(document).scrollTop(o.top);
			$(idObject).show();
		}
		sustain(idObject);
	}
	// -------------------------------------------------------------------------
	function appendElement(node)
	{
		var idObject = node.getAttribute("id");
		var content = node.childNodes[0].nodeValue;
		$(idObject).append(content);
		$(idObject).trigger('load');
		sustain(idObject);
	}
	// -------------------------------------------------------------------------
	function changeAttribElement(node)
	{
		var idObject = node.getAttribute("id");
		var attrbName = node.getAttribute("name");
		var attrbValue = node.getAttribute("value");
		$(idObject).attr(attrbName, attrbValue);
		sustain(idObject);
	}
	// -------------------------------------------------------------------------
	function popUpWinElement(node)
	{
		var idContener = node.getAttribute("id");
		var title = node.getAttribute("title");
		showLoading(idContener);
		var window = new PopUpWindow(idContener);
		window.create(title);
		sustain(idContener);
	}
	// -------------------------------------------------------------------------
	function showLoading(idMarker)
	{
		var idSnow = "#snow_" + idMarker;
		if (!$(idSnow).length)
		{
			$("body:first").append("<div id='snow_" + idMarker + "' class='a' style='background-color:white;' />");
			$(idSnow).width($(document).outerWidth(true));
			$(idSnow).height($(document).height());
			$(idSnow).css("left", "0px");
			$(idSnow).css("top", "0px");
			$(idSnow).css("opacity", "-0.3");
			$(idSnow).fadeTo(3000, 0.7);
			$(window).resize(function()
			{
				$(idSnow).width($(document).outerWidth(true));
				$(idSnow).height($(document).height());
			});
		}
	}
	// -------------------------------------------------------------------------
	function hideLoading(idMarker)
	{
		var idSnow = "#snow_" + idMarker;
		$(idSnow).remove();
	}
	// -------------------------------------------------------------------------
}