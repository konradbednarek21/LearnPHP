// +++++++++++++++++++++++++++++++++++++++++++++++++
$(function()
{
	$('[data-toggle="tooltip"]').tooltip();
})
// -----------------------------------------------------------------------------
$(document).on('change', ':file', function()
{
	var input = $(this), numFiles = input.get(0).files ? input.get(0).files.length : 1, label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [
			numFiles, label
	]);
});
// +++++++++++++++++++++++++++++++++++++++++++++++++
// -----------------------------------------------------------------------------
function listGroupItemAjax(event, sender, idContener, href)
{
	if ($("#" + idContener).hasClass("hidden"))
	{
		$(sender).addClass("fa-caret-down");
		$("#" + idContener).removeClass("hidden");
		$(sender).removeClass("fa-caret-right");
		ajax.get(href);
	}
	else
	{
		$(sender).removeClass("fa-caret-down");
		$("#" + idContener).addClass("hidden");
		$(sender).addClass("fa-caret-right");
	}
	event.stopPropagation();
}
// -----------------------------------------------------------------------------
function initBSFileField(idSender)
{
	$(document).ready(function()
	{
		$('#' + idSender).on('fileselect', function(event, numFiles, label)
		{
			$('#' + idSender).parent().contents().first()[0].textContent = 'Wybrano plik: ' + label;
		});
	});
}
// -----------------------------------------------------------------------------
function ValidEmail(mail, req)
{
	if (req && (mail.length == 0))
	{
		return false;
	}
	var val = new String(mail);
	var regexEmail = /^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/i;
	if (regexEmail.test(val))
	{
		if (val.indexOf("&") != -1)
		{
			return false;
		}
		return true;
	}
	return false;
}
// -----------------------------------------------------------------------------
function CheckEmail(sender, req)
{
	var val = $(sender).val();
	if ((val.length > 0) || (req == true))
	{
		$(sender).addClass("ui-state-error");
		if (ValidEmail(val))
		{
			$(sender).removeClass("ui-state-error");
		}
	}
	else if (req)
	{
		$(sender).addClass("ui-state-error");
	}
	else
	{
		$(sender).removeClass("ui-state-error");
	}
}
// -----------------------------------------------------------------------------
function checkRegExPatern(sender, patern)
{
	var styleAlert = "has-error";
	var str = $(sender).val();
	var regEx = new RegExp(patern);
	if (regEx.test(str))
	{
		$(sender).parent().removeClass(styleAlert);
		return true;
	}
	else
	{
		$(sender).parent().addClass(styleAlert);
		return false;
	}

}
// -----------------------------------------------------------------------------
function checkNIP(sender, req)
{
	nip = $(sender).val();
	nip = nip.replace(/[^0-9]+/g, '');
	$(sender).val(nip);

	if (nip.length > 0)
	{
		if (nip.length != 10)
		{
			$(sender).addClass("ui-state-error");
			return false;
		}
		var controlSum = 0;
		controlSum += parseInt(nip.charAt(0)) * 6;
		controlSum += parseInt(nip.charAt(1)) * 5;
		controlSum += parseInt(nip.charAt(2)) * 7;
		controlSum += parseInt(nip.charAt(3)) * 2;
		controlSum += parseInt(nip.charAt(4)) * 3;
		controlSum += parseInt(nip.charAt(5)) * 4;
		controlSum += parseInt(nip.charAt(6)) * 5;
		controlSum += parseInt(nip.charAt(7)) * 6;
		controlSum += parseInt(nip.charAt(8)) * 7;
		var cyfraKontrolna = controlSum % 11;
		if (cyfraKontrolna == 10)
		{
			cyfraKontrolna = 0;
		}
		if (cyfraKontrolna == parseInt(nip.charAt(9)))
		{
			$(sender).removeClass("ui-state-error");
			return true;
		}
		else
		{
			$(sender).addClass("ui-state-error");
			return false;
		}

	}
	else if (req)
	{
		$(sender).addClass("ui-state-error");
		return false;
	}
	else
	{
		$(sender).removeClass("ui-state-error");
		return true;
	}
}
// -----------------------------------------------------------------------------
function checkRegon(sender, req)
{
	regon = $(sender).val();
	regon = regon.replace(/[^0-9]+/g, '');
	$(sender).val(regon);

	if (regon.length > 0)
	{
		if (regon.length == 9)
		{
			var controlSum = 0;
			controlSum += parseInt(regon.charAt(0)) * 8;
			controlSum += parseInt(regon.charAt(1)) * 9;
			controlSum += parseInt(regon.charAt(2)) * 2;
			controlSum += parseInt(regon.charAt(3)) * 3;
			controlSum += parseInt(regon.charAt(4)) * 4;
			controlSum += parseInt(regon.charAt(5)) * 5;
			controlSum += parseInt(regon.charAt(6)) * 6;
			controlSum += parseInt(regon.charAt(7)) * 7;
			var cyfraKontrolna = controlSum % 11;
			if (cyfraKontrolna == 10)
			{
				cyfraKontrolna = 0;
			}
			if (cyfraKontrolna == parseInt(regon.charAt(8)))
			{
				$(sender).removeClass("ui-state-error");
				return true;
			}
			else
			{
				$(sender).addClass("ui-state-error");
				return false;
			}
		}
		else if (regon.length == 14)
		{
			var controlSum = 0;
			controlSum += parseInt(regon.charAt(0)) * 2;
			controlSum += parseInt(regon.charAt(1)) * 4;
			controlSum += parseInt(regon.charAt(2)) * 8;
			controlSum += parseInt(regon.charAt(3)) * 5;
			controlSum += parseInt(regon.charAt(4)) * 0;
			controlSum += parseInt(regon.charAt(5)) * 9;
			controlSum += parseInt(regon.charAt(6)) * 7;
			controlSum += parseInt(regon.charAt(7)) * 3;
			controlSum += parseInt(regon.charAt(8)) * 6;
			controlSum += parseInt(regon.charAt(9)) * 1;
			controlSum += parseInt(regon.charAt(10)) * 2;
			controlSum += parseInt(regon.charAt(11)) * 4;
			controlSum += parseInt(regon.charAt(12)) * 8;
			var cyfraKontrolna = controlSum % 11;
			if (cyfraKontrolna == 10)
			{
				cyfraKontrolna = 0;
			}
			if (cyfraKontrolna == parseInt(regon.charAt(13)))
			{
				$(sender).removeClass("ui-state-error");
				return true;
			}
			else
			{
				$(sender).addClass("ui-state-error");
				return false;
			}
		}
		else
		{
			$(sender).addClass("ui-state-error");
			return false;
		}

	}
	else if (req)
	{
		$(sender).addClass("ui-state-error");
		return false;
	}
	else
	{
		$(sender).removeClass("ui-state-error");
		return true;
	}
}
// ------------------------------------------------------------------------------
function AfterUploadFile(sender)
{
	var a = $(sender).contents().text();
	if (a == "null")
	{
		a = "";
	}
	if (a != "")
	{
		if (a.substring(0, 1) == "?")
		{
			tmp = $(sender).contents().text();
			ajax.get(tmp);
		}
	}
}
// -----------------------------------------------------------------------------
function getRandomString(dl)
{
	// RANDOM KEY PARAMETERS
	var keychars = "abcdefghijklmnopqrstuvwxyz";
	// RANDOM KEY GENERATOR
	var randkey = "";
	var max = keychars.length - 1;
	for (var i = 0; i < dl; i++)
	{
		los = Math.floor(Math.random() * max);
		randkey += keychars.substring(los, los + 1);
	}
	return randkey;
}
// -----------------------------------------------------------------------------
function OgraniczTextArea(Obj, Length)
{
	if (Obj.value.length > Length)
	{
		Obj.value = Obj.value.substring(0, Length);
	}
}
// -----------------------------------------------------------------------------
function CheckTime(sender, wymagany)
{
	var selected = $(sender).val();
	var styleAlert = "ui-state-error";
	$(sender).removeClass(styleAlert);

	if (selected != "")
	{
		var godzina = selected.substr(0, 2);
		var minuta = selected.substr(3, 2);
		var data = new Date(1970, 0, 1, godzina, minuta);
		if (data == "Invalid Date")
		{
			$(sender).val($(sender).prop("defaultValue"));
			$(sender).addClass(styleAlert);
			return;
		}
		else
		{
			godzina = data.getHours();
			minuta = data.getMinutes();
			if (godzina < 10)
			{
				godzina = "0" + godzina;
			}
			if (minuta < 10)
			{
				minuta = "0" + minuta;
			}
			var retval = godzina + ":" + minuta;
			if (retval != $(sender).val())
			{
				$(sender).val(retval);
				$(sender).addClass(styleAlert);
				return;
			}
			$(sender).val(retval);
		}
	}
	else
	{
		if (wymagany)
		{
			$(sender).addClass(styleAlert);
		}
	}
}
// -----------------------------------------------------------------------------
function CheckDate(sender, wymagany, minDate, maxDate, warn)
{
	var monthShortName = new Array();
	monthShortName[0] = "01";
	monthShortName[1] = "02";
	monthShortName[2] = "03";
	monthShortName[3] = "04";
	monthShortName[4] = "05";
	monthShortName[5] = "06";
	monthShortName[6] = "07";
	monthShortName[7] = "08";
	monthShortName[8] = "09";
	monthShortName[9] = "10";
	monthShortName[10] = "11";
	monthShortName[11] = "12";

	var selected = $(sender).val();
	var styleAlert = "ui-state-error";
	$(sender).removeClass(styleAlert);

	$(sender).css("color", "inherit");
	if (selected != "")
	{
		var rok = selected.substring(0, 4);
		var miesiac = selected.substring(5, 7);
		var dzien = selected.substring(8, 10);
		var data = new Date(rok, miesiac - 1, dzien);
		if (data == "Invalid Date")
		{
			$(sender).val($(sender).prop("defaultValue"));
			$(sender).addClass(styleAlert);
			return;
		}
		else
		{
			var dzis = new Date();
			if (data < dzis && warn)
			{
				$(sender).css("color", "red");
			}
			var rok1 = data.getFullYear();
			var retval = rok1 + "-";
			var miesiac1 = data.getMonth();
			retval += monthShortName[miesiac1] + "-";
			var dzien1 = data.getDate();
			var dzien2 = "0" + dzien1;
			if (dzien2.length == 2)
			{
				dzien1 = "0" + dzien1;
			}
			retval += dzien1;
			if (retval != $(sender).val())
			{
				$(sender).val(retval);
				$(sender).addClass(styleAlert);
				return;
			}
			$(sender).val(retval);
		}
		if (minDate != "")
		{
			if (selected < minDate)
			{
				$(sender).addClass(styleAlert);
				return;
			}
		}
		if (maxDate != "")
		{
			if (selected > maxDate)
			{
				$(sender).addClass(styleAlert);
				return;
			}
		}
	}
	else
	{
		if (wymagany)
		{
			$(sender).addClass(styleAlert);
			return;
		}
	}

}
// -----------------------------------------------------------------------------
function checkIsNull(sender)
{
	var styleAlert = "has-error";
	if (sender.value == "")
	{
		$(sender).parent().addClass(styleAlert);
	}
	else
	{
		$(sender).parent().removeClass(styleAlert);
	}
}
// -----------------------------------------------------------------------------
function CzyInt(sender, minValue, maxValue)
{
	return CzyReal(sender, minValue, maxValue, 0);
}
// -----------------------------------------------------------------------------
function checkReal(sender, minValue, maxValue, precision)
{
	var napis = sender.value;
	var styleAlert = "has-error";
	napis = ComaToPoint(napis);

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
		$(sender).parent().addClass(styleAlert);
		return false;
	}
	else
	{
		if (napis != "")
		{
			var num = new Number(napis);
			if (num < minValue || num > maxValue)
			{
				$(sender).parent().addClass(styleAlert);
				return false;
			}
			else
			{
				$(sender).parent().removeClass(styleAlert);
				$(sender).val(num.toFixed(precision));
				return true;
			}
		}
		else
		{
			$(sender).parent().removeClass(styleAlert);
			return true;
		}
	}
}
// -----------------------------------------------------------------------------
function addAlert(text, title)
{
	if (typeof title == "undefined")
	{
		title = "Błąd";
	}
	$("#MsgBox").html("<div style='margin-bottom:4px;padding:2px' class='ui-widget-content ui-state-error ui-corner-all'><div class='ui-widget-header ui-corner-all ui-helper-clearfix ui-state-highlight' style='padding:2px'><span class='ui-icon ui-icon-alert' style='float:left'></span>" + title + "<span class='ui-icon ui-icon-close hand' style='float:right;' onclick='$(this).parent().parent().remove(); HideToolTip(); return false;' onmouseover='ToolTip(\"Zamknij\",event,this)'></span></div><div class='ui-corner-bottom ui-priority-primary clear' style='padding:8px'><p class='clear' id='MSGLghDp'><span style='float:right;font-size:75%;'></span>" + text + "</p><script type='text/javascript'>$(\"#MSGLghDp\").parent().parent().delay(10000).hide(\"slide\",{direction: \"up\"})</script></div></div>");
	$("#MsgBox").show();
	$(document).scrollTop(0);
}
// -----------------------------------------------------------------------------
function ComaToPoint(text)
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
function ToCurr(liczba)
{

	if (liczba > 9999999999999)
	{
		liczba = 9999999999999;
	}

	if (liczba < -9999999999999)
	{
		liczba = -9999999999999;
	}

	liczba = Math.round(liczba * 100);
	liczba = liczba / 100;
	return liczba;
}
// -----------------------------------------------------------------------------
function ToInt(liczba)
{

	if (liczba > 9999999999999)
	{
		liczba = 9999999999999;
	}

	liczba = Math.floor(liczba);
	return liczba;
}
// -----------------------------------------------------------------------------
function initDropDownList(sender)
{
	$(sender).selectpicker();
	$(sender).on("hidden.bs.select", function(e)
	{
		if ($(this).val() != "")
		{
			$(this).parent().parent().removeClass("has-error");
		}
	});
}
// -----------------------------------------------------------------------------
function SetRadioNoAlert(nazwa)
{
	var radioObject = document.getElementsByName(nazwa);
	var a = radioObject.length;
	for (var i = 0; i < a; i++)
	{
		if (radioObject[i].type == 'radio')
		{
			radioObject[i].className = "radio";
		}
	}
}
// -----------------------------------------------------------------------------
function BeforeSubmit(formObject)
{
	try
	{
		tinyMCE.triggerSave();
	}
	catch (e)
	{
	}
	var a = formObject.length;
	for (var i = 0; i < a; i++)
	{
		var tmp = formObject.elements[i];
		if ($(tmp).filter(":visible").hasClass("ui-state-error"))
		{
			alert('Nie wszystkie wymagane pola (wyróżnione) zostały wypełnione');
			return false;
		}
	}
	return true;
}
// -----------------------------------------------------------------------------
function GoUrl(url)
{
	location.href = url;
}
// -----------------------------------------------------------------------------
function DestroyObject(idObject)
{
	var divObj = document.getElementById(idObject);
	if (divObj)
	{
		divObj.className = "ukryte";
		var bodyObj = document.getElementsByTagName("body");
		bodyObj[0].removeChild(divObj);
	}
}
// -----------------------------------------------------------------------------
function ToolTip(Msg, Zdarzenie, Obj)
{
	$(Obj).attr("title", Msg);
	$(document).tooltip(
	{
		track : true,
		show :
		{
			effect : "fade",
			duration : 100
		},
		hide :
		{
			effect : "fade",
			duration : 100
		}
	});
}
// -----------------------------------------------------------------------------
function initTinyMCE()
{
	tinyMCE.editors = [];
	tinyMCE.init(
	{
		mode : "textareas",
		theme : "modern",
		height : 250,
		plugins : [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons template paste textcolor "
		],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
		image_list : "/?action=GetACImageList",
		link_list : "/?action=GetACLinkList",
		image_advtab : true,
		link_class_list : [
				{
					title : 'None',
					value : ''
				},
				{
					title : 'Link',
					value : 'link'
				},
		]

	});
}
// -----------------------------------------------------------------------------
