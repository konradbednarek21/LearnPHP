// -----------------------------------------------------------------------------
var sessionTimeOut = 0;
var currentSessionTime = 0;
var timeoutHandler;
// -----------------------------------------------------------------------------
function getRandomString(dl)
{
	var keychars = new String("abcdefghijklmnopqrstuvwxyz");
	var randkey = new String();
	var max = keychars.length - 1;
	for (var i = 0; i < dl; i++)
	{
		var los = Math.floor(Math.random() * max);
		randkey += keychars.substring(los, los + 1);
	}
	return randkey;
}
// -----------------------------------------------------------------------------
function beforeSubmit(sender)
{
	var a = sender.length;
	for (var i = 0; i < a; i++)
	{
		var tmp = sender.elements[i];
		if ($(tmp).parent().hasClass("has-error"))
		{
			alert("Formularz zawiera błędy. Wyróżnione pola nie zostały wypełnione lub zostały wypełnione błędnie");
			return false;
		}
	}
	return true;
}
// -----------------------------------------------------------------------------
function addAlert(text)
{
	text = text.toString().replace(/&nbsp;/g, "&#160;");
	var tmp = new String();
	tmp = "<span class='sprite spriteAlerticon zLewej' />";
	tmp += "<span class='infoText'>" + text + "</span>";
	tmp = "<p class='clear'>" + tmp + "</p>";
	$("#MessageArea").html("<div>" + tmp + "</div>");
	$(document).scrollTop(0);
}
// -----------------------------------------------------------------------------
function checkIsNull(sender)
{
	if ($(sender).val() == "")
	{
		$(sender).parent().addClass("has-error");
		return false;
	}
	else
	{
		$(sender).parent().removeClass("has-error");
		return true;
	}

}
// -----------------------------------------------------------------------------
function checkRegExPatern(sender, patern)
{
	var str = $(sender).val();
	var regEx = new RegExp(patern);
	if (regEx.test(str))
	{
		$(sender).parent().removeClass("has-error");
		return true;
	}
	else
	{
		$(sender).parent().addClass("has-error");
		return false;
	}

}
// -----------------------------------------------------------------------------
function CzyInt(sender, minValue, maxValue)
{
	return CzyReal(sender, minValue, maxValue, 0);
}
// -----------------------------------------------------------------------------
function comaToPoint(text)
{
	var napis = "";
	for (var i = 0; i < text.length; i++)
	{
		var a = text.substring(i, i + 1);
		if (a == ',')
		{
			a = ".";
		}
		napis += a;
	}
	return napis;
}
// -----------------------------------------------------------------------------
function CzyReal(sender, minValue, maxValue, precision)
{
	var napis = sender.value;
	napis = comaToPoint(napis);

	if (minValue == null)
	{
		minValue = 0;
	}
	if (maxValue == null)
	{
		maxValue = 99999999999999;
	}

	if (isNaN(napis))
	{
		$(sender).parent().addClass("has-error");
		return false;
	}
	else
	{
		if (napis != "")
		{
			var num = new Number(napis);
			if (num < minValue || num > maxValue)
			{
				$(sender).parent().addClass("has-error");
				return false;
			}
			else
			{
				$(sender).parent().removeClass("has-error");
				$(sender).val(num.toFixed(precision));
				return true;
			}
		}
		else
		{
			$(sender).parent().removeClass("has-error");
			return true;
		}
	}
}
// -----------------------------------------------------------------------------
function initSessionTimeCounter(sessTimeOut)
{
	sessionTimeOut = sessTimeOut;
	currentSessionTime = 0;
	initSessionTimeOut();
}
// -----------------------------------------------------------------------------
function updateSessionCouter()
{
	currentSessionTime++;
	if (sessionTimeOut - currentSessionTime > 0)
	{
		updateSessionCouterField();
		initSessionTimeOut();
	}
	else
	{

		var string = "wygasła";
		$("#TimeExpireDesc").html(string);
		setTimeout(function()
		{
			window.location.href = "/";
		}, 10000);
	}
}
// -----------------------------------------------------------------------------
function updateSessionCouterField()
{
	var string = "wygaśnie za: " + Math.round(sessionTimeOut - currentSessionTime) + " min";
	$("#TimeExpireDesc").html(string);
}
// -----------------------------------------------------------------------------
function resetSessionCounter()
{
	try
	{
		clearTimeout(timeoutHandler);
	}
	catch (e)
	{
	}
	currentSessionTime = 0;
	updateSessionCouterField();
	initSessionTimeOut();
}
// -----------------------------------------------------------------------------
function initSessionTimeOut()
{
	timeoutHandler = setTimeout(function()
	{
		updateSessionCouter();
	}, 60000)
}
// -----------------------------------------------------------------------------
function checkParcelNumer(sender)
{
	var numer = $(sender).val();
	if (isNaN(numer))
	{
		if (numer.length == 13)
		{
			if (numer != $(sender).attr("data-sended-nr"))
			{
				$(sender).closest("form").submit();
				$(sender).attr("data-sended-nr", numer);
			}
		}
	}
	else
	{
		if (numer.length == 20)
		{
			if (numer != $(sender).attr("data-sended-nr"))
			{
				$(sender).closest("form").submit();
				$(sender).attr("data-sended-nr", numer);
			}
		}
	}

}
// -----------------------------------------------------------------------------
