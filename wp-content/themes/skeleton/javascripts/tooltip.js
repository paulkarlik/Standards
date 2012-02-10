var Tooltips = {
	init: function() {
		// target all linkes with css class selector "rich"
		var links = $("a.rich");

		for (var i = 0, ii = links.length; i < ii; i++)
		{
			if (links[i].title && links[i].title.length > 0)
			{
				var tipContainer = document.createElement("span");
				tipContainer.className = links[i].className + " tipcontainer";

				links[i].parentNode.replaceChild(tipContainer, links[i]);
				tipContainer.appendChild(links[i]);

				$(links[i]).bind("mouseover", Tooltips.showTipListener);
				$(links[i]).bind("focus", Tooltips.showTipListener);
				$(links[i]).bind("mouseout", Tooltips.hideTipListener);
				$(links[i]).bind("blur", Tooltips.hideTipListener);
			}
		}
	},
	
	showTipListener: function(e) {
		Tooltips.showTip(this);
		e.preventDefault();
	},

	hideTipListener: function(e) {
		Tooltips.hideTip(this);
	},

	showTip: function(link) {
		if (!link.nextSibling)
		{
			var tip = document.createElement("span");
			tip.className = "tooltip";
			var tipText = document.createTextNode(link.title);
			tip.appendChild(tipText);
			link.parentNode.appendChild(tip);

			link.title = "";
		}
	},

	hideTip: function(link)	{
		if (link.nextSibling)
		{
			var tip = link.nextSibling;
			link.title = tip.firstChild.nodeValue;
			link.parentNode.removeChild(tip);
		}
	}
};

Tooltips.init();