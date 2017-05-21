// =============================================================================
function PopUpWindow(idContener)
{
	var idContener = idContener;
	PopUpWindow.prototype.create = function(title)
	{
		return create(title);
	};
	PopUpWindow.prototype.close = function()
	{
		return close();
	};
	PopUpWindow.prototype.setContent = function(content)
	{
		return setContent(content);
	};
	// -------------------------------------------------------------------------
	function create(title)
	{
		if ($("#" + idContener).length)
		{
			$("#" + idContener).modal("hide");
			$("#" + idContener).remove();
		}
		var dialogDiv = "<div class='modal fade' id='" + idContener + "' role='dialog'>";
		dialogDiv += "<div class='modal-dialog'>";
		dialogDiv += "<!-- Modal content-->";
		dialogDiv += "<div class='modal-content'>";
		dialogDiv += "<div class='modal-header'>";
		dialogDiv += "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
		dialogDiv += "<h4 class='modal-title'>" + title + "</h4>";
		dialogDiv += "</div>";
		dialogDiv += "<div class='modal-body'>";
		dialogDiv += "<p>&nbsp;</p>";
		dialogDiv += "</div>";
		// dialogDiv += "<div class='modal-footer'>";
		// dialogDiv += "<button type='button' class='btn btn-default'
		// data-dismiss='modal'>OK</button>";
		// dialogDiv += "</div>";
		dialogDiv += "</div>";
		dialogDiv += "</div>";
		dialogDiv += "</div>";
		$("body:first").append(dialogDiv);
		$("#" + idContener).modal("show");

		return false;
	}
	// -------------------------------------------------------------------------
	function setContent(content)
	{
		$("#" + idContener + " .modal-body").html(content);
	}
	// -------------------------------------------------------------------------
	function close()
	{
		$("#" + idContener).modal("hide");
		$("#" + idContener).remove();
		return false;
	}
	// -------------------------------------------------------------------------
}
// =============================================================================
function PopUpMenu(idContener)
{
	var idContener = idContener;
	PopUpMenu.prototype.create = function(e)
	{
		return create(e);
	};
	PopUpMenu.prototype.close = function()
	{
		return close();
	};
	PopUpMenu.prototype.setContent = function(content)
	{
		return setContent(content);
	};
	// -------------------------------------------------------------------------
	function create(e)
	{
		if ($("#" + idContener).length)
		{
			$("#" + idContener).remove();
		}
		else
		{
			var dialogDiv = "<div id='" + idContener + "' class='ui-widget ui-widget-content ui-corner-all PopUpBox' />";
			$("body:first").append(dialogDiv);
			$("#" + idContener).offset(
			{
				top : e.pageY,
				left : e.pageX
			});
		}

		return false;
	}
	// -------------------------------------------------------------------------
	function setContent(content)
	{
		$("#" + idContener).html(content);
	}
	// -------------------------------------------------------------------------
	function close()
	{
		$("#" + idContener).remove();
		return false;
	}
}
// =============================================================================
function createAjaxMenu(idContener, e, sender)
{
	var menu = new PopUpMenu(idContener);
	menu.create(e);
	e.stopPropagation();
	$(document).click(function()
	{
		closePopUpMenu(idContener);
	});
	$("#" + idContener).click(function(event)
	{
		event.stopPropagation();
	});
	return fieldAjax.go(sender);
}
// =============================================================================
function closePopUpMenu(idContener)
{
	var w = new PopUpMenu(idContener);
	return w.close();
}
// =============================================================================
function closeWindow(idContener)
{
	var w = new PopUpWindow(idContener);
	return w.close();
}
// =============================================================================
function centerWindow(sender)
{
	$(sender).dialog("option", "position",
	{
		my : "center",
		at : "center",
		of : window
	});
}
// =============================================================================
