var ajax = new Ajax();
var stats = [];
bootbox.setLocale('pl');
// -----------------------------------------------------------------------------
function Ajax()
{
	// -------------------------------------------------------------------------
	var closePopUp = true;
	// -------------------------------------------------------------------------
	Ajax.prototype.odbierzDane = function(data, textStatus, idMarker,  startTime)
	{
		closePopUp = true;
		var d = new Date();
		var endTime = d.getTime();
		var allTime = endTime - startTime;
		if (textStatus == "success")
		{
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
							sustain();
							break;
						case "remove":
							killElement(node);
							break;
						case "time":
							addProcesingStats(node, allTime);
							break;
					}
				}
				$('[data-toggle="tooltip"]').tooltip();
				clean();
			}
			catch (err)
			{
				bootbox.alert({title: 'Błąd: ' + err.message,message:data});
			}
		}
		else
		{
			addAlert(data, textStatus);
		}
		hideLoading(idMarker);		
	};
	// -------------------------------------------------------------------------
	Ajax.prototype.go = function(sender, asynchronic)
	{
		if (typeof synchoniczne == 'undefined')
		{
			asynchronic = false;
		}
		var random = new String(getRandomString(8));
		var domEl = $(sender).get(0);
		var d = new Date();
		var startTime = d.getTime();
		if (domEl.tagName.toLowerCase() == "a")
		{
			var url = new String($(sender).attr("href"));
			url += "&js=true";
			if (!asynchronic)
			{
				showLoading(random);
			}
			$.get(url, function(data, textStatus)
			{
				ajax.odbierzDane(data, textStatus, random,  startTime);
			});

		}
		else if (domEl.tagName.toLowerCase() == "form")
		{
			if (BeforeSubmit(sender))
			{
				if (!asynchronic)
				{
					showLoading(random);
				}
				var url = sender.getAttribute("action", 2);
				post = $(sender).serialize() + "&js=true";
				$.post(url, post, function(data, textStatus)
				{
					ajax.odbierzDane(data, textStatus, random,  startTime);
				});
			}
			else
			{
				hideLoading(random);
			}
		}
		return false;
	};
	// -------------------------------------------------------------------------
	Ajax.prototype.get = function(url, asynchronic)
	{
		if (typeof asynchronic == 'undefined')
		{
			asynchronic = true;
		}

		url += "&js=true";
		var random = new String(getRandomString(8));

		var d = new Date();
		var startTime = d.getTime();
		if (asynchronic)
		{
			$.get(url, function(data, textStatus)
			{
				ajax.odbierzDane(data, textStatus, random, startTime);
			});
		}
		else
		{
			showLoading(random);
			$.ajax(url,
			{
				async : false,
				success : function(data, textStatus)
				{
					ajax.odbierzDane(data, textStatus, random, startTime);
				}

			});
		}
		return false;
	};
	// -------------------------------------------------------------------------
	function clean()
	{		
		if(closePopUp)
		{
			bootbox.hideAll();
		}
	}
	// -------------------------------------------------------------------------
	function sustain()
	{
		closePopUp = false;
	}
	// -------------------------------------------------------------------------
	function addProcesingStats(node, allTime)
	{
		var serverTime = parseInt(node.childNodes[0].nodeValue);
		var networkTime = allTime - serverTime;

		var tmp =
		{
			serverTime : serverTime,
			networkTime : networkTime,
			allTime : allTime
		};
		stats.push(tmp);
		if (stats.length > 10)
		{
			stats.shift();
		}

		var serverTimeSum = 0;
		var networkTimeSum = 0;
		var allTimeSum = 0;
		for (var int = 0; int < stats.length; int++)
		{
			var tmp = stats[int];
			serverTimeSum += tmp.serverTime;
			networkTimeSum += tmp.networkTime;
			allTimeSum += tmp.allTime;
		}

		var networkTimeAvg = Math.round(networkTimeSum / stats.length);
		var serverTimeAvg = Math.round(serverTimeSum / stats.length);
		var allTimeAvg = Math.round(allTimeSum / stats.length);

		var statsBoxContent = "<p>last req";
		statsBoxContent += "<span style='color:" + getColor(networkTime) + "'>Sieć: " + networkTime + " ms</span>";
		statsBoxContent += "<span style='color:" + getColor(serverTime) + "'>Serwer: " + serverTime + " ms</span>";
		statsBoxContent += "<span style='color:" + getColor(allTime) + "'>Razem: " + allTime + " ms</span></p>";
		statsBoxContent += "<p>last 10 req";
		statsBoxContent += "<span style='color:" + getColor(networkTimeAvg) + "'>Sieć: " + networkTimeAvg + " ms</span>";
		statsBoxContent += "<span style='color:" + getColor(serverTimeAvg) + "'>Serwer: " + serverTimeAvg + " ms</span>";
		statsBoxContent += "<span style='color:" + getColor(allTimeAvg) + "'>Razem: " + allTimeAvg + " ms</span></p>";

		$("#StatsBox").html(statsBoxContent);
	}
	// -------------------------------------------------------------------------
	function getColor(time)
	{
		if (time < 1000)
		{
			return "green";
		}
		else if (time < 2000)
		{
			return "yellow";
		}
		else
		{
			return "red";
		}

	}
	// -------------------------------------------------------------------------
	function closePopUp(node)
	{
		bootbox.hideAll();
	}
	// -------------------------------------------------------------------------
	function changeElement(node)
	{
		var idObject = node.getAttribute("id");
		var content = node.childNodes[0].nodeValue;
		$(idObject).html(content);
		$(idObject).trigger('load');
		$(idObject).show();
	}
	// -------------------------------------------------------------------------
	function killElement(node)
	{
		var idObject = node.getAttribute("id");
		$(idObject).remove();
	}
	// -------------------------------------------------------------------------
	function appendElement(node)
	{
		var idObject = node.getAttribute("id");
		var content = node.childNodes[0].nodeValue;
		$(idObject).append(content);
		$(idObject).trigger('load');
	}
	// -------------------------------------------------------------------------
	function changeAttribElement(node)
	{
		var idObject = node.getAttribute("id");
		var attrbName = node.getAttribute("name");
		var attrbValue = node.getAttribute("value");
		$(idObject).attr(attrbName, attrbValue);
	}
	// -------------------------------------------------------------------------
	function popUpWinElement(node)
	{
		var idContener = node.getAttribute("id");
		var title1 = node.getAttribute("title");
		bootbox.dialog( {
			title:title1 , 
			message: '<div id="'+idContener+'"></div>'
			});
		sustain();
	}
	// -------------------------------------------------------------------------
	function showLoading(idMarker)
	{
		var idSnow = "#snow_" + idMarker;
		if (!$(idSnow).length)
		{
			$("body:first").append("<div id='snow_" + idMarker + "' class='a ui-widget-overlay'></div>");
			$(idSnow).width($("body:first").outerWidth(true));
			$(idSnow).height($(document).height());
			$(idSnow).css("left", "0px");
			$(idSnow).css("top", "0px");
			$(idSnow).css("opacity", "-0.3");
			$(idSnow).css("z-index", "10");
			$(idSnow).fadeTo(5000, 0.7);
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